# Pusat Aktivitas Tim Robotika UNS
Website ini memfasilitasi setiap anggota UKM Robotika UNS untuk dapat bekerja secara terstruktur. Selain itu, website ini dapat memudahkan anggota baru dalam beradaptasi di UKM.
## Anggota Kelompok
| Nama | NIM | Role |
| :---: | --- | :---: |
| Lutfiyah Istiana | L0124022 | Project Manager & Quality Assurance |
| Muhammad Ihza Dzikrullah | L0124024 | UI/UX Designer |
| Rafli Ahmad | L0124030 | Frontend Developer |
| Andre Saputra | L0124038 | Front End Developer |
| Shafa Rifkika Nur Fauziah | L0124031 | Back End Developer |
## Fitur Utama
1. Perencanaan timeline project 
2. Materi pelatihan anggota baru 
3. Dokumentasi project sebelumnya
4. Logbook kegiatan
## Tech Stack
Laravel, PHP, MySQL
## Cara Instalasi dan Menjalankan


## Screenshot

---------------------------------------------------------------------------------------------------------------------------------------
# COLAB
Sistem Manajemen Tugas dengan Studi Kasus Ormawa Robotika

## Deskripsi Proyek
Colab merupakan sistem manajemen tugas berbasis web yang dirancang untuk membantu organisasi mahasiswa (Ormawa) Robotika dalam mengelola tugas, materi pelatihan, serta memantau progres anggota tim. Sistem ini dilengkapi dengan fitur AI Chatbot yang dapat membantu pengguna memahami fitur sistem maupun materi pelatihan yang tersedia.

Colab mendukung lima role pengguna, yaitu Superadmin, Admin, Ketua Tim, Pelatih, dan Anggota Tim, dengan hak akses yang berbeda sesuai tanggung jawab masing-masing.


## Fitur Utama
- Dashboard
- Manajemen Tugas
- Manajemen Materi
- AI Chatbot
- Manajemen User dan Role
- Profile
- AI Chatbot

## Hak Akses dan Role

### Superadmin
Superadmin dapat melihat siapa saja user yang masuk dalam sistem colab beserta role-nya, memiliki semua role, dapat mengubah profil anggota, dapat melihat tugas anggota, dapat melihat material yang ada.

Fitur Superadmin:
    - Dashboard
        Pada dashboard superadmin terdapat user info , dimana di dalamnya terdapat total users, total teams, assigned roles, dan status online.
    - Task
       Pada halaman ini, superadmin dapat melihat atau mengawasi tugas-tugas yang diberikan ketua tim kepada anggota. Terdapat list tugas dengan isi judul, ditujukan kepada siapa, dan deadline. Selain itu juga di dipetakan sesuai status tugas yaitu belum selesai dan tugas selesai.
    - Manage
        Di halaman ini superadmin dapat melihat daftar pengguna (user yang terdaftar pada sistem colab). Selain itu superadmin dapat menambahkan akun bagi pengguna baru, juga dapat mengedit data akun bagi user yang telah terdaftar.
    - Materials
        Superadmin dapat melihat materi yang telah diupload oleh role pelatih.
    - Profil
        Pada profil terdapat data seperti nama, email, prodi, nomor hp, fakultas, username github, divisi, tim, dan daftar hak akses (role).
    - AI Chatbot
        Superadmin dapat mengakses AI Chatbot seperti role - role lainnya.

### Admin
Admin memiliki akses untuk melihat tugas dan materi yang diberikan oleh pelatih dan ketua tim. Admin memiliki role kesemuanya namun tidak memiliki hak akses ke role superadmin.
    - Dashboard
        Pada dashboard admin terdapat statistik tugas, progres tugas, dan daftar tugas yang belum selesai.
    - Task
        Pada halaman task, admin dapat melihat list tugas dengan isi judul, ditujukan kepada siapa, dan deadline. 
    - Materials
        Admin dapat melihat materi yang telah diupload oleh role pelatih.
    - Profil
        Pada profil terdapat data seperti nama, email, prodi, nomor hp, fakultas, username github, divisi, tim, dan daftar hak akses (role).
    - AI Chatbot
        Admin dapat mengakses AI Chatbot seperti role - role lainnya.

### Ketua Tim
Ketua tim memiliki fitur utama yaitu dapat memberikan tugas kepada anggotanya.

    - Dashboard
        Dashboard ketua tim berisi statistik tugas, progres tugas, dan daftar tugas yang belum selesai.
    - Task
       Pada halaman task, ketua dapat menambahkan tugas bagi anggotanya.
        * Judul tugas
        * Ditugaskan kepada (email)
        * Deskripsi tugas
        * Tenggat waktu
        * Lampiran
       Ketua tim juga dapat menghapus tugas yang telah diberikan kepada anggota.
    - Materials
        Ketua tim dapat melihat materi yang telah diupload oleh role pelatih.
    - Profil
        Pada profil terdapat data seperti nama, email, prodi, nomor hp, fakultas, username github, divisi, tim, dan daftar hak akses (role).
    - AI Chatbot
        Ketua tim dapat mengakses AI Chatbot seperti role - role lainnya.


### Pelatih
Pelatih memiliki kewajiban untuk menambahkan atau mengirim file - file materi robotik, agar anggota dapat mengakses materi dimana saja melalui sistem ini.

    - Dashboard
        Pada dashboard hanya berisi jumlah BAB yang ditambahkan dan juga total file yang ditambahkan.
    - Materials
        Pada halaman ini, pelatih dapat menambahkan materi.
            * Divisi yang dituju
            * Judul BAB
            * Deskripsi
            * Upload file materi
    - Profil
        Pada profil terdapat data seperti nama, email, prodi, nomor hp, fakultas, username github, divisi, tim, dan daftar hak akses (role).
    - AI Chatbot
        Ketua tim dapat mengakses AI Chatbot seperti role - role lainnya.

### Anggota Tim
Pada anggota tim memiliki akses untuk melihat tugas, mengirim tugas, dan melihat materi yang diberikan.
    - Dashboard
       Pada dashboard berisi statistik pengerjaan terdapat total tugas, total tugas selesai, total tugas berjalan, dan total tugas terlambat. Dibawahnya terdapat progres tugas dimana setiap anggota tim mengirim tugas, maka progres akan terupdate dan progress akan menambah persentase pengerjaan. Juga terdapat list tugas yang belum selesai.
    - Task
        Pada halaman task, anggota dapat melihat daftar tugas yang diberikan oleh ketua tim. Disini anggota dapat submit tugas dan setelah tersubmit progres akan terupdate.
    - Materials
        Anggota dapat melihat materi dan mengunduh materi yang telah di upload oleh pelatih.
    - Profile
        Pada profil terdapat data seperti nama, email, prodi, nomor hp, fakultas, username github, divisi, tim, dan daftar hak akses (role).
    - AI Chabot
        Ketua tim dapat mengakses AI Chatbot seperti role - role lainnya.

## Screenshot Aplikasi

### Login
[Login](images/ui/ketua_tim/login.png)

### Dashboard
[Dashboard](images/ui/ketua_tim/dashboard.png)

### Task Management
[Task Management](images/ui/ketua_tim/buat-task.png)

### AI Chatbot
[AI Chatbot](images/ui/ketua_tim/AIChatbot.png)

## Prayarat
- PHP 8.3.30
- Composer 2.9.8
- MySQL
- Node.js
- Laravel 12
- NPM 11.13.0
- Git 
- Github
- CSS


## Instalasi
1. Clone repository projek untuk mengambil kode projek
2. Install Depedency PHP
   cmd: composer install
   Perintah ini digunakan untuk mengunduh seluruh package Laravel yang dibutuhkan oleh proyek.
3. Install Dependency JavaScript
   cmd: npm install
   Perintah ini digunakan untuk mengunduh seluruh dependency frontend yang tercantum pada file package.json.  
4. Konfigure Environment
    Buat file .env
5. Konfigurasi Database
    Buat databse di MySQL setelah itu konfigurasi pada file.env
    Bagian DB, password harus sesuai dengan PHPmyAdmin.
6. Migrate Database
    php artisan migrate, perintah ini akan membuat seluruh tabel yang dibutuhkan sistem.
7. Menjalankan Backend Laravel
    cmd : php artisan serve
8. Menjalankan Frontend
    cmd: npm run dev