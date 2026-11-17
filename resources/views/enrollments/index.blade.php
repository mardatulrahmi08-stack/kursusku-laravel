<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Enrollment - KursusKu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
        }

        /* NAVBAR PINK MAGENTA */
        .navbar {
            background-color: #d63384;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .navbar-menu {
            display: flex;
            gap: 20px;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .navbar-menu a:hover {
            text-decoration: underline;
        }

        /* CONTAINER */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 3px solid #d63384;
            padding-bottom: 10px;
        }

        /* PESAN SUKSES */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        /* TOMBOL TAMBAH */
        .btn-tambah {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d63384;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin-bottom: 20px;
            transition: background-color 0.2s;
        }

        .btn-tambah:hover {
            background-color: #b02a6e;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
        }

        thead tr {
            background-color: #d63384;
            color: white;
        }

        th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #c2185b;
        }

        td {
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            color: #333;
        }

        tbody tr:nth-child(even) {
            background-color: #fce4ec; /* Pink muda untuk baris genap */
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tbody tr:hover {
            background-color: #f8bbd0; /* Pink lebih gelap saat hover */
        }

        /* BADGE STATUS */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-registered {
            background-color: #d63384;
            color: white;
        }

        .badge-completed {
            background-color: #28a745;
            color: white;
        }

        .badge-cancelled {
            background-color: #dc3545;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: #6c757d;
            font-style: italic;
        }
    </style>
</head>
<body>

    <!-- NAVBAR PINK MAGENTA -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">KursusKu</a>
        <div class="navbar-menu">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('courses.index') }}">Daftar Kursus</a>
            <a href="{{ route('enrollments.create') }}">Pendaftaran</a>
            <a href="{{ route('enrollments.index') }}">Laporan</a>
        </div>
    </nav>

    <!-- KONTEN LAPORAN -->
    <div class="container">
        <h1>Laporan Enrollment KursusKu</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('enrollments.create') }}" class="btn-tambah">+ Tambah Enrollment</a>

        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Participant</th>
                    <th>Course</th>
                    <th>Start Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $index => $enrollment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $enrollment->participant->name }}</td>
                        <td>{{ $enrollment->course->name }}</td>
                        <td>{{ $enrollment->course->start_date?->format('d-m-Y') ?? '-' }}</td>
                        <td>
                            <span class="badge badge-{{ $enrollment->status }}">
                                {{ ucfirst($enrollment->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">Belum ada enrollment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>