<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseContent;
use App\Models\Course;
use App\Models\Topic;

class CourseContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa kursus untuk diisi materi
        $courses = Course::with('topics')->take(3)->get();

        if ($courses->isEmpty()) {
            $this->command->warn('Tidak ada kursus yang ditemukan. Jalankan CourseSeeder terlebih dahulu.');
            return;
        }

        foreach ($courses as $course) {
            $this->createCourseContents($course);
        }

        $this->command->info('CourseContentSeeder berhasil dijalankan!');
    }

    private function createCourseContents(Course $course)
    {
        $topics = $course->topics;
        $order = 1;

        // Materi 1: Pengenalan
        CourseContent::create([
            'course_id' => $course->id,
            'topic_id' => $topics->first()?->id,
            'title' => 'Pengenalan ' . $course->title,
            'description' => 'Materi pengenalan untuk memahami dasar-dasar ' . strtolower($course->title),
            'material_content' => $this->getIntroductionContent($course->title),
            'youtube_embed_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'announcement' => 'Selamat datang di kursus ' . $course->title . '! Pastikan Anda sudah menyiapkan alat yang diperlukan.',
            'order' => $order++,
            'is_published' => true,
        ]);

        // Materi 2: Konsep Dasar
        CourseContent::create([
            'course_id' => $course->id,
            'topic_id' => $topics->skip(1)->first()?->id,
            'title' => 'Konsep Dasar ' . $course->title,
            'description' => 'Memahami konsep-konsep fundamental yang perlu dikuasai',
            'material_content' => $this->getBasicConceptsContent($course->title),
            'youtube_embed_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'order' => $order++,
            'is_published' => true,
        ]);

        // Materi 3: Praktik
        CourseContent::create([
            'course_id' => $course->id,
            'topic_id' => $topics->skip(2)->first()?->id,
            'title' => 'Praktik ' . $course->title,
            'description' => 'Sesi praktik untuk menerapkan pengetahuan yang telah dipelajari',
            'material_content' => $this->getPracticeContent($course->title),
            'announcement' => 'Siapkan laptop dan koneksi internet yang stabil untuk sesi praktik ini.',
            'order' => $order++,
            'is_published' => true,
        ]);

        // Materi 4: Studi Kasus
        CourseContent::create([
            'course_id' => $course->id,
            'topic_id' => $topics->skip(3)->first()?->id,
            'title' => 'Studi Kasus ' . $course->title,
            'description' => 'Analisis studi kasus nyata untuk memahami aplikasi praktis',
            'material_content' => $this->getCaseStudyContent($course->title),
            'youtube_embed_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'order' => $order++,
            'is_published' => false, // Materi tersembunyi
        ]);

        // Materi 5: Evaluasi
        CourseContent::create([
            'course_id' => $course->id,
            'topic_id' => $topics->last()?->id,
            'title' => 'Evaluasi dan Penilaian',
            'description' => 'Tes akhir untuk mengukur pemahaman Anda',
            'material_content' => $this->getEvaluationContent($course->title),
            'announcement' => 'Evaluasi akan dibuka setelah semua materi selesai dipelajari.',
            'order' => $order++,
            'is_published' => false, // Materi tersembunyi
        ]);
    }

    private function getIntroductionContent($courseTitle)
    {
        return "Selamat datang di kursus {$courseTitle}!

## Tujuan Pembelajaran
Setelah menyelesaikan kursus ini, Anda akan mampu:
- Memahami konsep dasar {$courseTitle}
- Menerapkan pengetahuan dalam situasi nyata
- Mengembangkan keterampilan praktis

## Prasyarat
- Motivasi tinggi untuk belajar
- Koneksi internet yang stabil
- Waktu minimal 2-3 jam per minggu

## Struktur Kursus
Kursus ini terdiri dari beberapa modul yang akan membawa Anda dari tingkat pemula hingga mahir.

Mari kita mulai perjalanan belajar Anda!";
    }

    private function getBasicConceptsContent($courseTitle)
    {
        return "## Konsep Dasar {$courseTitle}

### 1. Definisi dan Terminologi
Memahami istilah-istilah penting dalam {$courseTitle}:
- Terminologi A: Penjelasan detail
- Terminologi B: Contoh penggunaan
- Terminologi C: Praktik sederhana

### 2. Prinsip Utama
Prinsip-prinsip yang harus dipahami:
- Prinsip 1: Dasar-dasar
- Prinsip 2: Aplikasi praktis
- Prinsip 3: Best practices

### 3. Tools dan Resources
Alat-alat yang akan digunakan:
- Tool A: Fungsi dan cara penggunaan
- Tool B: Tips dan trik
- Resource C: Referensi tambahan

## Latihan
Silakan kerjakan latihan berikut untuk menguji pemahaman Anda.";
    }

    private function getPracticeContent($courseTitle)
    {
        return "## Sesi Praktik {$courseTitle}

### Persiapan
Sebelum memulai praktik, pastikan:
- [ ] Laptop/komputer sudah siap
- [ ] Software yang diperlukan sudah terinstall
- [ ] Koneksi internet stabil
- [ ] Notepad untuk mencatat

### Langkah-langkah Praktik

#### Langkah 1: Setup Environment
1. Buka aplikasi yang diperlukan
2. Konfigurasi awal
3. Verifikasi setup

#### Langkah 2: Praktik Dasar
1. Latihan sederhana
2. Implementasi konsep
3. Troubleshooting umum

#### Langkah 3: Praktik Lanjutan
1. Proyek kecil
2. Optimasi
3. Dokumentasi hasil

### Evaluasi Praktik
Setelah selesai praktik, evaluasi diri Anda:
- Apakah semua langkah berhasil dijalankan?
- Adakah kesulitan yang dihadapi?
- Bagaimana solusi yang ditemukan?

## Catatan Penting
- Jangan ragu untuk bertanya jika mengalami kesulitan
- Dokumentasikan setiap langkah yang dilakukan
- Simpan hasil praktik untuk referensi masa depan";
    }

    private function getCaseStudyContent($courseTitle)
    {
        return "## Studi Kasus: Implementasi {$courseTitle} di Perusahaan XYZ

### Latar Belakang
Perusahaan XYZ adalah perusahaan teknologi yang ingin mengimplementasikan {$courseTitle} untuk meningkatkan efisiensi operasional.

### Tantangan
- Tantangan A: Deskripsi masalah
- Tantangan B: Keterbatasan resources
- Tantangan C: Timeline yang ketat

### Solusi yang Diterapkan
1. **Analisis Kebutuhan**
   - Identifikasi requirements
   - Mapping proses existing
   - Gap analysis

2. **Implementasi**
   - Phase 1: Setup dasar
   - Phase 2: Integrasi
   - Phase 3: Testing

3. **Monitoring dan Evaluasi**
   - KPI yang digunakan
   - Hasil yang dicapai
   - Lesson learned

### Hasil dan Impact
- Peningkatan efisiensi 30%
- Pengurangan biaya operasional 25%
- Kepuasan user meningkat 40%

### Kesimpulan
Studi kasus ini menunjukkan bahwa implementasi {$courseTitle} yang tepat dapat memberikan dampak positif yang signifikan.

## Diskusi
Bagaimana menurut Anda solusi yang diterapkan? Apakah ada alternatif lain yang bisa dipertimbangkan?";
    }

    private function getEvaluationContent($courseTitle)
    {
        return "## Evaluasi Akhir: {$courseTitle}

### Format Evaluasi
Evaluasi ini terdiri dari:
- **Teori (40%)**: Pemahaman konsep
- **Praktik (40%)**: Implementasi skills
- **Studi Kasus (20%)**: Analisis dan solusi

### Materi yang Diujikan
1. Konsep dasar {$courseTitle}
2. Tools dan teknik
3. Best practices
4. Troubleshooting
5. Aplikasi dalam dunia nyata

### Instruksi
- Waktu pengerjaan: 90 menit
- Boleh menggunakan referensi
- Jawab dengan detail dan jelas
- Berikan contoh konkret jika memungkinkan

### Kriteria Penilaian
- **A (90-100)**: Excellent understanding
- **B (80-89)**: Good understanding
- **C (70-79)**: Satisfactory understanding
- **D (60-69)**: Needs improvement
- **F (<60)**: Insufficient understanding

### Tips Sukses
- Baca soal dengan teliti
- Kelola waktu dengan baik
- Berikan jawaban yang terstruktur
- Gunakan contoh yang relevan

## Selamat Mengerjakan!
Semoga evaluasi ini dapat mengukur pemahaman Anda dengan baik.";
    }
}