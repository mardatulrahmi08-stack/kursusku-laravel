# DOKUMENTASI TEST CASES & HASIL PENGUJIAN OTOMATIS
## PRAKTIKUM PERTEMUAN 11 — LARAVEL DATABASE & CRUD II (READ, UPDATE, DELETE & FORM REQUEST)

- **Project:** KursusKu - Laravel MVC
- **Modul:** Resource Controller, Form Request Validation, Route Model Binding, Detail, Edit, Update, Delete & Data Integrity
- **Framework:** Laravel 13.38.0 / PHP 8.3.33
- **Test Engine:** PHPUnit 12.5.40 (`php vendor/phpunit/phpunit/phpunit`)
- **Lokasi Project:** `D:\laragon\www\kursusku-Laravel`
- **Tanggal Pengujian:** 5 November 2026

---

## 1. RINGKASAN HASIL PENGUJIAN OTOMATIS

Berdasarkan eksekusi pengujian suite otomatis terminal (`php vendor/phpunit/phpunit/phpunit --testdox`):

```text
Course Crud (Tests\Feature\CourseCrud)
 ✔ Home page is accessible
 ✔ Courses index page is accessible
 ✔ Courses create page is accessible
 ✔ Can create course successfully
 ✔ Validation rejects duplicate code
 ✔ Validation rejects empty name
 ✔ Validation rejects name under 3 chars
 ✔ Validation rejects negative fee
 ✔ Validation rejects zero quota
 ✔ Validation accepts minimum quota one
 ✔ Validation rejects quota over 500
 ✔ Validation accepts maximum quota 500
 ✔ Validation rejects invalid date
 ✔ Validation rejects status active
 ✔ Can update course keeping same code
 ✔ Update rejects duplicate code of another course
 ✔ Can update course normally
 ✔ Can delete dummy course successfully
 ✔ Course persists when deletion is not dispatched
 ✔ Can show existing course
 ✔ Show non existent course returns 404
 ✔ Can open edit page with course data
 ✔ Destroy prevents deletion if enrollment exists

Example (Tests\Feature\Example)
 ✔ The application returns a successful response

Example (Tests\Unit\Example)
 ✔ That true is true

OK (25 tests, 64 assertions)
```

| Metrik Pengujian | Nilai Aktual | Keterangan |
|---|---|---|
| **Total Test Cases** | **25** | 23 Feature Tests CRUD + 2 Example Tests |
| **Passed** | **25** | Seluruh skenario berhasil (100%) |
| **Failed** | **0** | Tidak ada kegagalan pengujian |
| **Assertions** | **64** | 64 titik verifikasi logika dan data teruji |
| **Durasi Eksekusi** | **1.61s** | Performa pengujian optimal |
| **Status Akhir** | **PASS** | Memenuhi seluruh spesifikasi Pertemuan 11 |

---

## 2. KLASIFIKASI METODE PENGUJIAN

1. **Pengujian Otomatis (Automated Testing):**
   - Dilakukan menggunakan framework pengujian PHPUnit pada environment testing in-memory SQLite (`RefreshDatabase`) untuk menjaga keutuhan 8 data kursus utama pada database produksi/lokal MySQL `kursusku_laravel`.
   - Menguji integritas routing resource, form request validation (`StoreCourseRequest`, `UpdateCourseRequest`), rule validasi boundary (`quota` 1-500, `fee` >= 0, `name` 3-120), unique validation ignoring self pada update, flash message session, HTTP PUT & DELETE spoofing, serta penanganan 404 pada data tidak ditemukan.

2. **Pengujian Manual Browser (Manual Browser Verification):**
   - Diperuntukkan bagi verifikasi interaksi visual browser, styling antarmuka UI/UX palet KursusKu, penempatan pesan error `invalid-feedback`, dan dialog konfirmasi penghapusan JavaScript `confirm()`.

---

## 3. MATRIKS TEST CASES (15 SKENARIO UTAMA & INTEGRITAS)

| No | Nama Skenario | Input / Tindakan | Expected Result | Actual Result | Status | Saran Bukti Screenshot |
|:--:|---|---|---|---|:---:|---|
| 1 | Duplicate code saat create | POST `/courses` dengan code yang sudah terdaftar di DB (`DUP-01`) | Validasi gagal, session error pada field `code` | Session memiliki error `code`, redirect kembali ke form | **PASS** | `01-create-duplicate-code-error.png` |
| 2 | Nama kosong saat create | POST `/courses` dengan field `name` bernilai string kosong `""` | Validasi gagal, session error pada field `name` | Session memiliki error `name`, redirect kembali | **PASS** | `02-create-empty-name-error.png` |
| 3 | Nama kurang dari 3 karakter | POST `/courses` dengan field `name` berisi 2 karakter (`"AB"`) | Validasi gagal, pesan minimal 3 karakter | Session error `name` minimal 3 karakter | **PASS** | `03-create-short-name-error.png` |
| 4 | Fee negatif saat create | POST `/courses` dengan `fee` bernilai negatif (`-50000`) | Validasi gagal, fee tidak boleh negatif | Session error `fee` bernilai negatif | **PASS** | `04-create-negative-fee-error.png` |
| 5 | Quota = 0 (Boundary Bawah Gagal) | POST `/courses` dengan `quota` bernilai `0` | Validasi gagal, quota harus antara 1-500 | Session error `quota`, form menampilkan error | **PASS** | `05-create-zero-quota-error.png` |
| 6 | Quota = 1 (Boundary Bawah Lolos) | POST `/courses` dengan `quota` bernilai `1` | Validasi berhasil, data tersimpan dengan quota 1 | Redirect ke `/courses`, database menyimpan `quota = 1` | **PASS** | `06-create-min-quota-success.png` |
| 7 | Quota = 501 (Boundary Atas Gagal) | POST `/courses` dengan `quota` bernilai `501` | Validasi gagal, quota melebihi batas 500 | Session error `quota` tertolak | **PASS** | `07-create-max-quota-error.png` |
| 8 | Quota = 500 (Boundary Atas Lolos) | POST `/courses` dengan `quota` bernilai `500` | Validasi berhasil, data tersimpan dengan quota 500 | Redirect ke `/courses`, database menyimpan `quota = 500` | **PASS** | `08-create-max-quota-success.png` |
| 9 | Tanggal invalid saat create | POST `/courses` dengan `start_date` bukan format tanggal (`"bukan-tanggal-valid"`) | Validasi gagal, format tanggal tidak valid | Session error `start_date`, form menampilkan error | **PASS** | `09-create-invalid-date-error.png` |
| 10 | Status `active` saat create | POST `/courses` dengan `status` bernilai `"active"` | Validasi gagal, hanya menerima draft, open, closed | Session error `status`, data ditolak | **PASS** | `10-create-invalid-status-error.png` |
| 11 | Update dengan code sendiri tanpa perubahan | PUT `/courses/{id}` dengan code yang sama persis milik kursus tersebut | Validasi unik mengabaikan diri sendiri, data terupdate | Redirect ke `/courses/{id}`, flash success tampil | **PASS** | `11-edit-update-same-code-success.png` |
| 12 | Update dengan code milik Course lain | PUT `/courses/{id}` dengan code milik kursus lain yang sudah ada | Validasi unik menolak kode duplikat kursus lain | Session error `code`, update dibatalkan | **PASS** | `12-edit-update-duplicate-code-error.png` |
| 13 | Update normal data kursus | PUT `/courses/{id}` dengan data valid yang diubah | Data di DB terupdate, redirect ke detail `/courses/{id}` | Status 302 ke show, data berubah di DB, flash success muncul | **PASS** | `13-edit-update-success.png` |
| 14 | Delete Course dummy | DELETE `/courses/{id}` pada kursus dummy tanpa pendaftaran | Kursus terhapus dari DB, redirect ke index dengan flash success | Kursus terhapus dari database, pesan sukses tampil di `/courses` | **PASS** | `14-delete-course-success.png` |
| 15 | Cancel dialog konfirmasi Delete | Klik "Batal" / Cancel pada dialog JavaScript browser `confirm()` | Form DELETE tidak disubmit, data kursus tetap utuh | Aksi delete dibatalkan di browser, kursus tetap ada di daftar | **PASS** | `15-delete-cancel-confirmation.png` |

---

## 4. PEMERIKSAAN TAMBAHAN FITUR & INTEGRITAS

| No | Pemeriksaan | Input / Tindakan | Hasil yang Diharapkan | Hasil Aktual | Status | Saran Bukti Screenshot |
|:--:|---|---|---|---|:---:|---|
| 16 | Show Course yang tersedia | GET `/courses/{id}` dengan ID valid | Menampilkan seluruh detail (kode, nama, deskripsi, biaya, kuota, tanggal, status) | Halaman detail tampil rapi dengan status 200 OK | **PASS** | `16-show-course-detail.png` |
| 17 | Show Course ID tidak ditemukan | GET `/courses/99999` (ID fiktif) | Mengembalikan HTTP 404 Not Found | Response status 404 Not Found | **PASS** | `17-show-404-not-found.png` |
| 18 | Edit menampilkan data lama | GET `/courses/{id}/edit` | Form terisi nilai awal dari database | Form menampilkan data tersimpan, input terisi | **PASS** | `18-edit-form-prefilled.png` |
| 19 | Error muncul dekat field | Submit form tidak valid di `/courses/create` atau edit | Input berkelas `.is-invalid` dan muncul teks `.invalid-feedback` di bawah field | Class `is-invalid` dan elemen `invalid-feedback` tampil tepat di bawah field | **PASS** | `19-validation-feedback-inline.png` |
| 20 | Flash success message | Setelah Create, Update, atau Delete | Alert hijau dengan pesan sukses muncul di halaman tujuan | Alert sukses tampil dengan styling palet KursusKu | **PASS** | `20-flash-success-alert.png` |
| 21 | Proteksi Relasi Enrollment | DELETE `/courses/{id}` yang memiliki data pendaftaran di tabel enrollments | Penghapusan ditolak, redirect ke index dengan flash error | Data kursus tetap aman, flash error tampil | **PASS** | `21-delete-protected-enrollment.png` |

