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