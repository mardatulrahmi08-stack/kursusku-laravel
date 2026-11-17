# DOKUMENTASI TEST CASES & HASIL PENGUJIAN OTOMATIS
## PRAKTIKUM PERTEMUAN 10 — LARAVEL DATABASE & CRUD I

- **Project:** KursusKu - Laravel MVC
- **Modul:** Database Migration, Eloquent ORM, dan CRUD I (Create & Read)
- **Framework:** Laravel 13.38.0 / PHP 8.3.33
- **Test Engine:** PHPUnit 12.5.12 (`php artisan test`)
- **Lokasi Project:** `D:\laragon\www\kursusku-Laravel`
- **Tanggal Pengujian:** 4 November 2026

---

## 1. RINGKASAN HASIL PENGUJIAN OTOMATIS

Berdasarkan eksekusi pengujian otomatis terminal (`php artisan test`):

```
   PASS  Tests\Unit\ExampleTest
   ✓ that true is true                                                  0.03s  

   PASS  Tests\Feature\CourseCrudTest
   ✓ home page is accessible                                            0.15s  
   ✓ courses index page is accessible                                   0.08s  
   ✓ courses create page is accessible                                  0.06s  
   ✓ can create course successfully                                     0.18s  
   ✓ validation rejects duplicate code                                  0.09s  
   ✓ validation rejects missing required fields                         0.07s  

   PASS  Tests\Feature\ExampleTest
   ✓ the application returns a successful response                      0.04s  

  Tests:    8 passed (19 assertions)
  Duration: 0.91s
```

| Metrik Pengujian | Nilai Aktual | Keterangan |
|---|---|---|
| **Total Test Cases** | **8** | 7 Feature Tests + 1 Unit Test |
| **Passed** | **8** | Seluruh skenario berhasil (100%) |
| **Failed** | **0** | Tidak ada kegagalan pengujian |
| **Assertions** | **19** | 19 titik verifikasi logika teruji |
| **Durasi Eksekusi** | **0.91s** | Performa pengujian optimal |
| **Status Akhir** | **PASS** | Sistem memenuhi seluruh spesifikasi Pertemuan 10 |

---

## 2. KLASIFIKASI METODE PENGUJIAN

Pengujian pada repositori KursusKu dibagi menjadi dua kategori dengan batasan yang jelas:

1. **Pengujian Otomatis (Automated Testing):**
   - Dilakukan menggunakan framework pengujian PHPUnit melalui perintah `php artisan test`.
   - Menguji integritas routing, controller, response HTTP status code, penolakan validasi server-side, dan persistensi database menggunakan database testing SQLite in-memory (`RefreshDatabase`) untuk menjaga kebersihan database produksi/lokal MySQL.
   - Hasil pengujian pada dokumen ini dicatat secara objektif berdasarkan screenshot hasil eksekusi terminal aktual.

2. **Pengujian Manual (Manual Browser Testing):**
   - Verifikasi langsung melalui antarmuka browser (tampilan halaman beranda, daftar kursus, dan formulir pendaftaran kursus).
   - *Catatan:* Seluruh status PASS yang tercatat di bawah ini mengacu pada hasil pembuktian pengujian otomatis aktual yang tertera pada rekaman pengujian terminal.

---

## 3. MATRIKS RINGKASAN PENGUJIAN OTOMATIS

| No. | ID Pengujian | Nama Test Case | Kategori | Assertions | Status |
|:--:|---|---|---|:--:|:---:|
| 1 | `TC-W10-01` | Home page is accessible | Feature Test | 2 | **PASS** |
| 2 | `TC-W10-02` | Courses index page is accessible | Feature Test | 2 | **PASS** |
| 3 | `TC-W10-03` | Courses create page is accessible | Feature Test | 2 | **PASS** |
| 4 | `TC-W10-04` | Can create course successfully | Feature Test | 3 | **PASS** |
| 5 | `TC-W10-05` | Validation rejects duplicate code | Feature Test | 3 | **PASS** |
| 6 | `TC-W10-06` | Validation rejects missing required fields | Feature Test | 5 | **PASS** |
| 7 | `TC-W10-07` | Unit ExampleTest - that true is true | Unit Test | 1 | **PASS** |
| 8 | `TC-W10-08` | Feature ExampleTest - the application returns a successful response | Feature Test | 1 | **PASS** |

---

## 4. RINCIAN DETAIL TEST CASES PERTEMUAN 10

### TC-W10-01: Home page is accessible
- **ID Pengujian:** `TC-W10-01`
- **Nama Pengujian:** Home page is accessible
- **Tujuan:** Memastikan halaman beranda lama (`GET /`) tetap dapat diakses dengan baik dan tidak mengalami regresi/kerusakan setelah penambahan modul CRUD kursus.
- **Prasyarat:** Server aplikasi Laravel aktif, route `home` terdaftar.
- **Langkah Pengujian:**
  1. Kirim HTTP request dengan method `GET` ke endpoint `/`.
  2. Periksa status response HTTP.
  3. Periksa apakah konten teks identitas KursusKu tampil.
- **Data Uji:** Endpoint `GET /`
- **Hasil yang Diharapkan:** Response mengembalikan status HTTP `200 OK` dan halaman memuat teks `"KursusKu"`.
- **Hasil Aktual:** Status `200 OK` diterima, teks `"KursusKu"` terverifikasi pada response body.
- **Status:** **PASS**

---

### TC-W10-02: Courses index page is accessible
- **ID Pengujian:** `TC-W10-02`
- **Nama Pengujian:** Courses index page is accessible
- **Tujuan:** Memverifikasi bahwa halaman daftar kursus (`GET /courses`) dapat diakses dan merender view `courses.index` secara benar.
- **Prasyarat:** Route `courses.index` terhubung ke `CourseController@index`, migrasi tabel `courses` tersedia.
- **Langkah Pengujian:**
  1. Kirim HTTP request dengan method `GET` ke endpoint `/courses`.
  2. Periksa status response HTTP.
  3. Periksa keberadaan elemen judul daftar kursus pada HTML.
- **Data Uji:** Endpoint `GET /courses`
- **Hasil yang Diharapkan:** Response mengembalikan status HTTP `200 OK` dan memuat teks `"Daftar Program Kursus"`.
- **Hasil Aktual:** Status `200 OK` diterima, view `courses.index` ter-render sempurna beserta teks `"Daftar Program Kursus"`.
- **Status:** **PASS**

---

### TC-W10-03: Courses create page is accessible
- **ID Pengujian:** `TC-W10-03`
- **Nama Pengujian:** Courses create page is accessible
- **Tujuan:** Memverifikasi bahwa halaman form tambah kursus (`GET /courses/create`) dapat dibuka dan merender view formulir dengan benar.
- **Prasyarat:** Route `courses.create` terhubung ke `CourseController@create`.
- **Langkah Pengujian:**
  1. Kirim HTTP request dengan method `GET` ke endpoint `/courses/create`.
  2. Periksa status response HTTP.
  3. Periksa apakah judul form tambah kursus tampil.
- **Data Uji:** Endpoint `GET /courses/create`
- **Hasil yang Diharapkan:** Response mengembalikan status HTTP `200 OK` dan memuat teks `"Tambah Kursus Baru"`.
- **Hasil Aktual:** Status `200 OK` diterima, formulir input tertampil dengan judul `"Tambah Kursus Baru"`.
- **Status:** **PASS**

---

### TC-W10-04: Can create course successfully
- **ID Pengujian:** `TC-W10-04`
- **Nama Pengujian:** Can create course successfully
- **Tujuan:** Memastikan data kursus yang dikirim melalui formulir dengan data valid berhasil divalidasi, disimpan ke tabel `courses` menggunakan Eloquent, dan me-redirect dengan pesan sukses.
- **Prasyarat:** Database terhubung, tabel `courses` siap menerima data.
- **Langkah Pengujian:**
  1. Kirim HTTP request dengan method `POST` ke endpoint `/courses` dengan payload valid.
  2. Periksa apakah response berupa redirect status `302` ke route `/courses`.
  3. Periksa apakah session memiliki flash message success `"Kursus berhasil ditambahkan!"`.
  4. Periksa apakah data kursus tersimpan di tabel database `courses`.
- **Data Uji:**
  ```json
  {
    "code": "TEST-01",
    "name": "Test Kursus Laravel",
    "description": "Deskripsi untuk pengujian kursus",
    "fee": 150000,
    "quota": 25,
    "start_date": "2026-12-01",
    "status": "open"
  }
  ```
- **Hasil yang Diharapkan:** HTTP status `302 Redirect` ke `/courses`, session `success` terisi, data tersimpan di tabel `courses`.
- **Hasil Aktual:** Redirect berhasil ke `/courses`, flash message terverifikasi, asersi `assertDatabaseHas('courses', ...)` berhasil membuktikan data tersimpan.
- **Status:** **PASS**

---

### TC-W10-05: Validation rejects duplicate code
- **ID Pengujian:** `TC-W10-05`
- **Nama Pengujian:** Validation rejects duplicate code
- **Tujuan:** Memverifikasi bahwa sistem validasi server-side secara ketat menolak penambahan kursus dengan kode (`code`) yang sudah terdaftar di database (constraint unique).
- **Prasyarat:** Terdapat data kursus yang sudah tersimpan dengan kode tertentu (misal: `"DUP-01"`).
- **Langkah Pengujian:**
  1. Buat data awal kursus dengan kode `"DUP-01"`.
  2. Kirim request `POST /courses` baru dengan kode yang sama (`"DUP-01"`).
  3. Periksa apakah validasi gagal dan mengembalikan error pada field `code`.
- **Data Uji:** Payload kursus baru dengan `'code' => 'DUP-01'`
- **Hasil yang Diharapkan:** Request ditolak dengan error validasi pada key `code`, data duplikat tidak tersimpan.
- **Hasil Aktual:** `assertSessionHasErrors(['code'])` berhasil mendeteksi penolakan kode duplikat.
- **Status:** **PASS**

---

### TC-W10-06: Validation rejects missing required fields
- **ID Pengujian:** `TC-W10-06`
- **Nama Pengujian:** Validation rejects missing required fields
- **Tujuan:** Memverifikasi bahwa validasi server-side menolak penyimpanan jika kolom-kolom wajib (`code`, `name`, `start_date`, `status`) dikosongkan.
- **Prasyarat:** Endpoint `POST /courses` aktif dengan validasi Form/Controller.
- **Langkah Pengujian:**
  1. Kirim HTTP request `POST` ke `/courses` dengan payload kosong (`[]`).
  2. Periksa apakah response mengembalikan validation errors pada session untuk seluruh field wajib.
- **Data Uji:** Payload kosong `{}`
- **Hasil yang Diharapkan:** Request ditolak dengan error validasi pada field `code`, `name`, `start_date`, dan `status`.
- **Hasil Aktual:** `assertSessionHasErrors(['code', 'name', 'start_date', 'status'])` berhasil mengonfirmasi penolakan field kosong.
- **Status:** **PASS**

---

### TC-W10-07: Unit ExampleTest - that true is true
- **ID Pengujian:** `TC-W10-07`
- **Nama Pengujian:** Unit ExampleTest - that true is true
- **Tujuan:** Memastikan runner pengujian unit bawaan Laravel berjalan dengan normal tanpa kesalahan environment.
- **Prasyarat:** PHPUnit terkonfigurasi.
- **Langkah Pengujian:**
  1. Jalankan test unit dasar `test_that_true_is_true`.
  2. Lakukan assertion boolean `assertTrue(true)`.
- **Data Uji:** Assertion `true === true`
- **Hasil yang Diharapkan:** Test passed dalam 1 assertion.
- **Hasil Aktual:** Test passed (durasi 0.03s).
- **Status:** **PASS**

---

### TC-W10-08: Feature ExampleTest - the application returns a successful response
- **ID Pengujian:** `TC-W10-08`
- **Nama Pengujian:** Feature ExampleTest - the application returns a successful response
- **Tujuan:** Memverifikasi bahwa rute dasar aplikasi mengembalikan HTTP response yang sukses pada test runner bawaan framework.
- **Prasyarat:** Konfigurasi `APP_KEY` dan enkripsi aplikasi valid.
- **Langkah Pengujian:**
  1. Kirim request `GET /`.
  2. Pastikan status response `200 OK`.
- **Data Uji:** Endpoint `GET /`
- **Hasil yang Diharapkan:** Status response HTTP 200.
- **Hasil Aktual:** Status response 200 OK diterima (durasi 0.04s).
- **Status:** **PASS**

---

## 5. CATATAN KEPATUHAN & BATASAN RUANG LINGKUP

1. **Kepatuhan Modul Pertemuan 10 (CRUD I):**
   - Seluruh test case hanya mencakup operasi **Create** (Form Tambah, Validasi, Penyimpanan) dan **Read** (Halaman Daftar Kursus & Halaman Form).
   - Test case untuk materi CRUD II seperti **Edit**, **Update**, dan **Delete** sengaja **tidak ditambahkan** sesuai batasan materi praktikum Pertemuan 10.
2. **Ketiadaan Tabel `registrations`:**
   - Tidak ada pengujian pendaftaran siswa atau tabel `registrations`, menjaga kemurnian pengujian domain kursus.
3. **Integritas Source Code & Database:**
   - Pembuatan dokumen ini tidak mengubah kode sumber aplikasi (`app/`, `routes/`, `database/`, `resources/`).
   - Database MySQL lokal tetap aman dan tidak mengalami reset atau modifikasi.

