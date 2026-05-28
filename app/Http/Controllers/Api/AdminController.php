<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ExamSession;
use App\Models\ExamResult;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success'   => false,
                'message'   => 'Email atau password admin salah!'
            ], 401);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Autentikasi Pengawas berhasil'
        ]);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'exam_status'   => 'required|in:waiting,started',
            'current_token' => 'required|string',
            'exam_duration' => 'required|integer'
        ]);

        Setting::where('key', 'exam_status')->update(['value' => $request->exam_status]);
        Setting::where('key', 'current_token')->update(['value' => strtoupper($request->current_token)]);
        Setting::where('key', 'token_expired_at')->update(['value' => now()->addMinutes(120)->format('Y-m-d H:i:s')]);
        Setting::where('key', 'exam_duration')->update(['value' => $request->exam_duration]);

        return response()->json([
            'success'   => true,
            'message'   => 'Status pusat ujian berhasil diperbarui!'
        ]);
    }

    public function getDashboardData()
    {
        return response()->json([
            'exam_status' => Setting::where('key', 'exam_status')->first()->value,
            'current_token' => Setting::where('key', 'current_token')->first()->value,
            'exam_duration' => Setting::where('key', 'exam_duration')->first()->value,
            'total_students' => ExamSession::count(),
            'finished_students' => ExamSession::where('is_finished', true)->count()
        ]);
    }

    public function getLeaderboard($subject, $class)
    {
        $query = ExamResult::where('subject', $subject);

        if ($class !== 'all') {
            $query->where('student_class', $class);
        }

        $results = $query->orderBy('score', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();
        
        return response()->json([
            'success'   => true,
            'data'      => $results
        ]);
    }
}
