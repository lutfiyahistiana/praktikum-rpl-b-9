## <u>1. Pendahuluan</u>
### 1.1 Tujuan Dokumen
Software Requirements Specification (SRS) ini disusun untuk mendefinisikan secara lengkap seluruh spesifikasi kebutuhan aplikasi manajemen tim berbasis web yang terintegrasi dengan AI Chatbot. Dokumen ini dibuat sebagai acuan utama untuk seluruh bagian yang terlibat dalam aplikasi ini seperti developer, tim manajemen robotika, ketua tim, pelatih, dan anggota dalam proses perancangan, pengembangan, dan pengujian sistem. Dengan adanya SRS ini, diharapkan fungsionalitas sistem yang dibangun dapat secara tepat menyelesaikan masalah komunikasi, alur kerja yang tidak terorganisir, serta mengamankan materi perlatihan agar ekslusif untuk internal UKM robotika.
### 1.2 Ruang Lingkup
Sistem ini merupakan sebuah platform manajemen tim yang berfungsi sebagai pusat kendali tugas dan penyimpanan materi. Sistem ini dirancang secara fleksibel agar dapat digunakan dalam jangka panjang meskipun terjadi pergantian pengurus atau pelatih, selain itu terdapat batasan pengguna yang membuat sistem ini tertutup hanya bisa diakses oleh pengguna di dalam lingkup internal robotika.
### 1.3 Definisi dan Akronim
Daftar definisi istilah:
- Superadmin: Peran sistem tertinggi yang dipegang oleh developer, memiliki hak akses penuh terhadap semua role pengguna untuk keperluan manajemen darurat dan pemeliharaan sistem.
- Admin: Pengguna yang merepresentasikan level manajerial yang berwenang memberikan dan membatasi hak akses setiap akun yang bergabung ke dalam sistem.
- AI ChatBot: Fitur implementasi kecerdasan buatan yang disediakan untuk memudahkan mencari informasi materi dan menunjang dalam koordinasi tim, dengan batasan pemahaman pada konteks yang sederhana.

## <u>2. Deskripsi Umum</u>
### 2.1 Perspektif Produk
Aplikasi manajemen tim berbasis web ini dirancang untuk digunakan dalam lingkup internal UKM Robotika sebagai sistem terpusat dalam pengelolaan aktivitas tim. Fitur-fitur dari sistem ini mencangkup pengelolaan tugas, laporan progres tugas, dan penyimpanan materi. Sistem ini dibuat sebagai platform tertutup yang hanya dapat diakses oleh internal UKM Robotika. Dalam penggunaannya, setiap pengguna hanya dapat login menggunakan akun yang diberikan oleh admin untuk memastikan bahwa hanya anggota UKM yang dapat mengakses dan menjaga keamanan data dan materi dari pihak luar. Diberikan fitur AI ChatBot yang akan memudahkan pengguna dalam mencari informasi materi dan menunjang dalam koordinasi tim.
### 2.2 Fungsi Produk
Fungsi utama dari aplikasi ini adalah 
- Manajemen tim yang meliputi pemberian tugas, pembagian tugas, dan pemantauan progres tugas oleh ketua tim, admin,maupun pelatih.
- Pengunggahan dan penyimpanan materi-materi robotika yang dapat diakses oleh admin dan pelatih.
- Ruang materi yang dapat diakses semua role terutama anggota tim untuk melihat materi.
- Manajemen utama yang dapat membuat, menghapus, mengubah, dan mengakses semua fitur oleh Superadmin.
### 2.3 Karakteristik Pengguna
Karakteristik pengguna:
- Superadmin dapat mengakses keseluruhan manajemen dalam aplikasi ini dan pemeliharaan sistem.
- Admin (Manajer, Ketua Umum, Dosen Pembina) berfokus pada manajemen utama dalam aplikasi ini dalam pemantauan progres dan pengelolaan internal Robotik.
- Ketua Tim bertanggung jawab atas tim dan berfokus pada detail operasional proyek, pembagian tugas, dan perencanaan target tim.
- Pelatih berfokus pada pemberian materi dan kurikulum dari UKM Robotika.
- Anggota Tim adalah pengguna yang dapat mengakses materi dan pengerjaan tugas yang telah diberikan.
### 2.4 Batasan
Batasan dari aplikasi ini adalah
- Sistem dikembangkan berbasis web yang tertaut dengan koneksi internet
- Sistem hanya dapat digunakan oleh internal UKM Robotika
- Keterbatasan AI ChatBot yang mungkin hanya memahami konteks sederhana

## <u>3. Kebutuhan Fungsional</u>
FR-01 : Sistem harus memungkinkan Superadmin untuk membuat, mengubah, menghapus, dan mengakses semua hak akses role yang ada di dalam sistem untuk keperluan manajemen. 
Priority : High | Ref : US-01

FR-02 : Sistem menyediakan fitur bagi Admin untuk menambahkan pengguna baru menggunakan alamat email dan menetapkan role tertentu untuk membatasi akses hanya untuk pihak internal. 
Priority : High | Ref : US-02

FR-03 : Sistem memungkinkan Ketua Tim untuk memilih anggota, menginput deskripsi tugas, serta menetapkan tanggal deadline, yang kemudian akan dikirimkan ke anggota yang dituju. 
Priority : High | Ref : US-3

FR-04 : Sistem menampilkan Dashboard Progres yang menampilkan grafik persentase penyelesaian tugas anggota tim secara visual kepada ketua tim. 
Priority : High | Ref : US-3

FR-05 : Sistem menyediakan antarmuka bagi Pelatih untuk menambah, mengubah, atau menghapus dokumentasi teknis tim pada repositori pusat. 
Priority : High | Ref : US-4

FR-06 : Sistem menyediakan fitur unggah untuk berbagai format materi pelatihan seperti pdf, image,  link video. 
Priority : High | Ref : US-4

FR-07 : Sistem menampilkan daftar penugasan spesifik untuk setiap pengguna, dengan deskripsi tugas dan tanggal tenggat waktu. 
Priority : High | Ref : US-5

FR-08 : Sistem harus kolom input progress pada setiap detail tugas agar anggota dapat memberikan progres tugas untuk ditampilkan kepada ketua. 
Priority : High | Ref : US-5

FR-09 : Sistem memberikan akses baca read only kepada Anggota Tim untuk melihat dan mengunduh materi pelatihan serta dokumentasi teknis yang telah diunggah oleh Pelatih. 
Priority : High | Ref : US-5

FR-10 : Sistem menyediakan AI kepada Anggota Tim untuk menjelaskan mengenai materi pelatihan yang belum dipahami oleh Anggota Tim.
Priority : Medium | Ref : US-9

## <u>4. Kebutuhan Non-Fungsional</u>
NFR-01 (Security): Password akun disimpan menggunakan hashing bcrypt.
NFR-02 (Usability): UI responsif dapat digunakan pada perangkat mobile maupun dekstop.
NFR-03 (Performance): Halaman load < 3 detik pada koneksi 4G standar.
NFR-04 (Maintainability): Website menggunakan framework Laravel dan Tailwind CSS, serta MySQL untuk basis datanya dengan menggunakan gaya penulisan program yang telah disepakati.

## <u>5. Catatan</u>
### 5.1. Hak akses
Pengguna yang dapat memiliki hak akses adalah pengguna yang telah mendapatkan akun dari pihak manajemen UKM Robotika. Pengguna dengan akun tersebut hanya dapat mengakses hal-hal yang diizinkan untuk role pada akun tersebut.
### 5.2. Sistem
- Sistem bergantung pada koneksi internet dan tidak ada fitur penggunaan secara offline.
- Sistem tidak bertanggung jawab atas validitas isi materi, melainkan hanya sebagai media penyimpanan dan distribusi.