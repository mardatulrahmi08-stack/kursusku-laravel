# 📄 TEST MATRIX - MILESTONE 13

Nama:Mardatul Rahmi
NIM:2524234
Mata Kuliah:Bahasa Pemrograman III (PHP & MySQL)  
Pertemuan:13  
**Tanggal Pengujian:** 18 November 2026  

| No | Skenario | Input | Expected | Actual | Status |
|:---:|:---|:---|:---|:---|:---:|
| 1 | 0 hasil | `q=xyz123tidakada` | Empty state tampil, tanpa error | Muncul pesan *"Tidak ada kursus yang sesuai dengan pencarian atau filter."* | **PASS** |
| 2 | 1 hasil | `q=WEB-08` | Tepat 1 Course tampil | *(uji di browser, isi hasilnya)* | ⬜ |
| 3 | Lebih dari 10 hasil | `status=open` | Page 1 max 10 + pagination | Muncul 10 data di Page 1, info *"Showing 1 to 10 of 12 results"*, tombol **Next »** aktif | **PASS** |
| 4 | Keyword dengan spasi | `q=Web Modern` | Keyword terbaca benar | *(uji di browser, isi hasilnya)* | ⬜ |
| 5 | Filter + page 2 | `status=open` lalu klik **Next »** | `q`/`status` tetap terjaga di URL | URL berubah menjadi `?status=open&page=2`, data Page 2 tampil (WEB-03, WEB-04) | **PASS** |

---

### 📌 Catatan Pengujian

- **Skenario 1, 3, 5** sudah diuji langsung di browser dan didokumentasikan dalam screenshot evidence (`02-empty-state-0-hasil.png`, `03-page2-query-tetap.png`).
- **Skenario 2 dan 4** masih perlu diuji ulang di browser, lalu isi kolom **Actual** sesuai hasil nyata yang terlihat.
- Sesuai aturan integritas akademik PDF (Bagian 19): kolom **Actual** dan **Status** diisi **setelah** pengujian nyata, bukan sebelum.