<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CourseCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman utama / tetap berjalan normal (fitur lama tidak rusak).
     */
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('KursusKu');
    }

    /**
     * Test halaman daftar kursus dapat dibuka.
     */
    public function test_courses_index_page_is_accessible(): void
    {
        $response = $this->get('/courses');

        $response->assertStatus(200);
        $response->assertSee('Daftar Program Kursus');
    }

    /**
     * Test form tambah kursus dapat dibuka.
     */
    public function test_courses_create_page_is_accessible(): void
    {
        $response = $this->get('/courses/create');

        $response->assertStatus(200);
        $response->assertSee('Tambah Kursus Baru');
    }

    /**
     * Test data kursus berhasil disimpan ke database.
     */
    public function test_can_create_course_successfully(): void
    {
        $courseData = [
            'code'        => 'TEST-01',
            'name'        => 'Test Kursus Laravel',
            'description' => 'Deskripsi untuk pengujian kursus',
            'fee'         => 150000,
            'quota'       => 25,
            'start_date'  => '2026-12-01',
            'status'      => 'open',
        ];

        $response = $this->post('/courses', $courseData);

        $response->assertRedirect('/courses');
        $response->assertSessionHas('success', 'Kursus berhasil ditambahkan!');

        $this->assertDatabaseHas('courses', [
            'code'   => 'TEST-01',
            'name'   => 'Test Kursus Laravel',
            'status' => 'open',
        ]);
    }

    /**
     * Skenario 1: Validasi menolak kode kursus duplikat saat membuat Course.
     */
    public function test_validation_rejects_duplicate_code(): void
    {
        Course::create([
            'code'       => 'DUP-01',
            'name'       => 'Kursus Asli',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ]);

        $duplicateData = [
            'code'        => 'DUP-01',
            'name'        => 'Kursus Duplikat',
            'description' => 'Deskripsi kursus duplikat',
            'fee'         => 100000,
            'quota'       => 20,
            'start_date'  => '2026-12-05',
            'status'      => 'draft',
        ];

        $response = $this->post('/courses', $duplicateData);

        $response->assertSessionHasErrors(['code']);
    }

    /**
     * Skenario 2: Validasi menolak nama kursus kosong.
     */
    public function test_validation_rejects_empty_name(): void
    {
        $data = [
            'code'       => 'VALID-01',
            'name'       => '',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Skenario 3: Validasi menolak nama kurang dari 3 karakter.
     */
    public function test_validation_rejects_name_under_3_chars(): void
    {
        $data = [
            'code'       => 'VALID-02',
            'name'       => 'AB',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Skenario 4: Validasi menolak fee bernilai negatif.
     */
    public function test_validation_rejects_negative_fee(): void
    {
        $data = [
            'code'       => 'VALID-03',
            'name'       => 'Kursus Fee Negatif',
            'fee'        => -50000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertSessionHasErrors(['fee']);
    }

    /**
     * Skenario 5: Validasi menolak quota = 0.
     */
    public function test_validation_rejects_zero_quota(): void
    {
        $data = [
            'code'       => 'VALID-04',
            'name'       => 'Kursus Quota Nol',
            'fee'        => 100000,
            'quota'      => 0,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertSessionHasErrors(['quota']);
    }

    /**
     * Skenario 6: Boundary test quota = 1 diterima.
     */
    public function test_validation_accepts_minimum_quota_one(): void
    {
        $data = [
            'code'       => 'Q-MIN-01',
            'name'       => 'Kursus Quota Minimal',
            'fee'        => 100000,
            'quota'      => 1,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertRedirect('/courses');
        $this->assertDatabaseHas('courses', ['code' => 'Q-MIN-01', 'quota' => 1]);
    }

    /**
     * Skenario 7: Validasi menolak quota = 501.
     */
    public function test_validation_rejects_quota_over_500(): void
    {
        $data = [
            'code'       => 'Q-MAX-501',
            'name'       => 'Kursus Quota 501',
            'fee'        => 100000,
            'quota'      => 501,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertSessionHasErrors(['quota']);
    }

    /**
     * Skenario 8: Boundary test quota = 500 diterima.
     */
    public function test_validation_accepts_maximum_quota_500(): void
    {
        $data = [
            'code'       => 'Q-MAX-500',
            'name'       => 'Kursus Quota Maksimal 500',
            'fee'        => 100000,
            'quota'      => 500,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertRedirect('/courses');
        $this->assertDatabaseHas('courses', ['code' => 'Q-MAX-500', 'quota' => 500]);
    }

    /**
     * Skenario 9: Validasi menolak tanggal invalid.
     */
    public function test_validation_rejects_invalid_date(): void
    {
        $data = [
            'code'       => 'DATE-INV',
            'name'       => 'Kursus Tanggal Invalid',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => 'bukan-tanggal-valid',
            'status'     => 'open',
        ];

        $response = $this->post('/courses', $data);

        $response->assertSessionHasErrors(['start_date']);
    }

    /**
     * Skenario 10: Validasi menolak status 'active' (hanya draft, open, closed).
     */
    public function test_validation_rejects_status_active(): void
    {
        $data = [
            'code'       => 'STAT-ACT',
            'name'       => 'Kursus Status Active',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'active',
        ];

        $response = $this->post('/courses', $data);

        $response->assertSessionHasErrors(['status']);
    }

    /**
     * Skenario 11: Update dengan kode sendiri tanpa perubahan diterima.
     */
    public function test_can_update_course_keeping_same_code(): void
    {
        $course = Course::create([
            'code'       => 'SAME-01',
            'name'       => 'Kursus Awal',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ]);

        $updateData = [
            'code'        => 'SAME-01',
            'name'        => 'Kursus Awal Diperbarui',
            'description' => 'Deskripsi baru',
            'fee'         => 120000,
            'quota'       => 25,
            'start_date'  => '2026-12-10',
            'status'      => 'open',
        ];

        $response = $this->put("/courses/{$course->id}", $updateData);

        $response->assertRedirect("/courses/{$course->id}");
        $response->assertSessionHas('success', 'Data kursus berhasil diperbarui!');
        $this->assertDatabaseHas('courses', [
            'id'   => $course->id,
            'code' => 'SAME-01',
            'name' => 'Kursus Awal Diperbarui',
            'fee'  => 120000,
        ]);
    }

    /**
     * Skenario 12: Update menggunakan kode milik Course lain ditolak.
     */
    public function test_update_rejects_duplicate_code_of_another_course(): void
    {
        $course1 = Course::create([
            'code'       => 'OCCUPIED-01',
            'name'       => 'Kursus Pertama',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ]);

        $course2 = Course::create([
            'code'       => 'SECOND-02',
            'name'       => 'Kursus Kedua',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ]);

        $attemptUpdateData = [
            'code'       => 'OCCUPIED-01', // Milik course 1
            'name'       => 'Nama Baru Kursus Kedua',
            'fee'        => 150000,
            'quota'      => 30,
            'start_date' => '2026-12-05',
            'status'     => 'open',
        ];

        $response = $this->put("/courses/{$course2->id}", $attemptUpdateData);

        $response->assertSessionHasErrors(['code']);
    }

    /**
     * Skenario 13: Update normal diterima dan data berubah.
     */
    public function test_can_update_course_normally(): void
    {
        $course = Course::create([
            'code'        => 'NORM-01',
            'name'        => 'Kursus Normal Lama',
            'description' => 'Deskripsi lama',
            'fee'         => 100000,
            'quota'       => 15,
            'start_date'  => '2026-12-01',
            'status'      => 'draft',
        ]);

        $updateData = [
            'code'        => 'NORM-02',
            'name'        => 'Kursus Normal Baru',
            'description' => 'Deskripsi telah diperbarui',
            'fee'         => 250000,
            'quota'       => 35,
            'start_date'  => '2026-12-15',
            'status'      => 'open',
        ];

        $response = $this->put("/courses/{$course->id}", $updateData);

        $response->assertRedirect("/courses/{$course->id}");
        $response->assertSessionHas('success', 'Data kursus berhasil diperbarui!');
        $this->assertDatabaseHas('courses', [
            'id'          => $course->id,
            'code'        => 'NORM-02',
            'name'        => 'Kursus Normal Baru',
            'description' => 'Deskripsi telah diperbarui',
            'fee'         => 250000,
            'quota'       => 35,
            'status'      => 'open',
        ]);
    }

    /**
     * Skenario 14: Delete Course dummy terhapus dengan benar.
     */
    public function test_can_delete_dummy_course_successfully(): void
    {
        $course = Course::create([
            'code'       => 'DEL-01',
            'name'       => 'Kursus Dummy Siap Dihapus',
            'fee'        => 50000,
            'quota'      => 10,
            'start_date' => '2026-12-01',
            'status'     => 'draft',
        ]);

        $response = $this->delete("/courses/{$course->id}");

        $response->assertRedirect('/courses');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('courses', [
            'id' => $course->id,
        ]);
    }

    /**
     * Skenario 15: Konfirmasi cancel / jika tidak ada delete request maka data tetap ada.
     */
    public function test_course_persists_when_deletion_is_not_dispatched(): void
    {
        $course = Course::create([
            'code'       => 'STAY-01',
            'name'       => 'Kursus Tetap Ada',
            'fee'        => 50000,
            'quota'      => 10,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ]);

        // Pengguna membatalkan aksi pada dialog konfirmasi -> tidak ada request DELETE terkirim
        $this->assertDatabaseHas('courses', ['id' => $course->id, 'code' => 'STAY-01']);
    }

    /**
     * Pengujian Detail Course: Menampilkan data kursus yang ada.
     */
    public function test_can_show_existing_course(): void
    {
        $course = Course::create([
            'code'        => 'SHOW-01',
            'name'        => 'Kursus Detail Test',
            'description' => 'Deskripsi lengkap kursus detail',
            'fee'         => 200000,
            'quota'       => 20,
            'start_date'  => '2026-12-01',
            'status'      => 'open',
        ]);

        $response = $this->get("/courses/{$course->id}");

        $response->assertStatus(200);
        $response->assertSee('SHOW-01');
        $response->assertSee('Kursus Detail Test');
        $response->assertSee('200.000');
        $response->assertSee('20 Kursi');
    }

    /**
     * Pengujian Detail Course: ID tidak ditemukan menghasilkan response 404.
     */
    public function test_show_non_existent_course_returns_404(): void
    {
        $response = $this->get('/courses/99999');

        $response->assertStatus(404);
    }

    /**
     * Pengujian Edit Course: Menampilkan form edit beserta nilai lama dari database.
     */
    public function test_can_open_edit_page_with_course_data(): void
    {
        $course = Course::create([
            'code'        => 'EDIT-01',
            'name'        => 'Kursus Siap Diedit',
            'description' => 'Materi edit kursus',
            'fee'         => 175000,
            'quota'       => 15,
            'start_date'  => '2026-12-05',
            'status'      => 'draft',
        ]);

        $response = $this->get("/courses/{$course->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Edit Data Kursus');
        $response->assertSee('EDIT-01');
        $response->assertSee('Kursus Siap Diedit');
        $response->assertSee('175000');
    }

    /**
     * Pengujian Integritas: Penghapusan dicegah jika ada data pendaftaran (defensive integrity).
     */
    public function test_destroy_prevents_deletion_if_enrollment_exists(): void
    {
        // Buat tabel enrollments sementara di memory sqlite untuk menguji integritas relasi
        Schema::create('enrollments', function ($table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('student_name');
            $table->timestamps();
        });

        $course = Course::create([
            'code'       => 'ENR-01',
            'name'       => 'Kursus Ada Pendaftar',
            'fee'        => 100000,
            'quota'      => 20,
            'start_date' => '2026-12-01',
            'status'     => 'open',
        ]);

        DB::table('enrollments')->insert([
            'course_id'    => $course->id,
            'student_name' => 'Budi Santoso',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $response = $this->delete("/courses/{$course->id}");

        $response->assertRedirect('/courses');
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('courses', ['id' => $course->id]);
    }
}
