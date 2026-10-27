# AI Usage Log - Praktikum Pertemuan 7

**Nama:** Mardatul Rahmi  
**NIM:** 2524234  
**Tanggal:** 27 Oktober 2026  
**Mata Kuliah:** Pemrograman Web III  

## Prinsip Penggunaan AI
AI digunakan sebagai **tutor, reviewer, dan partner debugging**.  
AI **TIDAK** digunakan untuk membuatkan seluruh aplikasi Laravel secara otomatis.  
Setiap kode yang diterima dari AI selalu:
1. Dibaca dan dipahami
2. Diterapkan satu langkah per satu
3. Dijalankan dan diuji
4. Dijelaskan kembali dengan kata-kata sendiri

---

## Log Aktivitas

| No | Waktu | Masalah / Tujuan | Prompt Singkat yang Digunakan | Apa yang Diterima / Ditolak |
|----|-------|------------------|-------------------------------|------------------------------|
| 1 | 13:21 | Memahami langkah awal praktikum | "Buatkan langkah-langkah lengkap dengan codingan yang perlu dibuat pada pertemuan 7 ini" | **Diterima:** Panduan bertahap (Route → Controller → View). **Ditolak:** Tidak langsung copy-paste semua, dikerjakan satu per satu. |
| 2 | 13:27 | Menjalankan server Laravel | "Habis ini apa lagi setelah code ." | **Diterima:** Perintah `php artisan serve` dan cara test route pertama. |
| 3 | 13:30 | Membuat folder evidence | "Di sini buat week-07 nya?" | **Diterima:** Penjelasan lokasi folder evidence di project Laravel baru, bukan di prototype lama. |
| 4 | 14:07 | Error `Could not open input file: artisan` | "Knp tidak bisa dijalankan aplikasi php artisan serve" | **Diterima:** Diagnosa bahwa terminal berada di folder yang salah. **Solusi:** `cd kursusku-Laravel` dulu sebelum jalankan artisan. |
| 5 | 16:39 | Error `php is not recognized` | "Knp tidak bisa dijalankan aplikasi php artisan serve yang tahap 4" | **Diterima:** Penjelasan bahwa PowerShell VS Code tidak mengenali PHP. **Solusi:** Gunakan Laragon Terminal. |
| 6 | 17:57 | Gambar tidak muncul (404) | "Cara memunculkan gambar" | **Diterima:** Checklist diagnosa (cek folder public/images, cek nama file, hard refresh). **Ditolak:** Tidak langsung minta AI buatkan gambar. |
| 7 | 17:59 | Mengubah tema warna | "Warnanya ganti jadi pink magenta" | **Diterima:** Kode CSS dengan palet warna pink magenta yang konsisten. **Ditolak:** Tidak mengubah struktur HTML, hanya warna. |
| 8 | 18:30 | Menambahkan gambar ke section illustration | "Tambahkan <img src=...> ke codingan saya" | **Diterima:** CSS `.illustration-img` dan tag img yang diposisikan dengan benar. |
| 9 | 18:37 | Membuat tampilan sesuai screenshot | "Kayak gini seharusnya tulisannya dan warnanya pink magenta" | **Diterima:** Kode lengkap dengan struktur Header, Navbar, Hero, Alur MVC, Kursus, Footer. |
| 10 | 18:40 | Membuat diagram request lifecycle | "Buatkan Diagram request lifecycle" | **Diterima:** Diagram alur Browser → Route → Controller → Blade → Response dalam format flowchart dan sequence diagram. |
| 11 | 18:45 | Meminta AI Usage Log | "Buatkan saya AI usage log" | **Diterima:** Tabel log aktivitas sesuai format panduan praktikum. |

---

## Refleksi Penggunaan AI

### ✅ Yang Membantu
1. **Debugging error** - AI membantu mengidentifikasi penyebab error `artisan not found` dan `php not recognized` dengan cepat.
2. **Penjelasan konsep** - AI menjelaskan perbedaan Route, Controller, dan View dengan analogi yang mudah dipahami.
3. **Konsistensi warna** - AI membantu menerapkan palet warna pink magenta secara konsisten di semua elemen CSS.
4. **Struktur kode** - AI memberikan template kode yang rapi dan sesuai konvensi Laravel.

### ⚠️ Yang Saya Tolak / Batasi
1. **Tidak meminta AI membuatkan seluruh aplikasi** - Saya hanya meminta bantuan per bagian (route saja, controller saja, view saja).
2. **Tidak langsung copy-paste** - Setiap kode yang diterima saya baca, pahami, lalu ketik ulang atau paste dengan pemahaman.
3. **Tidak meminta fitur di luar scope** - Saya tidak meminta AI menambahkan database, CRUD, atau authentication karena belum sesuai materi pertemuan 7.

### 🧠 Pembelajaran yang Didapat
1. **Pentingnya terminal yang benar** - Laragon Terminal sudah dikonfigurasi PATH PHP, sedangkan PowerShell VS Code belum.
2. **Struktur folder Laravel** - File aset (CSS, gambar) harus di folder `public/`, bukan di `resources/`.
3. **Alur MVC** - Request masuk dari Browser → Route (`web.php`) → Controller (`HomeController`) → View (`home.blade.php`) → Response HTML.
4. **Helper `asset()`** - Digunakan untuk menghasilkan URL aset yang benar berdasarkan lokasi folder `public/`.
5. **Sintaks Blade** - `{{ $variable }}` untuk menampilkan data, `@foreach` untuk looping, `route('nama')` untuk named route.

---

## Pertanyaan yang Ingin Ditanyakan di Pertemuan Berikutnya

1. Bagaimana cara memisahkan layout (header, footer) agar tidak ditulis ulang di setiap Blade file?
2. Kapan kita mulai menggunakan Model dan database di project KursusKu?
3. Apa perbedaan `@include` dan `@extends` di Blade?
4. Bagaimana cara membuat form input kursus dengan validasi di Laravel?
