1. Pendahuluan
Software Requirements Specification (SRS) ini disusun untuk mendefinisikan secara lengkap seluruh spesifikasi kebutuhan aplikasi manajemen tim berbasis web yang terintegrasi dengan AI Chatbot. Dokumen ini dibuat sebagai acuan utama untuk seluruh bagian yang terlibat dalam aplikasi ini seperti developer, tim manajemen robotika, ketua tim, pelatih, dan anggota dalam proses perancangan, pengembangan, dan pengujian sistem. Dengan adanya SRS ini, diharapkan fungsionalitas sistem yang dibangun dapat secara tepat menyelesaikan masalah komunikasi, alur kerja yang tidak terorganisir, serta mengamankan materi perlatihan agar ekslusif untuk internal UKM robotika.
Sistem ini merupakan sebuah platform manajemen tim yang berfungsi sebagai pusat kendali tugas dan penyimpanan materi. Sistem ini dirancang secara fleksibel agar dapat digunakan dalam jangka panjang meskipun terjadi pergantian pengurus atau pelatih, selain itu terdapat batasan pengguna yang membuat sistem ini tertutup hanya bisa diakses oleh pengguna di dalam lingkup internal robotika.
Daftar definisi istilah:
- Superadmin: Peran sistem tertinggi yang dipegang oleh developer, memiliki hak akses penuh terhadap semua role pengguna untuk keperluan manajemen darurat dan pemeliharaan sistem.
- Admin: Pengguna yang merepresentasikan level manajerial yang berwenang memberikan dan membatasi hak akses setiap akun yang bergabung ke dalam sistem.
- AI ChatBot: Fitur implementasi kecerdasan buatan yang disediakan untuk memudahkan mencari informasi materi dan menunjang dalam koordinasi tim, dengan batasan pemahaman pada konteks yang sederhana.

2. Deskripsi Umum

Aplikasi manajemen tim berbasis web ini dirancang untuk digunakan dalam lingkup internal UKM Robotika sebagai sistem terpusat dalam pengelolaan aktivitas tim. Fitur-fitur dari sistem ini mencangkup pengelolaan tugas, laporan progres tugas, dan penyimpanan materi. Sistem ini dibuat sebagai platform tertutup yang hanya dapat diakses oleh internal UKM Robotika. Dalam penggunaannya, setiap pengguna wajib melakukan registrasi untuk dapat mengakses sistem, proses validasi akan dilakukan oleh tim developer untuk memastikan bahwa hanya anggota UKM yang dapat mengakses dan menjaga keamanan data dan materi dari pihak luar. Diberikan fitur AI ChatBot yang akan memudahkan pengguna dalam mencari informasi materi dan menunjang dalam koordinasi tim.


Fungsi utama dari aplikasi ini adalah 
- Manajemen tim yang meliputi pemberian tugas, pembagian tugas, dan pemantauan progres tugas oleh ketua tim, admin,maupun pelatih.
- Pengunggahan dan penyimpanan materi-materi robotika yang dapat diakses oleh admin dan pelatih.
- Ruang materi yang dapat diakses semua role terutama anggota tim untuk melihat materi.
- Manajemen utama yang dapat membuat, menghapus, mengubah, dan mengakses semua fitur oleh Superadmin.


Karakteristik pengguna:
- Superadmin dapat mengakses keseluruhan manajemen dalam aplikasi ini dan pemeliharaan sistem.
- Admin (Manajer, Ketua Umum, Dosen Pembina) berfokus pada manajemen utama dalam aplikasi ini dalam pemantauan progres dan pengelolaan internal Robotik.
- Ketua Tim bertanggung jawab atas tim dan berfokus pada detail operasional proyek, pembagian tugas, dan perencanaan target tim.
- Pelatih berfokus pada pemberian materi dan kurikulum dari UKM Robotika.
- Anggota Tim adalah pengguna yang dapat mengakses materi dan pengerjaan tugas yang telah diberikan.

4. Kebutuhan Non-Fungsional
NFR-01 (Security): Password akun disimpan menggunakan hashing bcrypt.
NFR-02 (Usability): UI responsif dapat digunakan pada perangkat mobile maupun dekstop.
NFR-03 (Performance): Halaman load < 3 detik pada koneksi 4G standar.
NFR-04 (Maintainability): Website menggunakan framework Laravel dan Tailwind CSS, serta MySQL untuk basis datanya dengan menggunakan gaya penulisan program yang telah disepakati.


Batasan dari aplikasi ini adalah
- Sistem dikembangkan berbasis web yang tertaut dengan koneksi internet
- Sistem hanya dapat digunakan oleh internal UKM Robotika
- Keterbatasan AI ChatBot yang mungkin hanya memahami konteks sederhana


5. Catatan

    5.1. Hak akses <br>
    Pengguna yang dapat memiliki hak akses adalah pengguna yang telah mendapatkan akun dari pihak manajemen UKM Robotika. Pengguna dengan akun tersebut hanya dapat mengakses hal-hal yang diizinkan untuk role pada akun tersebut.
    
    5.2. Sistem
    - Sistem bergantung pada koneksi internet dan tidak ada fitur penggunaan secara offline.
    - Sistem tidak bertanggung jawab atas validitas isi materi, melainkan hanya sebagai media penyimpanan dan distribusi.