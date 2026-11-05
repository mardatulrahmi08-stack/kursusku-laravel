# AI Usage Log - Praktikum Pertemuan 9
## Framework Laravel: Bootstrap, jQuery Ajax, dan Form Pendaftaran

**Nama:** Mardatul Rahmi  
**NIM:** 2524234  
**Kelas:** 5G  
**Tanggal:** 3 November 2026  
**Project:** KursusKu - Laravel MVC  
**Lokasi Project:** C:\laragon\www\kursusku-Laravel

---

## 🎯 Tujuan Praktikum

Mengintegrasikan Bootstrap, jQuery, dan Ajax ke dalam aplikasi Laravel untuk membuat form pendaftaran kursus dengan fitur cek sisa kursi secara real-time tanpa reload halaman.

---

## 📋 Daftar Penggunaan AI

### 1. Instalasi dan Konfigurasi Vite dengan Bootstrap & jQuery
**Tanggal:** 3 November 2026  
**Tugas:** Menginstall package npm dan mengkonfigurasi Vite untuk Bootstrap, jQuery, dan Popper.js  

**Prompt yang digunakan:**  
> "Saya sudah install dependencies, apa langkah selanjutnya?"

**Bantuan AI:**  
- Memberikan instruksi untuk mengedit `resources/js/app.js` dengan import Bootstrap dan jQuery
- Memberikan instruksi untuk mengedit `resources/css/app.css` dengan import Bootstrap CSS
- Memandu cara menjalankan `npm run dev` dan memverifikasi jQuery aktif via Console browser dengan perintah `typeof window.jQuery`

**Kode yang dihasilkan:**
```javascript
// resources/js/app.js
import './bootstrap';
import 'bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;