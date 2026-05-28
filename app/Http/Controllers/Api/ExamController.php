<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ExamSession;
use App\Models\Question;
use App\Models\ExamResult;
use Carbon\Carbon;

class ExamController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'class'     => 'required|string',
            'subject'   => 'required|string',
            'token'     => 'required|string'
        ]);

        $currentToken   = Setting::where('key', 'current_token')->first()->value;
        $tokenExpiry    = Setting::where('key', 'token_expired_at')->first()->value;

        if ($request->token !== $currentToken || now()->greaterThan(Carbon::parse($tokenExpiry))) {
            return response()->json([
                'success'   => false,
                'message'   => 'Token salah atau sudah kadaluarsa! minta token baru pada pengawas'
            ], 401);
        }

        $session = ExamSession::where('student_name', $request->name)
            -> where('student_class', $request->class)
            ->where('subject', $request->subject)
            ->first();

        if (!$session) {
            $duration   = Setting::where('key', 'exam_duration')->first()->value;
            $session    = ExamSession::create([
                'student_name'      => $request->name,
                'student_class'     => $request->class,
                'subject'           => $request->subject,
                'token_used'        => $request->token,
                'remaining_time'    => (int) $duration,
            ]);
        } elseif ($session->is_finished) {
            return response()->json([
                'success'   => false,
                'message'   => 'Kamu sudah menyelesaikan ujian ini dengan baik!'
            ], 403);
        }

        return response()->json([
            'success'           => true,
            'session_id'        => $session->id,
            'exam_status'       => Setting::where('key', 'exam_status')->first()->value,
            'remaining_time'    => $session->remaining_time
        ]);
    }

    public function getQuestions(Request $request)
    {
        $request->validate(['session_id' => 'required']);
        $session = ExamSession::find($request->session_id);

        if (!$session) {
            return response()->json([
                'success' => false, 
                'message' => 'Sesi tidak ditemukan.'
            ], 404);
        }

        $examStatus = Setting::where('key', 'exam_status')->first()->value;

        if ($examStatus === 'waiting') {
            $questions = Question::where('is_practice', true)->get();
        } else {
            $questions = Question::where('is_practice', false)
                ->where('subject', $session->subject)
                ->inRandomOrder()
                ->limit(25)
                ->get();
        }

        return response()->json([
            'status'    => $examStatus,
            'data'      => $questions
        ]);
    }

    public function syncSession(Request $request)
    {
        $session = ExamSession::find($request->session_id);
        if ($session && !$session->is_finished) {
            $session->update([
                'remaining_time'    => $request->remaining_time,
                'current_answers'   => json_encode($request->answers)
            ]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function submitExam(Request $request)
    {
        $session = ExamSession::find($request->session_id);
        if (!$session || $session->is_finished) {
            return response()->json([
                'success'   => false,
                'message'   => 'Sesi tidak valid atau sudah selesai.'
            ]);
        }

        $questions  = Question::where('is_practice', false)->where('subject', $session->subject)->get();
        $score      = 0;
        $summary    = [];

        foreach ($questions as $q) {
            $studentAns = $request->answers[$q->id] ?? '';
            $isCorrect  = ($q->correct_answer === $studentAns);
            if ($isCorrect) $score++;

            $summary[] = [
                'question_text'     => $q->question_text,
                'student_answer'    => $studentAns,
                'correct_answer'    => $q->correct_answer,
                'is_correct'        => $isCorrect,
                'explanation'       => $q->explanation
            ];
        }

        $finalScore = $questions->count() > 0 ? ($score / $questions->count()) * 100 : 0;

        ExamResult::create([
            'student_name'      => $session->student_name,
            'student_class'     => $session->student_class,
            'subject'           => $session->subject,
            'score'             => $finalScore,
            'answers_summary'   => json_encode($summary)
        ]);

        $session->update(['is_finished' => true, 'remaining_time' => 0]);
        return response()->json([
            'success'   => true,
            'score'     => $finalScore
        ]);
    }

}
