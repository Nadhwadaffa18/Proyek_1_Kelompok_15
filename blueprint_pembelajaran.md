# Blueprint Aplikasi Pembelajaran Berbasis Digital

## 1. Gambaran Umum

Aplikasi pembelajaran berbasis digital adalah sistem yang digunakan
untuk mendukung proses belajar mengajar secara online maupun hybrid.
Aplikasi ini memungkinkan guru dan siswa berinteraksi, mengakses materi,
serta melakukan evaluasi pembelajaran secara digital.

## 2. Tujuan Aplikasi

-   Mempermudah proses belajar mengajar
-   Menyediakan akses materi kapan saja dan di mana saja
-   Meningkatkan interaksi antara guru dan siswa
-   Mempermudah evaluasi dan penilaian

## 3. Fitur Utama

### 3.1 Manajemen Pengguna

-   Login & register
-   Role user (admin, guru, siswa)
-   Profil pengguna

### 3.2 Materi Pembelajaran

-   Upload materi (PDF, video, dokumen)
-   Kategori materi per kelas/mapel
-   Akses materi sesuai kelas

### 3.3 Kelas Online

-   Jadwal kelas
-   Forum diskusi
-   Pengumuman guru

### 3.4 Tugas & Assignment

-   Guru membuat tugas
-   Siswa mengumpulkan tugas
-   Deadline otomatis
-   Penilaian tugas

### 3.5 Kuis & Ujian

-   Soal pilihan ganda & essay
-   Timer ujian
-   Penilaian otomatis

### 3.6 Penilaian (Gradebook)

-   Rekap nilai
-   Performa siswa
-   Export nilai

### 3.7 Notifikasi

-   Pengingat tugas
-   Informasi kelas
-   Update materi

## 4. Arsitektur Sistem

-   Frontend: Web (HTML, CSS, JavaScript / TailwindCSS)
-   Backend: Laravel 
-   Database: MySQL / phpmyadmin
-   Storage: Local server / Cloud storage

## 5. Struktur Database (Sederhana)

-   users (id, name, email, password, role)
-   classes (id, name, teacher_id)
-   materials (id, class_id, title, file_url)
-   assignments (id, class_id, title, deadline)
-   submissions (id, assignment_id, student_id, file_url, grade)
-   quizzes (id, class_id, title)
-   quiz_questions (id, quiz_id, question, answer)

## 6. Alur Sistem

1.  User login
2.  Guru membuat kelas dan materi
3.  Siswa bergabung ke kelas
4.  Siswa mengakses materi
5.  Guru memberikan tugas/kuis
6.  Siswa mengerjakan dan mengumpulkan
7.  Guru memberi nilai

## 7. Pengembangan Lanjutan

-   Integrasi video conference (Zoom/Google Meet)
-   AI tutor / chatbot pembelajaran
-   Mobile app (Android/iOS)
-   Sistem gamifikasi (poin & badge)

## 8. Kesimpulan

Aplikasi ini dirancang untuk mempermudah proses pembelajaran digital
yang lebih interaktif, efisien, dan fleksibel.
