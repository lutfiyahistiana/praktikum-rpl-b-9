| Tabel | Kolom | Tipe Data | Constraint | Keterangan |
| :---: | :---: | :---: | :---: | :---: |
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