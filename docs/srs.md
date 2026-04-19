## 3. Kebutuhan Fungsional
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

## 4. Kebutuhan Non-Fungsional
NFR-01 (Security): Password akun disimpan menggunakan hashing bcrypt.
NFR-02 (Usability): UI responsif dapat digunakan pada perangkat mobile maupun dekstop.
NFR-03 (Performance): Halaman load < 3 detik pada koneksi 4G standar.
NFR-04 (Maintainability): Website menggunakan framework Laravel dan Tailwind CSS, serta MySQL untuk basis datanya dengan menggunakan gaya penulisan program yang telah disepakati.
