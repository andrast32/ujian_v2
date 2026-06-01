import React, { useState, useEffect, useRef } from "react";
import axios from 'axios';
import Swal from 'sweetalert2';
import { 
  Shield, 
  GraduationCap, 
  Trophy, 
  LogOut, 
  CheckCircle, 
  Clock, 
  BookOpen, 
  AlertTriangle, 
  ChevronRight, 
  ChevronLeft, 
  HelpCircle,
  RefreshCw // Icon baru untuk tombol generate
} from 'lucide-react';

axios.defaults.baseURL = 'http://localhost:8000/api';

export default function App() {

  const [view, setView] = useState(localStorage.getItem('app_view') || 'login-student');

  // student state
  const [studentForm, setStudentForm] = useState({ name: '', class: '', subject: 'python', token: ''});
  const [sessionId, setSessionId] = useState(localStorage.getItem('app_session') || null);
  const [remainingTime, setRemainingTime] = useState(localStorage.getItem('app_timer') ? parseInt(localStorage.getItem('app_timer')) : 0);
  const [questions, setQuestions] = useState([]);
  const [currentIdx, setCurrentIdx] = useState(0);
  const [answers, setAnswers] = useState(JSON.parse(localStorage.getItem('app_answers')) || {});
  const [examResultSummary, setExamResultSummary] = useState([]);
  const [finalScore, setFinalScore] = useState(0);

  // admin state
  const [adminForm, setAdminForm] = useState({ email: 'admin@sekolah.com', password: '' });
  const [adminDashboard, setAdminDashboard] = useState({
    exam_status: 'waiting',
    current_token: 'TOKEN123',
    exam_duration: 1800,
    total_students: 0,
    finished_students: 0
  });
  const [filterLeaderboard, setFilterLeaderboard] = useState({subject: 'python', class: 'all'});
  const [leaderboardData, setLeaderboardData] = useState([]);

  const timerRef = useRef(null);

  // =====================
  // LOGIKA UTAMA SISWA
  // =====================

  const handleStudentLogin = async () => {
    try {
      const res = await axios.post('/login', studentForm);
      if (res.data.success) {
        setSessionId(res.data.session_id);
        localStorage.setItem('app_session', res.data.session_id);

        setRemainingTime(res.data.remaining_time);
        localStorage.setItem('app_timer', res.data.remaining_time);

        Swal.fire({
          icon: 'success',
          title: 'Login berhasil',
          text: 'Selamat datang di ruang ujian.',
          timer: 1500,
          showConfirmButton: false, 
          background: '#0f172a', 
          color: '#f8fafc'
        });

        const nextView = res.data.exam_status === 'waiting' ? 'waiting-room' : 'exam';
        setView(nextView);
        localStorage.setItem('app_view', nextView);
      }
    } catch (err) {
      Swal.fire({
        icon: 'error',
        title: 'Kamu Gagal Masuk',
        text: err.response?.data?.message || 'Terjadi kesalahan pada sistem.', 
        background: '#0f172a', 
        color: '#f8fafc'
      });
    }
  };

  useEffect(() => {
    if (!sessionId) return;

    const fetchQuestions = async () => {
      try {
        const res = await axios.get(`/questions?session_id=${sessionId}`);
        if (view === 'waiting-room' && res.data.status === 'started') {
          Swal.fire({
            icon: 'info',
            title: 'Ujian Dimulai!',
            text: "Ujian telah dimulai, berdo'a lah sebelum mengerjakan soal, dan tetaplah fokus.",
            timer: 3500,
            showConfirmButton: false, 
            background: '#0f172a', 
            color: '#f8fafc'
          });
          setView('exam');
          localStorage.setItem('app_view', 'exam');

          setQuestions(res.data.data);
        } else if (view === 'waiting-room' || questions.length === 0) {
          setQuestions(res.data.data);
        }

      } catch (err) {
        console.error("Gagal ambil materi soal", err);
      }
    };

    fetchQuestions(); // Tembakan pertama

    if (view === 'waiting-room') {
      const interval = setInterval(fetchQuestions, 4000);
      return () => clearInterval(interval);
    }
  }, [sessionId, view]);

  useEffect(() => {
    if (view !== 'exam' || remainingTime <= 0) return;

    timerRef.current = setInterval(() => {
      setRemainingTime((prev) => {
        const nextTime = prev - 1;
        localStorage.setItem('app_timer', nextTime);

        if (nextTime % 10 === 0) {
          axios.post('/sync-session', {
            session_id: sessionId,
            remaining_time: nextTime, answers
          });
        }
        if (nextTime <= 0) {
          clearInterval(timerRef.current);
          handleFormatSubmit();
        }
        return nextTime;
      });
    }, 1000);

    return () => clearInterval(timerRef.current);
  }, [view, answers]);

  const handleSelectAnswer = (questionId, option) => {
    const newAnswers = { ...answers, [questionId]: option };
    setAnswers(newAnswers);
    localStorage.setItem('app_answers', JSON.stringify(newAnswers));
  };

  const handleFormatSubmit = async () => {
    clearInterval(timerRef.current);
    try {
      const activeQuestionIds = questions.map(q => q.id);

      const res = await axios.post('/submit', {
        session_id: sessionId, 
        answers: answers,
        question_ids: activeQuestionIds 
      });

      if (res.data.success) {
        setFinalScore(res.data.score);
        
        setExamResultSummary(res.data.summary);

        Swal.fire({
          icon: 'success',
          title: 'Ujian telah Selesai',
          text: 'Jawaban kamu aman tersimpan di database.', 
          background: '#0f172a', 
          color: '#f8fafc'
        });
        setView('review');
        localStorage.setItem('app_view', 'review');
      }
    } catch (err) {
      Swal.fire({ 
        icon: 'error', 
        title: 'Gagal Mengirim', 
        text: 'Koneksi bermasalah saat mengirim lembar jawaban.', 
        background: '#0f172a', 
        color: '#f8fafc'
      });
    }
  };

  // =====================
  // LOGIKA UTAMA ADMIN
  // =====================
  const handleAdminLogin = async () => {
    try {
      const res = await axios.post('/admin/login', adminForm);
      if (res.data.success) {
        Swal.fire({
          icon: 'success',
          title: 'Akses Diterima',
          text: 'Selamat datang, Pengawas.',
          timer: 1500,
          showConfirmButton: false, 
          background: '#0f172a', 
          color: '#f8fafc'
        });
        fetchAdminDashboard(true); // Panggil penuh saat pertama login

        setView('admin-dashboard');
        localStorage.setItem('app_view', 'admin-dashboard');
      }
    } catch (err) {
      Swal.fire({
        icon: 'error', 
        title: 'Akses Ditolak', 
        text: 'Email atau Password Admin salah!', 
        background: '#0f172a', 
        color: '#f8fafc'
      });
    }
  };

  // FUNGSI PERBAIKAN: isInitial untuk mencegah input token tertimpa saat auto-refresh
  const fetchAdminDashboard = async (isInitial = false) => {
    try {
      const res = await axios.get('/admin/dashboard?t=' + new Date().getTime());
      if (isInitial) {
        // Jika pertama buka, load semua data dari DB
        setAdminDashboard(res.data);
      } else {
        // Jika auto-refresh, load HANYA angka statistik (siswa), jangan ganggu ketikan form
        setAdminDashboard(prev => ({
          ...prev,
          total_students: res.data.total_students,
          finished_students: res.data.finished_students
        }));
      }
    } catch (err) {
      console.error(err);
    }
  };

  const handleSaveSettings = async (updatedStatus) => {
    try {
      const finalStatus = typeof updatedStatus === 'string' ? updatedStatus : adminDashboard.exam_status;

      const payload = {
        exam_status: finalStatus,
        current_token: adminDashboard.current_token,
        exam_duration: parseInt(adminDashboard.exam_duration)
      };

      const res = await axios.post('/admin/update-settings', payload);
      if (res.data.success) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Pengaturan sistem ujian telah diperbarui!',
          timer: 1500,
          showConfirmButton: false, 
          background: '#0f172a', 
          color: '#f8fafc'
        });
        fetchAdminDashboard(true); // Load ulang penuh dari DB setelah di-save
      }
    } catch (err) {
      Swal.fire({
        icon: 'error', 
        title: 'Gagal', 
        text: err.response?.data?.message || 'Gagal memperbarui pengaturan.', 
        background: '#0f172a', 
        color: '#f8fafc'
      });
    }
  };

  // FUNGSI BARU: GENERATE TOKEN ACAK 5 KARAKTER
  const generateRandomToken = () => {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let newToken = '';
    for (let i = 0; i < 5; i++) {
      newToken += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    setAdminDashboard(prev => ({ ...prev, current_token: newToken }));
  };

  const fetchLeaderboard = async () => {
    try {
      const res = await axios.get(`/admin/leaderboard/${filterLeaderboard.subject}/${filterLeaderboard.class}?t=${new Date().getTime()}`);
      setLeaderboardData(res.data.data);
    } catch (err) {
      console.error(err);
    }
  };

  useEffect(() => {
    if (view === 'admin-dashboard') {
      fetchAdminDashboard(true);
      fetchLeaderboard();
      const interval = setInterval(() => {
        fetchAdminDashboard(false); // isInitial = false agar input tak tertimpa
        fetchLeaderboard();
      }, 5000);
      return () => clearInterval(interval);
    }
  }, [view, filterLeaderboard]);

  const formatTime = (seconds) => {
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
  };

  const handleLogout = () => {
    clearInterval(timerRef.current); 
    localStorage.clear(); 
    setSessionId(null); 
    setQuestions([]); 
    setAnswers({});
    setView('login-student');
  };

  return (
    <div className="min-h-screen bg-[#020617] text-slate-100 flex flex-col justify-between font-sans selection:bg-emerald-500 selection:text-slate-950">
      
      {/* HEADER NAVBAR */}
      <header className="border-b border-slate-800/60 bg-slate-950/50 backdrop-blur-xl sticky top-0 z-50 px-8 py-4 flex justify-between items-center shadow-lg shadow-black/20">
        <div className="flex items-center gap-4">
          <div className="w-12 h-12 bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-600 rounded-xl flex items-center justify-center text-slate-950 font-black text-2xl font-mono shadow-[0_0_20px_rgba(16,185,129,0.3)] transform hover:scale-105 transition-all duration-300">X</div>
          <div>
            <h1 className="font-extrabold tracking-wider text-lg font-mono text-slate-100 flex items-center gap-2">
              X-SYSTEM 
              <span className="text-[10px] font-sans font-bold px-2.5 py-0.5 bg-emerald-500/10 text-emerald-400 rounded-full border border-emerald-500/30 shadow-[0_0_10px_rgba(16,185,129,0.1)]">V2.0</span>
            </h1>
            <p className="text-[11px] text-slate-400 tracking-widest uppercase font-semibold mt-0.5">Sistem Manajemen Ujian Terintegrasi</p>
          </div>
        </div>
        
        {view.startsWith('login') ? (
          <button 
            onClick={() => setView(view === 'login-student' ? 'login-admin' : 'login-student')} 
            className="text-xs font-bold text-slate-300 hover:text-emerald-400 hover:border-emerald-500/50 transition-all duration-300 bg-slate-900/80 hover:bg-slate-900 px-5 py-2.5 rounded-xl border border-slate-700 shadow-sm"
          >
            {view === 'login-student' ? '🔒 Portal Pengawas' : '🎓 Portal Siswa'}
          </button>
        ) : (
          <button 
            onClick={handleLogout} 
            className="flex items-center gap-2 text-xs font-bold text-slate-400 bg-slate-900/60 border border-slate-800 px-5 py-2.5 rounded-xl hover:text-rose-400 hover:border-rose-500/30 hover:bg-rose-500/10 transition-all duration-300"
          >
            <LogOut className="w-4 h-4" /> Keluar Sesi
          </button>
        )}
      </header>

      {/* RENDER VIEW DINAMIS */}
      <main className="flex-grow flex items-center justify-center p-6 md:p-8 max-w-7xl w-full mx-auto">
        
        {/* 1. INTERFACE LOGIN SISWA */}
        {view === 'login-student' && (
          <div className="w-full max-w-md bg-slate-900/60 border border-slate-800 p-8 rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.5)] backdrop-blur-md transform transition-all duration-500 relative overflow-hidden">
            <div className="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl"></div>
            <div className="w-14 h-14 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-2xl flex items-center justify-center mb-6 shadow-inner relative z-10">
              <GraduationCap className="w-7 h-7" />
            </div>
            <h2 className="text-3xl font-black tracking-tight text-slate-100 mb-2 relative z-10">Masuk Sesi Ujian</h2>
            <p className="text-slate-400 text-sm mb-8 font-medium relative z-10">Silakan lengkapi identitas untuk memulai lembar pengerjaan.</p>
            <div className="space-y-5 relative z-10">
              <div>
                <label className="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-2 pl-1">Nama Lengkap Siswa</label>
                <input type="text" placeholder="Masukkan nama sesuai daftar hadir" value={studentForm.name} onChange={e => setStudentForm({...studentForm, name: e.target.value})} className="w-full px-5 py-3.5 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/50 text-sm transition-all text-slate-100 font-medium placeholder-slate-600" />
              </div>
              <div>
                <label className="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-2 pl-1">Kelas</label>
                <input type="text" placeholder="Contoh: 7A, 8B" value={studentForm.class} onChange={e => setStudentForm({...studentForm, class: e.target.value})} className="w-full px-5 py-3.5 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/50 text-sm transition-all text-slate-100 font-medium placeholder-slate-600" />
              </div>
              <div>
                <label className="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-2 pl-1">Mata Pelajaran</label>
                <select value={studentForm.subject} onChange={e => setStudentForm({...studentForm, subject: e.target.value})} className="w-full px-5 py-3.5 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/50 text-sm text-slate-200 transition-all font-medium cursor-pointer">
                  <option value="python">Python Programming (Kelas 8)</option>
                  <option value="logika"> Logic (Kelas 7)</option>
                </select>
              </div>
              <div>
                <label className="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-2 pl-1">Token Akses</label>
                <input type="text" placeholder="•••••" value={studentForm.token} onChange={e => setStudentForm({...studentForm, token: e.target.value})} className="w-full px-5 py-3.5 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/50 text-lg text-center font-mono font-black tracking-widest text-emerald-400 placeholder-slate-700 uppercase" />
              </div>
              <button onClick={handleStudentLogin} className="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-extrabold py-4 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(16,185,129,0.3)] text-sm mt-4 tracking-wide transform active:scale-[0.98]">Mulai Validasi Sesi →</button>
            </div>
          </div>
        )}

        {/* 2. INTERFACE LOGIN ADMIN */}
        {view === 'login-admin' && (
          <div className="w-full max-w-md bg-slate-900/60 border border-slate-800 p-8 rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.5)] backdrop-blur-md transform transition-all duration-500 relative overflow-hidden">
             <div className="absolute -top-24 -left-24 w-48 h-48 bg-teal-500/10 rounded-full blur-3xl"></div>
            <div className="w-14 h-14 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-2xl flex items-center justify-center mb-6 shadow-inner relative z-10">
              <Shield className="w-7 h-7" />
            </div>
            <h2 className="text-3xl font-black tracking-tight text-slate-100 mb-2 relative z-10">Portal Pengawas</h2>
            <p className="text-slate-400 text-sm mb-8 font-medium relative z-10">Masukkan kredensial khusus administrator untuk mengakses ruang kendali.</p>
            <div className="space-y-5 relative z-10">
              <div>
                <label className="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-2 pl-1">Email Pengawas</label>
                <input type="email" value={adminForm.email} onChange={e => setAdminForm({...adminForm, email: e.target.value})} className="w-full px-5 py-3.5 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/50 text-sm transition-all font-medium text-slate-200" />
              </div>
              <div>
                <label className="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-2 pl-1">Kata Sandi</label>
                <input type="password" placeholder="••••••••" value={adminForm.password} onChange={e => setAdminForm({...adminForm, password: e.target.value})} className="w-full px-5 py-3.5 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/50 text-lg transition-all text-center tracking-widest text-slate-200" />
              </div>
              <button onClick={handleAdminLogin} className="w-full bg-slate-100 hover:bg-white text-slate-950 font-extrabold py-4 rounded-xl transition-all duration-300 text-sm mt-4 tracking-wide transform active:scale-[0.98] shadow-lg">Buka Dashboard Utama 🔓</button>
            </div>
          </div>
        )}

        {/* 3. INTERFACE RUANG TUNGGU SISWA */}
        {view === 'waiting-room' && (
          <div className="w-full max-w-2xl bg-slate-900/60 border border-slate-800 p-10 rounded-3xl text-center shadow-[0_0_40px_rgba(0,0,0,0.5)] backdrop-blur-md relative overflow-hidden">
            <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 via-orange-500 to-amber-500"></div>
            <div className="inline-flex px-4 py-1.5 bg-amber-500/10 border border-amber-500/30 text-amber-400 rounded-full text-xs font-bold mb-6 items-center gap-2 animate-pulse shadow-sm">
              <Clock className="w-4 h-4 animate-[spin_3s_linear_infinite]" /> Menunggu Instruksi Pengawas...
            </div>
            <h2 className="text-4xl font-black tracking-tight mb-3 text-slate-100">Gerbang Sesi Terkunci</h2>
            <p className="text-slate-400 text-sm max-w-lg mx-auto mb-10 font-medium leading-relaxed">Ujian utama belum diaktifkan oleh pengawas kelas. Sembari menunggu status Live, silakan coba interaksi soal simulasi di bawah ini.</p>
            
            {questions.length > 0 && (
              <div className="bg-slate-950/80 p-8 rounded-2xl text-left border border-slate-800 shadow-inner relative overflow-hidden before:absolute before:top-0 before:left-0 before:w-1.5 before:h-full before:bg-emerald-500">
                <div className="flex items-center gap-2 mb-3">
                  <HelpCircle className="w-5 h-5 text-emerald-400" />
                  <span className="text-xs font-bold text-emerald-400 uppercase tracking-wider">Simulasi Sistem</span>
                </div>
                <p className="text-lg font-bold mb-6 text-slate-200 leading-relaxed pl-1">{questions[0].question_text}</p>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  {['a','b','c','d'].map((opt) => (
                    <button 
                      key={opt} 
                      onClick={() => Swal.fire({
                        title: opt === 'b' ? 'Benar!' : 'Salah', 
                        text: 'Ini hanya simulasi pengenalan sistem. Harap bersiap untuk ujian asli.', 
                        icon: opt === 'b' ? 'success' : 'error',
                        background: '#0f172a',
                        color: '#f8fafc'
                      })} 
                      className="px-5 py-4 bg-slate-900/80 border border-slate-700/60 hover:border-emerald-500/50 hover:bg-emerald-500/10 rounded-xl text-left text-sm font-semibold transition-all duration-200 text-slate-300 group flex items-center gap-3"
                    >
                      <span className="font-mono font-black text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded shadow-sm border border-emerald-500/20 uppercase group-hover:bg-emerald-500 group-hover:text-slate-950 transition-colors">{opt}</span> 
                      <span className="truncate">{questions[0][`option_${opt}`]}</span>
                    </button>
                  ))}
                </div>
              </div>
            )}
          </div>
        )}

        {/* 4. LEMBAR UJIAN AKTIF SISWA */}
        {view === 'exam' && questions.length > 0 && (
          <div className="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <div className="lg:col-span-2 bg-slate-900/60 border border-slate-800 p-8 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,0.3)] backdrop-blur-md">
              <div className="flex justify-between items-center pb-5 mb-6 border-b border-slate-800/60">
                <div className="flex flex-col gap-1">
                  <span className="text-[11px] font-bold text-slate-500 uppercase tracking-widest">Lembar Evaluasi Utama</span>
                  <span className="text-sm font-extrabold text-slate-200 uppercase tracking-wide">Soal {currentIdx + 1} dari {questions.length}</span>
                </div>
                <span className={`flex items-center gap-2 text-base font-mono font-black px-4 py-2 border rounded-xl shadow-inner transition-all duration-500 ${remainingTime < 300 ? 'bg-red-500/10 border-red-500/40 text-red-400 shadow-[0_0_15px_rgba(239,68,68,0.2)] animate-pulse' : 'bg-slate-950/80 border-slate-700/50 text-emerald-400'}`}>
                  <Clock className={`w-5 h-5 ${remainingTime < 300 ? 'text-red-400' : 'text-emerald-400'}`} /> {formatTime(remainingTime)}
                </span>
              </div>
              
              <div className="min-h-[120px] mb-8">
                 <h3 className="text-xl font-bold text-slate-100 leading-relaxed bg-slate-950/50 p-6 rounded-2xl border border-slate-800/80 shadow-inner">{questions[currentIdx].question_text}</h3>
              </div>

              <div className="space-y-4">
                {['a', 'b', 'c', 'd'].map((opt) => {
                  const optionValue = questions[currentIdx][`option_${opt}`];
                  const isSelected = answers[questions[currentIdx].id] === opt.toUpperCase();
                  return (
                    <button 
                      key={opt} 
                      onClick={() => handleSelectAnswer(questions[currentIdx].id, opt.toUpperCase())} 
                      className={`w-full p-5 rounded-2xl text-left text-sm transition-all duration-200 border flex items-center justify-between group ${isSelected ? 'bg-emerald-500/10 border-emerald-500/60 text-emerald-300 font-bold shadow-[0_0_15px_rgba(16,185,129,0.15)]' : 'bg-slate-950/60 border-slate-800 hover:border-slate-600 hover:bg-slate-900 text-slate-300'}`}
                    >
                      <span className="flex items-center gap-4">
                        <span className={`font-mono font-black border rounded-lg px-3 py-1.5 text-sm transition-all shadow-sm ${isSelected ? 'bg-emerald-500 border-emerald-400 text-slate-950' : 'bg-slate-900 border-slate-700 text-slate-400 group-hover:text-slate-200 group-hover:border-slate-500'}`}>{opt.toUpperCase()}</span> 
                        <span className="leading-relaxed">{optionValue}</span>
                      </span>
                    </button>
                  );
                })}
              </div>
              
              <div className="flex justify-between items-center mt-10 pt-6 border-t border-slate-800/60">
                <button 
                  disabled={currentIdx === 0} 
                  onClick={() => setCurrentIdx(currentIdx - 1)} 
                  className="px-5 py-3 flex items-center gap-2 text-xs font-bold uppercase tracking-wider bg-slate-950 border border-slate-800 hover:border-slate-600 text-slate-400 hover:text-slate-200 rounded-xl disabled:opacity-30 transition-all"
                >
                  <ChevronLeft className="w-4 h-4" /> Sebelumnya
                </button>
                {currentIdx < questions.length - 1 ? (
                  <button 
                    onClick={() => setCurrentIdx(currentIdx + 1)} 
                    className="px-6 py-3 flex items-center gap-2 text-xs font-bold uppercase tracking-wider bg-slate-100 text-slate-950 rounded-xl hover:bg-white hover:scale-[1.02] active:scale-[0.98] transition-all shadow-md"
                  >
                    Selanjutnya <ChevronRight className="w-4 h-4" />
                  </button>
                ) : (
                  <button 
                    onClick={handleFormatSubmit} 
                    className="px-8 py-3 text-xs font-extrabold uppercase tracking-wider bg-gradient-to-r from-emerald-500 to-teal-500 text-slate-950 rounded-xl hover:from-emerald-400 hover:to-teal-400 shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:scale-[1.02] active:scale-[0.98] transition-all"
                  >
                    Kumpulkan Ujian ✓
                  </button>
                )}
              </div>
            </div>
            
            {/* PANEL NAVIGASI SOAL */}
            <div className="bg-slate-900/60 border border-slate-800 p-8 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,0.3)] backdrop-blur-md sticky top-28">
              <h4 className="text-xs font-black uppercase tracking-widest text-slate-400 mb-5 border-b border-slate-800 pb-3 flex items-center gap-2">
                <BookOpen className="w-4 h-4" /> Peta Kertas Soal
              </h4>
              <div className="grid grid-cols-4 gap-3">
                {questions.map((q, idx) => {
                  const isCurrent = idx === currentIdx;
                  const isAnswered = !!answers[q.id];
                  return (
                    <button 
                      key={q.id} 
                      onClick={() => setCurrentIdx(idx)} 
                      className={`py-3.5 rounded-xl font-mono text-sm font-black border transition-all duration-300 shadow-sm ${
                        isCurrent 
                          ? 'bg-emerald-500 border-emerald-400 text-slate-950 scale-105 shadow-[0_0_15px_rgba(16,185,129,0.4)]' 
                          : isAnswered 
                            ? 'bg-emerald-500/15 border-emerald-500/40 text-emerald-400 font-extrabold hover:bg-emerald-500/25' 
                            : 'bg-slate-950/80 border-slate-800 text-slate-500 hover:border-slate-600 hover:text-slate-300'
                      }`}
                    >
                      {(idx + 1).toString().padStart(2, '0')}
                    </button>
                  );
                })}
              </div>
              <div className="mt-6 pt-5 border-t border-slate-800 flex flex-col gap-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                <div className="flex items-center gap-3"><span className="w-3 h-3 bg-emerald-500 rounded shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span> Posisi Aktif</div>
                <div className="flex items-center gap-3"><span className="w-3 h-3 bg-emerald-500/20 border border-emerald-500/50 rounded"></span> Sudah Terisi</div>
                <div className="flex items-center gap-3"><span className="w-3 h-3 bg-slate-950 border border-slate-700 rounded"></span> Masih Kosong</div>
              </div>
            </div>
          </div>
        )}

        {/* 5. REVIEW DAN PEMBAHASAN SOAL UNTUK BELAJAR */}
        {view === 'review' && (
          <div className="w-full max-w-4xl bg-slate-900/70 border border-slate-800 p-10 rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.5)] backdrop-blur-md">
            <div className="text-center mb-10 border-b border-slate-800 pb-8 relative">
              <div className="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>
              <div className="w-16 h-16 bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-[0_0_20px_rgba(16,185,129,0.2)] relative z-10">
                <CheckCircle className="w-8 h-8" />
              </div>
              <h2 className="text-4xl font-black text-slate-100 tracking-tight relative z-10">Evaluasi Selesai</h2>
              <p className="text-slate-400 text-base mt-3 font-medium relative z-10 flex items-center justify-center gap-3">
                Skor Akurasi Akhir Anda: 
                <span className="text-emerald-400 font-mono font-black text-2xl px-4 py-1.5 bg-emerald-500/10 rounded-xl border border-emerald-500/30 shadow-inner">
                  {parseFloat(finalScore).toFixed(1)} <span className="text-sm text-emerald-400/60">/ 100</span>
                </span>
              </p>
            </div>

            <div className="space-y-6 max-h-[500px] overflow-y-auto pr-3 custom-scrollbar">
              {examResultSummary.map((item, index) => {
                const studentAns = answers[item.id] || 'KOSONG';
                const isCorrect = studentAns === item.correct_answer;
                return (
                  <div key={item.id} className="p-6 md:p-8 bg-slate-950/80 border border-slate-800 rounded-3xl shadow-inner relative overflow-hidden group hover:border-slate-700 transition-colors">
                    <div className={`absolute top-0 left-0 w-1.5 h-full ${isCorrect ? 'bg-emerald-500' : 'bg-rose-500'}`}></div>
                    
                    <span className="text-[10px] font-black text-slate-500 tracking-widest block mb-2 uppercase">Soal Koreksi {(index + 1).toString().padStart(2, '0')}</span>
                    <p className="text-base font-bold text-slate-200 mb-6 leading-relaxed">{item.question_text}</p>
                    
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                      <div className={`p-4 rounded-xl border font-semibold flex flex-col gap-1 ${isCorrect ? 'bg-emerald-500/5 border-emerald-500/20' : 'bg-rose-500/5 border-rose-500/20'}`}>
                        <span className={`text-[10px] uppercase tracking-wider ${isCorrect ? 'text-emerald-500' : 'text-rose-500'}`}>Jawaban Anda</span>
                        <div className="flex items-center gap-2">
                           <span className={`font-mono font-black px-2 py-0.5 rounded shadow-sm text-sm ${isCorrect ? 'bg-emerald-500 text-slate-950' : 'bg-rose-500 text-slate-950'}`}>{studentAns}</span>
                           <span className={`text-sm ${isCorrect ? 'text-emerald-400' : 'text-rose-400'}`}>{studentAns !== 'KOSONG' ? item[`option_${studentAns.toLowerCase()}`] : 'Tidak Dijawab'}</span>
                        </div>
                      </div>

                      {!isCorrect && (
                        <div className="p-4 bg-slate-900 border border-slate-800 rounded-xl font-semibold flex flex-col gap-1">
                          <span className="text-[10px] uppercase tracking-wider text-slate-500">Kunci Jawaban Valid</span>
                          <div className="flex items-center gap-2">
                             <span className="font-mono font-black px-2 py-0.5 rounded shadow-sm text-sm bg-slate-700 text-emerald-400">{item.correct_answer}</span>
                             <span className="text-sm text-slate-300">{item[`option_${item.correct_answer.toLowerCase()}`]}</span>
                          </div>
                        </div>
                      )}
                    </div>

                    <div className="p-5 bg-[#020617] border border-slate-800 rounded-2xl relative">
                      <span className="text-[10px] font-black tracking-widest uppercase px-3 py-1 bg-slate-900 text-slate-400 rounded-lg border border-slate-800 block w-max mb-3 flex items-center gap-1.5">
                        <BookOpen className="w-3.5 h-3.5" /> Pembahasan
                      </span>
                      <p className="text-sm text-slate-400 leading-relaxed font-medium">{item.explanation || 'Tidak ada catatan pembahasan tambahan untuk lembar soal ini.'}</p>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        )}

        {/* 6. DASHBOARD KONTROL UTAMA PENGAWAS (ADMIN) */}
        {view === 'admin-dashboard' && (
          <div className="w-full max-w-7xl grid grid-cols-1 lg:grid-cols-3 gap-8 items-start animate-fade-in">
            
            {/* PANEL KENDALI PARAMETER */}
            <div className="space-y-6">
              <div className="bg-slate-900/70 border border-slate-800 p-8 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,0.3)] backdrop-blur-md relative overflow-hidden">
                <div className="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>
                <h3 className="text-xs font-black uppercase tracking-widest text-slate-300 mb-6 flex items-center gap-2 pb-3 border-b border-slate-800">
                  <Shield className="w-5 h-5 text-emerald-400" /> Pusat Kendali Operasi
                </h3>
                <div className="space-y-5">
                  <div>
                    <label className="text-[10px] font-bold text-slate-400 uppercase block mb-2 pl-1">Status Gerbang Ujian</label>
                    <div className="flex bg-slate-950 p-1.5 rounded-xl border border-slate-800">
                      <button 
                        type="button" 
                        onClick={() => { setAdminDashboard({...adminDashboard, exam_status: 'waiting'}); handleSaveSettings('waiting'); }} 
                        className={`flex-1 py-2.5 rounded-lg text-xs font-black transition-all duration-300 ${adminDashboard.exam_status === 'waiting' ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20' : 'text-slate-500 hover:text-slate-300'}`}
                      >
                        TUNGGU
                      </button>
                      <button 
                        type="button" 
                        onClick={() => { setAdminDashboard({...adminDashboard, exam_status: 'started'}); handleSaveSettings('started'); }} 
                        className={`flex-1 py-2.5 rounded-lg text-xs font-black transition-all duration-300 ${adminDashboard.exam_status === 'started' ? 'bg-emerald-500 text-slate-950 shadow-md shadow-emerald-500/20' : 'text-slate-500 hover:text-slate-300'}`}
                      >
                        MULAI
                      </button>
                    </div>
                  </div>
                  <div>
                    <label className="text-[10px] font-bold text-slate-400 uppercase block mb-2 pl-1">Token Akses Aktif</label>
                    {/* INPUT DIBUAT READONLY DENGAN TOMBOL GENERATE */}
                    <div className="flex gap-2">
                      <input 
                        type="text" 
                        readOnly // Anti ketik manual
                        value={adminDashboard.current_token} 
                        className="w-full px-4 py-3 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 font-mono text-center tracking-widest text-emerald-400 text-xl font-black shadow-inner cursor-not-allowed" 
                      />
                      <button 
                        type="button"
                        onClick={generateRandomToken}
                        className="bg-emerald-500 hover:bg-emerald-400 text-slate-950 p-3 rounded-xl transition-all shadow-md active:scale-[0.95] flex items-center justify-center group"
                        title="Buat Token Baru"
                      >
                        <RefreshCw className="w-5 h-5 group-active:rotate-180 transition-transform duration-300" />
                      </button>
                    </div>
                  </div>
                  <div>
                    <label className="text-[10px] font-bold text-slate-400 uppercase block mb-2 pl-1">Batas Alokasi Waktu (Detik)</label>
                    <input type="number" value={adminDashboard.exam_duration} onChange={e => setAdminDashboard({...adminDashboard, exam_duration: e.target.value})} className="w-full px-4 py-3 bg-slate-950/80 border border-slate-700/60 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/50 text-sm font-mono font-bold text-slate-200 shadow-inner" />
                  </div>
                  <button onClick={() => handleSaveSettings()} className="w-full bg-slate-100 hover:bg-white text-slate-950 font-black py-3.5 rounded-xl text-xs transition-all duration-200 shadow-lg tracking-wider uppercase transform active:scale-[0.98] mt-2">Terapkan Konfigurasi ✓</button>
                </div>
              </div>
              
              {/* STATUS MONITORING LIVE COUNTER */}
              <div className="bg-slate-900/70 border border-slate-800 p-5 rounded-3xl grid grid-cols-2 gap-4 backdrop-blur-md shadow-xl">
                <div className="bg-slate-950/80 p-5 border border-slate-800/80 rounded-2xl text-center shadow-inner relative overflow-hidden">
                  <div className="absolute top-0 left-0 w-full h-1 bg-slate-700"></div>
                  <span className="text-[10px] uppercase text-slate-500 block font-black tracking-widest">Siswa Terhubung</span>
                  <span className="text-4xl font-mono font-black text-slate-100 mt-2 block">{adminDashboard.total_students}</span>
                </div>
                <div className="bg-slate-950/80 p-5 border border-slate-800/80 rounded-2xl text-center shadow-inner relative overflow-hidden">
                  <div className="absolute top-0 left-0 w-full h-1 bg-emerald-500"></div>
                  <span className="text-[10px] uppercase text-slate-500 block font-black tracking-widest">Selesai Kirim</span>
                  <span className="text-4xl font-mono font-black text-emerald-400 mt-2 block drop-shadow-[0_0_8px_rgba(16,185,129,0.5)]">{adminDashboard.finished_students}</span>
                </div>
              </div>
            </div>

            {/* TABEL RANKING LEADERBOARD REALTIME */}
            <div className="lg:col-span-2 bg-slate-900/70 border border-slate-800 p-8 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,0.3)] backdrop-blur-md flex flex-col h-[525px]">
              <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-5 mb-5 border-b border-slate-800 gap-4">
                <h3 className="text-sm font-black uppercase tracking-widest text-slate-100 flex items-center gap-2">
                  <Trophy className="w-5 h-5 text-amber-400 drop-shadow-[0_0_5px_rgba(251,191,36,0.5)]" /> Papan Peringkat Live
                </h3>
                <div className="flex gap-3 items-center w-full sm:w-auto">
                  <select value={filterLeaderboard.subject} onChange={e => setFilterLeaderboard({...filterLeaderboard, subject: e.target.value})} className="px-4 py-2 bg-slate-950 border border-slate-700 text-slate-200 text-xs rounded-xl outline-none focus:border-emerald-500 font-bold cursor-pointer transition-colors shadow-inner">
                    <option value="python">Materi: Python</option>
                    <option value="logika">Materi: Logika</option>
                  </select>
                  <input type="text" placeholder="Semua Kelas" value={filterLeaderboard.class === 'all' ? '' : filterLeaderboard.class} onChange={e => setFilterLeaderboard({...filterLeaderboard, class: e.target.value.toUpperCase() || 'all'})} className="w-32 px-4 py-2 bg-slate-950 border border-slate-700 text-xs text-center rounded-xl outline-none focus:border-emerald-500 font-bold text-slate-200 placeholder-slate-600 uppercase shadow-inner transition-colors" />
                </div>
              </div>
              
              <div className="flex-grow overflow-y-auto pr-2 custom-scrollbar">
                {leaderboardData.length === 0 ? (
                  <div className="h-full flex flex-col justify-center items-center text-slate-600 gap-3 py-12 select-none">
                    <AlertTriangle className="w-8 h-8 text-slate-700 animate-pulse" />
                    <span className="font-bold tracking-widest text-xs uppercase">Belum ada rekapan nilai</span>
                  </div>
                ) : (
                  <table className="w-full text-left text-xs border-collapse">
                    <thead>
                      <tr className="border-b-2 border-slate-800 text-slate-500 font-black uppercase tracking-widest text-[10px] select-none sticky top-0 bg-slate-900/90 backdrop-blur-sm z-10">
                        <th className="pb-4 pl-3 pt-2">Rank</th>
                        <th className="pb-4 pt-2">Nama Lengkap Siswa</th>
                        <th className="pb-4 text-center pt-2">Kelas</th>
                        <th className="pb-4 text-center pt-2">Mata Pelajaran</th>
                        <th className="pb-4 text-right pr-3 text-emerald-400 pt-2">Skor Akhir</th>
                      </tr>
                    </thead>
                    <tbody>
                      {leaderboardData.map((res, index) => {
                        const rank = index + 1;
                        return (
                          <tr key={res.id} className="border-b border-slate-800/50 text-slate-300 hover:bg-slate-800/30 transition-all duration-200 group">
                            <td className="py-4 pl-3 font-mono font-black text-sm">
                              {rank === 1 ? <span className="text-xl drop-shadow-[0_0_5px_rgba(251,191,36,0.8)]">🥇</span> : rank === 2 ? <span className="text-xl drop-shadow-[0_0_5px_rgba(156,163,175,0.8)]">🥈</span> : rank === 3 ? <span className="text-xl drop-shadow-[0_0_5px_rgba(180,83,9,0.8)]">🥉</span> : <span className="text-slate-500 ml-1">{rank.toString().padStart(2, '0')}</span>}
                            </td>
                            <td className="py-4 font-bold text-slate-200 group-hover:text-emerald-400 transition-colors text-sm">{res.student_name}</td>
                            <td className="py-4 text-center font-mono font-bold text-slate-400">{res.student_class}</td>
                            <td className="py-4 text-center uppercase font-black text-[10px] text-slate-500">
                              <span className="px-2.5 py-1 bg-slate-950 border border-slate-800 rounded-md font-mono">{res.subject}</span>
                            </td>
                            <td className="py-4 text-right pr-3 font-mono font-black text-emerald-400 text-base bg-gradient-to-l group-hover:from-emerald-500/10 from-transparent rounded-r-2xl transition-all">{parseFloat(res.score).toFixed(1)}</td>
                          </tr>
                        );
                      })}
                    </tbody>
                  </table>
                )}
              </div>
            </div>
          </div>
        )}
      </main>

      {/* FOOTER */}
      <footer className="text-center py-5 text-[10px] font-black text-slate-600 tracking-widest uppercase border-t border-slate-900 bg-slate-950/50 select-none relative z-10">
        &copy; {new Date().getFullYear()} X-SYSTEM CORPORATION. ALL RIGHTS RESERVED.
      </footer>
    </div>
  );
}