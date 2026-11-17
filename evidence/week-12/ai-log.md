# LOG PENGGUNAAN AI – PERTEMUAN 12

Dokumen ini berisi catatan penggunaan AI selama pelaksanaan Praktikum Pemrograman Web III Pertemuan 12 dengan materi Relasi Database pada proyek KursusKu.

| Prompt / Pertanyaan | Saran AI | Dipakai? | Alasan |
|---------------------|----------|----------|--------|
| Bagaimana cara membuat migration untuk tabel `participants` dan `enrollments` dengan relasi cascade delete? | AI memberikan contoh kode migration lengkap dengan `->foreignId('participant_id')->constrained()->onDelete('cascade')` pada tabel enrollments. | Ya | Agar tabel enrollments otomatis menghapus data terkait saat participant dihapus, menjaga integritas data. |
| Bagaimana membuat relasi Eloquent antara Participant, Course, dan Enrollment? | AI menyarankan menggunakan `hasMany()` di Participant, `belongsTo()` di Enrollment, dan `belongsToMany()` dengan `withPivot('status')` untuk relasi many-to-many. | Ya | Agar Laravel dapat mengelola relasi antar model dengan benar sesuai struktur database. |
| Bagaimana membuat controller CRUD untuk Enrollment dan Participant? | AI memberikan contoh `EnrollmentController.php` dan `ParticipantController.php` dengan method index, create, store, show, edit, update, destroy lengkap dengan validasi. | Ya | Agar fitur CRUD enrollment dan participant dapat berjalan dengan validasi yang tepat. |
| Bagaimana membuat view Blade untuk halaman enrollment (index, create, edit, show)? | AI memberikan contoh file blade dengan form dropdown participant dan course, tabel data, serta tombol aksi. | Ya | Supaya tampilan form dan daftar enrollment sesuai dengan kebutuhan pendaftaran kursus. |
| Bagaimana menguji fitur Cascade Delete berjalan dengan benar? | AI memberikan contoh pengujian melalui Laravel Tinker: membuat enrollment, menghitung count, menghapus participant, lalu verifikasi enrollment ikut terhapus dan course tetap ada. | Ya | Untuk membuktikan bahwa data enrollment yang berhubungan ikut terhapus ketika data induknya (Participant) dihapus. |
| Mengapa error `php: command not found` muncul di terminal VS Code? | AI menjelaskan bahwa PowerShell tidak mengenali PHP karena tidak ada di PATH Windows, dan menyarankan menggunakan Git Bash dari Laragon atau menambah PATH PHP. | Ya | Agar perintah `php artisan` dapat dijalankan di terminal VS Code. |
| Bagaimana cara mengaktifkan Git Bash di terminal VS Code? | AI menyarankan klik dropdown `powershell ∨` di terminal VS Code lalu pilih Git Bash, atau install Git jika belum ada. | Ya | Agar terminal VS Code dapat menjalankan perintah PHP tanpa error. |
| Mengapa di Git Bash Laragon tetap error `bash: php: command not found`? | AI menyarankan restart Laragon (Stop All → Start All) atau menggunakan path lengkap PHP: `/c/laragon/bin/php/php-8.2.0/php.exe`. | Ya | Agar PHP dapat dikenali di environment Git Bash Laragon. |
| Bagaimana membuat seeder untuk data dummy Participant, Course, dan Enrollment? | AI memberikan contoh `DatabaseSeeder.php` dengan data dummy untuk testing cascade delete. | Ya | Agar ada data awal yang bisa digunakan untuk pengujian fitur cascade delete di Tinker. |
| Bagaimana struktur folder project yang benar untuk admin enrollments? | AI menyarankan struktur `resources/views/admin/enrollments/` dengan file index, create, edit, show blade. | Ya | Agar Laravel dapat menemukan view Blade sesuai lokasi controller `Admin\EnrollmentController`. |

## Catatan Penting

- AI digunakan sebagai **alat bantu pembelajaran**, bukan untuk menyelesaikan tugas tanpa pemahaman.
- Setiap kode yang diberikan AI **dipahami dan diuji sendiri** di terminal sebelum digunakan.
- Pengujian cascade delete dilakukan secara **manual di Artisan Tinker** untuk memverifikasi hasil.
- Screenshot evidence diambil langsung dari terminal Laragon sebagai **bukti nyata** pengerjaan.