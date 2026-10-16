<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tugas;

class PageController extends Controller
{
    public function home()
    {
        $stats = [['10k+', 'Pengguna Aktif'], ['50k+', 'Catatan Dibuat'], ['99%', 'Kepuasan Siswa']];
        $features = [
            ['ri-layout-masonry-fill', 'Dashboard Terpadu', 'Pantau semua progres belajar, notifikasi, dan tugas mendatang dalam satu tampilan bersih.'],
            ['ri-calendar-todo-fill', 'Kalender Pintar', 'Atur jadwal kuliah, deadline tugas, dan sesi belajar kelompok tanpa takut terlewat.'],
            ['ri-cloud-fill', 'Penyimpanan Cloud', 'Simpan semua materi PDF, gambar, dan dokumen Anda secara aman dan akses di mana saja.'],
            ['ri-team-fill', 'Ruang Kolaborasi', 'Diskusi real-time dan kerja kelompok lebih efektif dengan fitur kolaborasi video & chat.'],
            ['ri-shield-check-fill', 'Keamanan Data', 'Privasi Anda adalah prioritas kami. Semua data catatan dan dokumen Anda terenkripsi dengan aman.'],
            ['ri-smartphone-fill', 'Akses Multi-Device', 'Beralih dari laptop ke smartphone dengan sinkronisasi instan yang mulus.'],
        ];
        return view('home', compact('stats', 'features'));
    }

    public function dashboard()
    {
        return view('dashboard', [
            'name' => 'John Doe',
            'stats' => [['24', 'Catatan Tersimpan', '#6366f1'], ['8', 'Tugas Minggu Ini', '#10b981'], ['1.2 GB', 'Cloud Digunakan', '#f59e0b']],
            'shortcuts' => [
                ['calendar', 'ri-calendar-todo-line', 'Cek Jadwal', 'Lihat deadline dan agenda belajar harianmu.'],
                ['cloud', 'ri-folder-open-line', 'Buka Cloud', 'Akses semua materi dan file pembelajaran.'],
                ['collaboration', 'ri-group-line', 'Kolaborasi', 'Belajar bareng teman di ruang diskusi.'],
                ['scan', 'ri-camera-lens-line', 'Scan Tulis Tangan', 'Ubah tulisan tangan menjadi catatan digital.'],
            ],
            'languages' => [['en', 'gb', 'Inggris'], ['id', 'id', 'Indonesia'], ['zh', 'cn', 'Mandarin'], ['es', 'es', 'Spanyol'], ['ar', 'sa', 'Arab']],
            'notifications' => [
                ['ri-team-line', '', 'Arief', ' mengundang Anda ke Room Matematika.', '5 menit yang lalu'],
                ['ri-calendar-event-line', 'Tugas ', 'Fisika', ' besok sudah jatuh tempo!', '2 jam yang lalu'],
            ],
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function profile()
    {
        return view('profile', [
            'user' => ['first' => 'Wincarlinn', 'last' => '', 'email' => 'wincarlinn@gmail.com'],
            'tabs' => [
                ['edit', 'ri-user-3-line', 'Info Pribadi'],
                ['security', 'ri-lock-password-line', 'Keamanan'],
                ['notif', 'ri-notification-3-line', 'Notifikasi'],
                ['privacy', 'ri-shield-user-line', 'Privasi'],
            ],
        ]);
    }

    public function calendar(Request $request)
    {
        $month = rescue(
            fn () => Carbon::createFromFormat('!Y-m', $request->query('bulan', now()->format('Y-m'))),
            now()->startOfMonth(),
            false
        );

        $tasks = Tugas::all()->map(fn ($t) => [
            'title'    => $t->judul,
            'time'     => substr($t->waktu, 0, 5),
            'priority' => $t->prioritas,
            'note'     => $t->catatan ?? '',
            'date'     => $t->tanggal->toDateString(),
        ])->sortBy('time')->values();

        return view('calendar', [
            'month' => $month,
            'monthLabel' => $month->copy()->locale('id')->translatedFormat('F Y'),
            'prev' => $month->copy()->subMonth()->format('Y-m'),
            'next' => $month->copy()->addMonth()->format('Y-m'),
            'startDay' => $month->dayOfWeek,
            'daysInMonth' => $month->daysInMonth,
            'daysOfWeek' => ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            'tasks' => $tasks,
        ]);
    }
    public function cloud()
    {
        $used = 12;
        $total = 20;
        return view('cloud', [
            'used' => $used,
            'total' => $total,
            'percent' => round($used / $total * 100),
            'files' => [
                ['Catatan Matematika', 'PDF', '2.3 MB', 'ri-file-pdf-2-line', 'icon-pdf'],
                ['Diagram Sistem', 'PNG', '1.1 MB', 'ri-image-2-line', 'icon-img'],
                ['Folder Tugas Akhir', 'Files', '45 MB', 'ri-folder-3-line', 'icon-fold'],
            ],
        ]);
    }

    public function collaboration()
    {
        return view('collaboration', [
            'chats' => [
                ['Arief Rahmadan', 'AR', '"Sudah saya upload materi integral di folder bersama ya!"', '#6366f1'],
                ['Rara Azizah', 'RA', '"Oke siap, nanti jam 7 kita bahas via video call."', '#10b981'],
            ],
        ]);
    }

    public function scan()
    {
        return view('scan', [
            'scans' => [[
                'id' => 1,
                'name' => 'Catatan_Matematika_Sample.txt',
                'content' => 'Ini adalah contoh hasil scan tulisan tangan Matematika.',
                'date' => '01/06/2026, 10:00:00',
            ]],
        ]);
    }
}