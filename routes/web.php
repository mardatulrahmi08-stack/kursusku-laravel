<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController; // <-- PASTIKAN INI ADA DI ATAS

// ==========================================
// 1. ROUTE BERANDA
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==========================================
// 2. ROUTE RESOURCE COURSE
// ==========================================
Route::resource('courses', CourseController::class);

// ==========================================
// 3. ROUTE JSON AVAILABILITY (AJAX)
// ==========================================
Route::get('/courses/{course}/availability', function (int $course) {
    $availability = [
        1 => ['course' => 'Web Dasar', 'remaining' => 12],
        2 => ['course' => 'PHP Dasar', 'remaining' => 8],
        3 => ['course' => 'Laravel Dasar', 'remaining' => 4],
    ];

    abort_unless(isset($availability[$course]), 404);

    return response()->json($availability[$course]);
})->name('courses.availability');

// ==========================================
// 4. ROUTE ENROLLMENT (PERTEMUAN 12 - BARU)
// ==========================================
// Route ini akan menangani:
// GET  /enrollments        -> index (Laporan)
// GET  /enrollments/create -> create (Form)
// POST /enrollments        -> store (Simpan)
Route::resource('enrollments', EnrollmentController::class)->only(['index', 'create', 'store']);

/* 
======================================================================
CATATAN: ROUTE LAMA '/pendaftaran' TELAH DIHAPUS/DICOMMENT
Alasan: Nama route 'enrollments.create' tidak boleh dobel. 
Route lama menggunakan closure dan data hardcoded, 
sedangkan route baru menggunakan EnrollmentController dan database.
======================================================================
*/