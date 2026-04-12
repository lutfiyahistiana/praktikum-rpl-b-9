# User Stories and Acceptance Criteria

## Role:
- Superadmin
- Admin
- Ketua Tim
- Pelatih
- Anggota Tim


## User Stories and Acceptance Criteria
1. **User Story: As a** Superadmin, **I want** memanajemen semua role dalam sistem dan memiliki akses ke semua role mereka, **so that** memudahkan keadaan-keadaan darurat. 

    **Acceptance Criteria:**
    
    **AC-1: Given** manajemen role, akses ke semua role, **When** menjadi superadmin, **Then** memudahkan penyelesaian dalam keadaan darurat.

2. **User Story: As a** Admin, **I Want** membatasi akses hanya untuk anggota internal **so that** materi pembelajaran tidak disalahgunakan pihak luar. 
    
    **Acceptance Criteria:**
    
    **AC-1: Given** saya sudah login, **When** klik tambah pengguna dan diberikan role untuk email pengguna tersebut, **Then** sistem akan memberikan akses sesuai rolenya kepada pengguna tersebut.

3. **User Story: As a** Ketua Tim, I want menetapkan tugas dan target pencapaian pada setiap anggota , **so that** semua anggota tim memiliki arah yang jelas dalam bekerja. 
    
    **Acceptance Criteria:**
    
    **AC-1: Given** halaman tambahkan tugas, **When** ketua memilih anggota lalu memberikan tugas dan deadline, **Then** target tersebut muncul di halaman dan notifikasi anggota yang diberi tugas.

4. **User Story: As a** Ketua Tim, **I want** melihat progress tim, **so that** Ketua Tim tidak kesulitan memantau perkembangan tim. 
    
    **Acceptance Criteria:**
    
    **AC-1: Given** dashboard progres tim pada role ketua tim, **When** anggota memperbarui status tugas, **Then** grafik persentase penyelesaian proyek akan diupdate secara real time

5. **User Story: As a** Pelatih, **I want** memberikan materi pelatihan dan dokumentasi teknis tim, **so that** anggota baru dapat beradaptasi dengan lebih mudah dan anggota lama tetap mendapatkan akses ke materi dengan mudah. 
    
    **Acceptance Criteria:**
    
    **AC-1: Given** menu materi dan dokumentasi pada role pelatih, **When** pelatih membuka menu materi dan dokumentasi, **Then** pelatih dapat menambahkan materi pelatihan dan dokumentasi teknis tim.

6. **User Story: As a** Anggota Tim, **I want** mendapatkan penugasan dan deadline yang jelas, **so that** membuat pekerjaan saya lebih terarah. 
    
    **Acceptance Criteria:**
    
    **AC-1: Given** menu penugasan pada role anggota, **When** anggota membuka menu penugasan, **Then** menampilkan tugas mereka beserta deadlinenya dengan jelas.

7. **User Story: As a** Anggota Tim, **I want** memperbarui progress tugas yang diberikan ketua, **so that** ketua bisa mengetahui apa yang sudah dikerjakan dan terdokumentasi. 
    
    **Acceptance Criteria:**
    
    **AC-1: Given** detail tugas yang diberikan, **When** anggota tim mengisi catatan perkembangan dan mengklik simpan, **Then** status tugas akan ter-update.

8. **User Story: As a** Anggota Tim, **I want** materi pelatihan, **so that** skill saya dalam pembuatan robot dapat meningkat. 
    
    **Acceptance Criteria:**
    
    **AC-1: Given** menu materi dan dokumentasi pada role anggota, **When** anggota membuka menu materi dan dokumentasi, **Then** anggota dapat melihat materi pelatihan dan dokumentasi teknis tim.
