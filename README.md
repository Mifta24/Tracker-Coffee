# README - Tracker Coffee

## Deskripsi

Tracker Coffee adalah sebuah website kafe yang memungkinkan pengguna untuk membeli berbagai jenis kopi, teh, minuman, dan makanan. Website ini dibangun menggunakan PHP 8.20 dan terhubung dengan database MySQL menggunakan phpMyAdmin, HTML, CSS, dan JavaScript dengan framework Bootstrap 5 pada halaman dasbor admin.

## Fitur

1. **Beranda**: Pengguna dapat melihat informasi tentang kafe Tracker Coffee, promosi terbaru, dan menu yang tersedia.

2. **Menu**: Pengguna dapat melihat daftar kopi, teh, minuman, dan makanan yang ditawarkan oleh kafe Tracker Coffee. Setiap item menu memiliki deskripsi, harga, dan gambar.

3. **Pemesanan**: Pengguna dapat memilih item menu yang ingin dipesan dan menambahkannya ke keranjang belanja. Pengguna juga dapat mengatur jumlah item yang akan dipesan.

4. **Keranjang Belanja**: Pengguna dapat melihat item yang telah ditambahkan ke keranjang belanja, melihat subtotal, mengedit jumlah dan menghapus item jika diperlukan. Pengguna dapat melanjutkan ke halaman pembayaran.

5. **Pembayaran**: Pengguna dapat mengisi informasi pengiriman dan memilih metode pembayaran. Setelah mengkonfirmasi pembayaran, pesanan akan diproses.

6. **Dasbor Admin**: Admin memiliki akses ke halaman dasbor admin yang dilindungi kata sandi. Di halaman ini, admin dapat mengelola item menu, mengubah harga, mengunggah gambar, dan menambahkan item baru.

## Pengaturan Pengembangan

1. Pastikan Anda memiliki versi PHP 8.20 atau yang lebih baru terpasang di sistem Anda.

2. Salin repositori ini ke direktori web server Anda.

3. Import file SQL yang disediakan (`tracker_coffee.sql`) ke dalam database MySQL Anda menggunakan phpMyAdmin.

4. Konfigurasikan koneksi database MySQL dengan mengedit berkas `config.php` dan mengganti nilai `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, dan `DB_NAME` sesuai dengan pengaturan Anda.

```php
// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'username_db');
define('DB_PASSWORD', 'password_db');
define('DB_NAME', 'nama_db');
```

5. Akses halaman beranda melalui peramban web dengan mengunjungi URL `http://localhost/tracker-coffee`.

6. Untuk mengakses halaman dasbor admin, buka URL `http://localhost/tracker-coffee/admin` dan masukkan kata sandi yang ditetapkan dalam konfigurasi.

## Kredit

Tracker Coffee dikembangkan oleh Miftahudin Aldi Saputra.

## Kontak

Jika Anda memiliki pertanyaan atau masalah terkait dengan Tracker Coffee, silakan hubungi Miftahudin Aldi Saputra melalui email di miftafree3@gmail.com.

Terima kasih telah menggunakan Tracker Coffee!
