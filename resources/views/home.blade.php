@extends('layouts.app')

@section('title', 'Beranda - KursusKu')

@section('content')
{{-- Hero Section --}}
<section class="py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="badge badge-pink mb-3 px-3 py-2">Kursus teknologi untuk mahasiswa</span>
            <h1 class="display-5 fw-bold">Belajar lebih terarah bersama KursusKu</h1>
            <p class="lead text-secondary">
                Pilih kursus, cek ketersediaan kursi, lalu isi formulir pendaftaran.
            </p>
            <a href="{{ route('enrollments.create') }}" class="btn btn-pink btn-lg">
                Daftar Kursus
            </a>
        </div>
    </div>
</section>

{{-- Kursus Tersedia Section --}}
<section class="py-5">
    <h2 class="h3 mb-4">Kursus Tersedia</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Web Dasar</h5>
                    <p class="card-text text-muted">
                        Mengenal HTML, CSS, dan dasar-dasar membangun halaman web.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">PHP Dasar</h5>
                    <p class="card-text text-muted">
                        Logika pemrograman sisi server dengan PHP.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Laravel Dasar</h5>
                    <p class="card-text text-muted">
                        Route, Blade, dan struktur aplikasi dengan Laravel.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection