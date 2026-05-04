| Tabel | Kolom | Tipe Data | Constraint | Keterangan |
| :---: | :---: | :---: | :---: | :---: |
| users | id_user | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT, NOT NULL | id unik untuk setiap users |
| users | name | VARCHAR ()  | NOT NULL | nama dari users |
| users | email | VARCHAR ()  | UNIQUE, NOT NULL | email yang digunakan users |
| users | password | VARCHAR ()  | NOT NULL | kata sandi dari pengguna yang terenkripsi |
| users | role | role ENUM('superadmin','admin','ketua_tim','pelatih','anggota_tim') | NOT NULL, DEFAULT 'anggota'_tim | pilihan role users: superadmin, admin. ketua tim, pelatih, anggota |
| users | created_by | BIGINT UNSIGNED | FOREIGN KEY, NULLABLE | id admin yang bikinin akun |
| users | created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP | waktu pertama kali akun users dibuat |
| users | updated_at | TIMESTAMP | NULLABLE, ON UPDATE CURRENT_TIMESTAMP | waktu saat akun users di perbarui (update) |
| task | id_task | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT, NOT NULL | id unik untuk setiap taks |
| task | title | VARCHAR ()  | NOT NULL | judul dari taks yang diberikan |
| task | description | TEXT | NULLABLE, ON UPDATE CURRENT_TIMESTAMP | dekskripsi dari tugas yang diberikan |
| task | assigned_to | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | id users yang diberikan task (relasi ke users) |
| task | assigned_by | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | id users yang memberikan task (relasi ke users) |
| task | deadline | DATETIME | NULLABLE | tenggat setiap tugas yang diberikan  |
| task | status | ENUM ('pending', 'in_progress', 'done')  | NOT NULL, DEAFULT 'pending' | status tugas, 3 pilihan: pending, in progress, done |
| task | created_at | timestamp | NOT NULL, DEFAULT CURRENT_TIMESTAMP | waktu pertama kali tugas diupload |
| task | updated_at | timestamp | NULLABLE, ON UPDATE CURRENT_TIMESTAMP | waktu pertama kali tugas diupload |
| task_progress | id_task_progress | unsignedBigInteger | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap progres |
| task_progress | task_id | unsignedBigInteger | FOREIGN KEY, NOT NULL | id dari task |
| task_progress | user_id | unsignedBigInteger | FOREIGN KEY, NOT NULL | id dari user |
| task_progress | notes | text | NULLABLE | catatan untuk progress |
| task_progress | percentage | float | NOT NULL, DEFAULT 0 | persentase wajib diisi sesuai progres yang sudah dijalani |
| task_progress | created_at | string | NOT NULL, DEFAULT CURRENT_TIMESTAMP | waktu pertama kali progres tugas diupload |
| materials | id_material | unsignedBigInteger | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap materi |
| materials | title | string | NOT NULL | judul materi |
| materials | description | text | NULLABLE | deskripsi untuk penjelasan materi |
| materials | uploaded_by | string | FOREIGN KEY, NOT NULL  | identitas yang upload materi (relasi ke id users) |
| materials | created_at | timestamp | NOT NULL, DEFAULT CURRENT_TIMESTAMP | waktu pertama kali materi diupload |
| materials | updated_at | timestamp | NULLABLE, ON UPDATE CURRENT_TIMESTAMP | waktu terakhir materi di update |
| material_files | id_material_file | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap materi |
| material_files | material_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | relasi ke tabel materials |
| material_files | file_type | VARCHAR() | NOT NULL | format file (.pdf, .docx) |
| material_files | file_path | VARCHAR() | NOT NULL | path file di server |
| material_files | file_name | VARCHAR() | NOT NULL | nama file |
| material_files | created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP | waktu file diupload |
| chatbot_sessions | id_chatbot_session | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | id unik untuk sesi percakapan dengan chatbot |
| chatbot_sessions | user_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | id user sesi percakapan chatbot |
| chatbot_sessions | created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP | waktu sesi percakapan dengan chatbot pertama kali dibuat |
| chatbot_messages | id_chatbot_message | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap pesan |
| chatbot_messages | session_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | relasi ke tabel chatbot_sessions |
| chatbot_messages | role | ENUM('user', 'assistant) | NOT NULL | penanda siapa yang mengirim pesan |
| chatbot_messages | message | TEXT | NOT NULL | isi pesan teks |
| chatbot_messages | created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP | waktu pesan dikirim/diterima |
| teams | id_team | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap tim |
| teams | team_name | VARCHAR() | NOT NULL | nama tim |
| teams | ketua_team_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | id user yang menjadi ketua, relasi ke user_id |
| teams_members | id_team_member | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap anggota tim |
| teams_members | team_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | relasi ke tabel teams (id_teams) |
| teams_members | anggota_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | relasi ke user_id |
| divisions | id_division | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap divisi (pemrograman, elektronis, manufaktur, dll)  |
| divisions | division_name | VARCHAR() | NOT NULL | nama divisi |
| divisions | ketua_division_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | id user yang menjadi ketua, relasi ke user_id |
| divisions_members | id_division_member | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | id unik untuk setiap anggota tim |
| divisions_members | division_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | relasi ke tabel divisions (id_divisions) |
| divisions_members | anggota_id | BIGINT UNSIGNED | FOREIGN KEY, NOT NULL | relasi ke user_id |