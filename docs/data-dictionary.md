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