Role:
    Superadmin
    Admin
    Ketua Tim
    Pelatih
    Anggota Tim

As a Superadmin, I want memanajemen semua role dalam sistem dan memiliki akses ke semua role mereka, so that memudahkan keadaan-keadaan darurat. 
AC-1: Given manajemen role, akses ke semua role, When menjadi superadmin, Then memudahkan penyelesaian dalam keadaan darurat.

As a Admin, I Want membatasi akses hanya untuk anggota internal so that materi pembelajaran tidak disalahgunakan pihak luar. 
AC-1: GIven saya sudah login, When klik tambah pengguna dan diberikan role untuk email pengguna tersebut, Then sistem akan memberikan akses sesuai rolenya kepada pengguna tersebut.


As a Ketua Tim, I want menetapkan tugas dan target pencapaian pada setiap anggota , So That semua anggota tim memiliki arah yang jelas dalam bekerja. 
AC-1: Given halaman tambahkan tugas When ketua memilih anggota lalu memberikan tugas dan deadline, Then target tersebut muncul di halaman dan notifikasi anggota yang diberi tugas.

As a Ketua Tim, I want melihat progress tim, So That saya tidak kesulitan memantau perkembangan tim. 
AC-1: Given dashboard progres tim pada role ketua tim, When anggota memperbarui status tugas, Then grafik persentase penyelesaian proyek akan diupdate secara real time

As a Pelatih, I want memberikan materi pelatihan dan dokumentasi teknis tim, so that anggota baru dapat beradaptasi dengan lebih mudah dan anggota lama tetap mendapatkan akses ke materi dengan mudah. 
AC-1: Given menu materi dan dokumentasi pada role pelatih, When pelatih membuka menu materi dan dokumentasi, Th	en pelatih dapat menambahkan materi pelatihan dan dokumentasi teknis tim.

As a Anggota Tim, I want mendapatkan penugasan dan deadline yang jelas, so that membuat pekerjaan saya lebih terarah. 
AC-1: Given menu penugasan pada role anggota, When anggota membuka menu penugasan, Then menampilkan tugas mereka beserta deadlinenya dengan jelas.

As a Anggota Tim, I want memperbarui progress tugas yang diberikan ketua, So That ketua bisa mengetahui apa yang sudah dikerjakan dan terdokumentasi. 
AC-1: Given detail tugas yang diberikan When anggota tim mengisi catatan perkembangan dan mengklik simpan, Then status tugas akan ter update

As a Anggota Tim, I want materi pelatihan so that dapat meningkatkan skill dalam pembuatan robot. 
AC-1: Given menu materi dan dokumentasi pada role anggota, When anggota membuka menu materi dan dokumentasi, Then anggota dapat melihat materi pelatihan dan dokumentasi teknis tim.
