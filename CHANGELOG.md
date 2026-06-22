## [1.0.0] - 2026-06-22

### Added
- Login pengguna dengan email dan password yang terverifikasi
- Pembagian hak akses multi-role untuk super admin, admin, ketua tim, pelatih, dan anggota tim
- Sistem manajemen tugas termasuk pembuatan tugas oleh ketua tim, detail tugas, dan update progress tugas oleh anggota tim
- Fitur manajemen materi pembelajaran yang memungkinkan pelatih mengunggah, mengedit, dan menghapus materi, serta role lain beserta pelatih dapat mengunduh materi
- Fitur manajemen akun (tambah akun, edit akun, manage role) untuk role super admin dan admin
- Dashboard spesifik yang menampilkan data berbeda setiap masing-masing role nya
- Fitur manajemen profil untuk memperbarui informasi dan foto profil pengguna
- Chatbot interaktif untuk membantu pengguna

### Fixed
- Bug pada sistem keamanan akses halaman agar pengguna tidak bisa lagi membuka menu yang bukan merupakan hak akses role nya
- Bug pada fitur manajemen profil ketika memperbarui informasi atau foto profil, pembaruan tidak tersimpan, ketika logout pembaruan terhapus 
- Bug pada material ketika materi dibuka atau dklik akan menampilkan halaman not found

### Changed
- Alur halaman pertama website langsung menampilkan halaman login
- Mengubah struktur navigasi dengan menambahkan fitur switch role bagi pengguna yang memiliki hak akses lebih dari satu role

### Removed
- Menghapus halaman bawaan laravel yang tidak terpakai.
