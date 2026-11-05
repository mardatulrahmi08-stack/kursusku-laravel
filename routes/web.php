<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController; // <-- TAMBAHKAN BARIS INI

// ==========================================
// 1. ROUTE BERANDA (dari pertemuan sebelumnya)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');


// ==========================================
// 2. ROUTE RESOURCE COURSE (BARU DITAMBAHKAN)
// ==========================================
// Ini akan otomatis membuat 7 route: index, create, store, show, edit, update, destroy
Route::resource('courses', CourseController::class);


// ==========================================
// 3. ROUTE FORM PENDAFTARAN
// ==========================================

// Tampilkan halaman form
Route::get('/pendaftaran', function () {
    $courses = [
        1 => ['name' => 'Web Dasar'],
        2 => ['name' => 'PHP Dasar'],
        3 => ['name' => 'Laravel Dasar'],
    ];

    return view('enrollments.create', compact('courses'));
})->name('enrollments.create');

// Proses submit form
Route::post('/pendaftaran/preview', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'min:3', 'max:100'],
        'email' => ['required', 'email'],
        'course_id' => ['required', 'integer'],
    ]);

    return back()
        ->with('success', 'Form lolos validasi. Database akan ditambahkan pada pertemuan berikutnya.')
        ->withInput();
})->name('enrollments.preview');


// ==========================================
// 4. ROUTE JSON AVAILABILITY (UNTUK AJAX)
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