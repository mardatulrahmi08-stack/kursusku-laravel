<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Kursus - KursusKu</title>
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
            background-color: #d63384; /* Pink magenta */
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
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: white;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #d63384;
            box-shadow: 0 0 0 2px rgba(214, 51, 132, 0.2);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #d63384; /* Pink magenta */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #b02a6e; /* Pink lebih gelap */
        }

        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
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
        </div>
    </nav>

    <!-- FORM ENROLLMENT -->
    <div class="container">
        <h1>Tambah Enrollment</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('enrollments.store') }}">
            @csrf

            <div class="form-group">
                <label for="participant_id">Participant</label>
                <select name="participant_id" id="participant_id" required>
                    <option value="">-- Pilih Participant --</option>
                    @foreach($participants as $participant)
                        <option value="{{ $participant->id }}" @selected(old('participant_id') == $participant->id)>
                            {{ $participant->name }} - {{ $participant->email }}
                        </option>
                    @endforeach
                </select>
                @error('participant_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id" required>
                    <option value="">-- Pilih Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                            {{ $course->code }} - {{ $course->name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Simpan Enrollment</button>
        </form>
    </div>

</body>
</html>