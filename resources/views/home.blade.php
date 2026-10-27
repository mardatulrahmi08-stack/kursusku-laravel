<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteName }} - Laravel MVC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #fdf2f8;
            color: #831843;
            line-height: 1.6;
        }

        /* ====== HEADER ====== */
        header {
            background-color: #db2777;
            color: white;
            padding: 18px 6%;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            background-color: white;
            color: #db2777;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
        }

        .logo h2 {
            font-size: 20px;
            color: white;
            line-height: 1.2;
        }

        .logo p {
            font-size: 12px;
            color: #fce7f3;
            margin-top: 2px;
        }

        .milestone {
            border: 1px solid white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            color: white;
        }

        /* ====== NAVBAR ====== */
        nav {
            background-color: #be185d;
            padding: 12px 6%;
        }

        .nav-links {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 25px;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        nav a:hover {
            color: #fce7f3;
        }

        /* ====== HERO SECTION ====== */
        .hero {
            max-width: 1200px;
            margin: auto;
            padding: 75px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
        }

        .hero-text {
            flex: 1;
        }

        .subtitle {
            color: #db2777;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .hero h1 {
            font-size: 42px;
            line-height: 1.1;
            margin-bottom: 18px;
            color: #831843;
        }

        .description {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 11px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: opacity 0.2s;
        }

        .btn-primary {
            background-color: #db2777;
            color: white;
        }

        .btn-secondary {
            border: 1px solid #f9a8d4;
            color: #831843;
            background-color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .hero-image {
            flex: 1;
            min-width: 0;
        }

        .hero-image img {
            width: 100%;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(219, 39, 119, 0.2);
        }

        /* ====== ALUR MVC SECTION ====== */
        .section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 6%;
        }

        .section-title {
            color: #db2777;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .section-heading {
            font-size: 28px;
            color: #831843;
            margin-bottom: 10px;
        }

        .section-desc {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .flow-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
        }

        .flow-card {
            background: white;
            border: 1px solid #fbcfe8;
            border-radius: 12px;
            padding: 20px 15px;
            text-align: center;
        }

        .flow-number {
            width: 32px;
            height: 32px;
            background-color: #fce7f3;
            color: #db2777;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-weight: bold;
            font-size: 14px;
        }

        .flow-card h4 {
            color: #831843;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .flow-card p {
            color: #9d174d;
            font-size: 11px;
        }

        /* ====== KURSUS SECTION ====== */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .course-card {
            background: white;
            border: 1px solid #fbcfe8;
            border-radius: 12px;
            padding: 22px;
        }

        .badge {
            display: inline-block;
            background-color: #fce7f3;
            color: #db2777;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .course-card h3 {
            color: #831843;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .course-card p {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .course-link {
            color: #db2777;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .course-link:hover {
            color: #be185d;
        }

        /* ====== FOOTER ====== */
        footer {
            background-color: #831843;
            color: white;
            text-align: center;
            padding: 20px 6%;
            font-size: 13px;
            margin-top: 40px;
        }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 900px) {
            .flow-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                padding: 45px 7%;
                gap: 35px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero-text,
            .hero-image {
                width: 100%;
            }

            .course-grid {
                grid-template-columns: 1fr;
            }

            .flow-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            nav {
                flex-wrap: wrap;
            }

            .nav-links {
                flex-wrap: wrap;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <div class="header-top">
            <div class="logo">
                <div class="logo-icon">K</div>
                <div>
                    <h2>{{ $siteName }}</h2>
                    <p>Laravel MVC</p>
                </div>
            </div>
            <span class="milestone">Milestone 7</span>
        </div>
    </header>

    <!-- NAVBAR -->
    <nav>
        <div class="nav-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#alur">Alur MVC</a>
            <a href="#kursus">Kursus Pilihan</a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <main class="hero">
        <section class="hero-text">
            <p class="subtitle">PERTEMUAN 7 · FRAMEWORK LARAVEL</p>
            <h1>Belajar terstruktur dengan Route, Controller, dan Blade.</h1>
            <p class="description">
                Landing page {{ $siteName }} dipindahkan dari PHP biasa ke pola framework Laravel. 
                Request masuk melalui route, data disiapkan controller, lalu Blade merender HTML.
            </p>
            <div class="buttons">
                <a href="#kursus" class="btn btn-primary">Program Belajar Unggulan</a>
                <a href="#alur" class="btn btn-secondary">Lihat Alur MVC</a>
            </div>
        </section>

        <section class="hero-image">
            <img src="{{ asset('images/hero-kursus.jpg') }}" alt="Mahasiswa sedang belajar pemrograman">
        </section>
    </main>

    <!-- ALUR MVC SECTION -->
    <section class="section" id="alur">
        <p class="section-title">MEMAHAMI PROSES</p>
        <h2 class="section-heading">Alur MVC</h2>
        <p class="section-desc">Memahami proses halaman web di dalam Laravel.</p>

        <div class="flow-grid">
            <div class="flow-card">
                <div class="flow-number">1</div>
                <h4>Browser</h4>
                <p>GET /</p>
            </div>
            <div class="flow-card">
                <div class="flow-number">2</div>
                <h4>Route</h4>
                <p>routes/web.php</p>
            </div>
            <div class="flow-card">
                <div class="flow-number">3</div>
                <h4>Controller</h4>
                <p>HomeController</p>
            </div>
            <div class="flow-card">
                <div class="flow-number">4</div>
                <h4>Blade View</h4>
                <p>home.blade.php</p>
            </div>
            <div class="flow-card">
                <div class="flow-number">5</div>
                <h4>Response</h4>
                <p>HTML ke browser</p>
            </div>
        </div>
    </section>

    <!-- KURSUS SECTION -->
    <section class="section" id="kursus">
        <p class="section-title">TINGKATKAN KETERAMPILAN</p>
        <h2 class="section-heading">Program Kursus Pilihan</h2>
        <p class="section-desc">Mulai belajar pemrograman dari dasar dan kembangkan kemampuanmu.</p>

        <div class="course-grid">
            @foreach ($featured as $course)
                <article class="course-card">
                    <span class="badge">{{ $course['code'] }}</span>
                    <h3>{{ $course['name'] }}</h3>
                    <p>{{ $course['description'] }}</p>
                    <a href="#" class="course-link">Mulai Belajar →</a>
                </article>
            @endforeach
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>© 2026 {{ $siteName }}. Belajar, Praktik, Bangun Proyek.</p>
    </footer>

</body>
</html>