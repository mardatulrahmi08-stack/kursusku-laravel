<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // ← TAMBAHKAN BARIS INI
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Menampilkan daftar course dengan Search, Filter, dan Pagination
     */
    public function index(Request $request)
    {
        // 1. Ambil parameter dari URL
        $search = trim((string) $request->query('q'));
        $status = trim((string) $request->query('status'));
        
        // 2. Whitelist status yang valid (sesuai panduan + 'active' untuk data lama Anda)
        $allowedStatuses = ['open', 'closed', 'draft', 'active'];

        // 3. Query Builder
        $courses = Course::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, $allowedStatuses, true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString(); // PENTING: agar q dan status tidak hilang saat pindah halaman

        // 4. Kirim data ke view
        return view('courses.index', compact('courses', 'search', 'status'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        Course::create($request->validated());

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return to_route('courses.show', $course)
            ->with('success', 'Kursus berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return to_route('courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}