<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Carbon\Carbon;

class CourseDummySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Format array: 
        // [code, name, description, fee, quota, start_date, status]
        $rows = [
            // 12 OPEN
            ['WEB-01', 'Laravel Dasar',               'Pengenalan framework Laravel untuk pemula.', 500000, 20, '2026-12-01', 'open'],
            ['WEB-02', 'Laravel Lanjutan',            'Topik advanced seperti Queue, Event, dan Job.', 750000, 15, '2026-12-05', 'open'],
            ['WEB-03', 'Web Modern dengan PHP',       'Pemanfaatan fitur PHP 8+ dalam pengembangan web.', 600000, 25, '2026-12-10', 'open'],
            ['WEB-04', 'Web Modern Responsif',        'CSS Grid, Flexbox, dan Responsive Design.', 650000, 20, '2026-12-12', 'open'],
            ['WEB-05', 'MySQL untuk Web',             'Optimasi query, indexing, dan relasi database.', 550000, 30, '2026-12-15', 'open'],
            ['WEB-06', 'jQuery dan Ajax',             'Manipulasi DOM dan request asynchronous.', 700000, 20, '2026-12-18', 'open'],
            ['WEB-07', 'Bootstrap Praktis',           'Membangun UI cepat dan konsisten dengan Bootstrap 5.', 450000, 40, '2026-12-20', 'open'],
            ['WEB-08', 'REST API Laravel',            'Membangun API yang robust, aman, dan terdokumentasi.', 800000, 15, '2026-12-22', 'open'],
            ['WEB-09', 'Git untuk Tim',               'Version control, branching, dan collaboration.', 400000, 30, '2026-12-25', 'open'],
            ['WEB-10', 'Deploy Aplikasi Web',         'CI/CD dan deployment ke server produksi.', 850000, 10, '2026-12-28', 'open'],
            ['WEB-11', 'Testing Laravel',             'Pest dan PHPUnit untuk memastikan kualitas kode.', 900000, 15, '2026-12-30', 'open'],
            ['WEB-12', 'Keamanan Web Dasar',          'Pencegahan XSS, CSRF, dan SQL Injection.', 750000, 20, '2027-01-05', 'open'],
            
            // 7 CLOSED
            ['DB-01',  'Basis Data Normalisasi',      'Teori dan praktik normalisasi database hingga 3NF.', 500000, 25, '2026-10-01', 'closed'],
            ['DB-02',  'Query Optimization',          'Teknik advanced untuk mempercepat eksekusi query.', 650000, 20, '2026-10-10', 'closed'],
            ['UI-01',  'Desain Antarmuka',            'Prinsip UI/UX dasar untuk software developer.', 550000, 30, '2026-10-15', 'closed'],
            ['UI-02',  'Riset Pengguna',              'Metode riset untuk validasi kebutuhan produk.', 600000, 20, '2026-10-20', 'closed'],
            ['MOB-01', 'Flutter Dasar',               'Pengenalan Dart dan Flutter widget tree.', 700000, 25, '2026-10-25', 'closed'],
            ['MOB-02', 'Flutter State Management',    'Implementasi Provider, Riverpod, dan BLoC.', 800000, 15, '2026-10-30', 'closed'],
            ['NET-01', 'Jaringan Komputer',           'Dasar-dasar jaringan, OSI Layer, dan protokol.', 500000, 30, '2026-11-01', 'closed'],
            
            // 5 DRAFT
            ['AI-01',  'Pengantar Kecerdasan Buatan', 'Konsep dasar AI, Neural Network, dan Machine Learning.', 950000, 20, '2027-02-01', 'draft'],
            ['AI-02',  'Machine Learning Praktik',    'Implementasi model ML sederhana dengan Python.', 1000000, 15, '2027-02-10', 'draft'],
            ['DS-01',  'Python untuk Data',           'Pemanfaatan Pandas, NumPy, dan analisis data.', 850000, 25, '2027-02-15', 'draft'],
            ['DS-02',  'Visualisasi Data',            'Membuat dashboard dan chart interaktif.', 750000, 20, '2027-02-20', 'draft'],
            ['SEC-01', 'Ethical Hacking Dasar',       'Pengenalan cybersecurity dan penetration testing.', 900000, 15, '2027-02-25', 'draft'],
        ];

        foreach ($rows as [$code, $name, $description, $fee, $quota, $start_date, $status]) {
            Course::updateOrCreate(
                ['code' => $code], // Kunci pencarian (jika ada, di-update; jika tidak, di-insert)
                [
                    'name'        => $name,
                    'description' => $description,
                    'fee'         => $fee,
                    'quota'       => $quota,
                    'start_date'  => $start_date,
                    'status'      => $status,
                    'updated_at'  => $now,
                    'created_at'  => $now,
                ]
            );
        }
    }
}