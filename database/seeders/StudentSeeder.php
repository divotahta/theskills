<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{ 
    
    public function run(): void
    {
        $students =[
            [
             "Nama Lengkap" => "Bhre Himawan ",
             "NamaAkun" => "BhreTS",
             "Course" => ["875bd9de-0110-407b-95a7-616c117b8fe2"],
             "Sekolah" => "Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "swarassari@gmail.com",
             "Nomor Telphon" => "082322529788"
            ],
            [
             "Nama Lengkap" => "Kanaya Wynona Chrismihadi",
             "NamaAkun" => "KanayaTS",
             "Course" => ["9c2dc53e-a419-40db-8973-c7b242387819"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Perumahan Jatinegara Baru, Jl. Gunung Salak CA No. 34, Penggilingan, Cakung, Jakarta Timur 13940",
             "Email" => "kanaya.wynona.chr@gmail.com",
             "Nomor Telphon" => "08122144783"
            ],
            [
             "Nama Lengkap" => "Kayana Wistara",
             "NamaAkun" => "KayanaTS",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "HS Pewaris Bangsa",
             "Asal Kota" => "Indonesia",
             "Email" => "kay.satriatna@piwulangbecik.org",
             "Nomor Telphon" => "081221515136"
            ],
            [
             "Nama Lengkap" => "Janice Tiffany Chahyadi ",
             "NamaAkun" => "JaniceTS",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "Homeschooling ",
             "Asal Kota" => "Indonesia",
             "Email" => "dessy.samuel@gmail.com",
             "Nomor Telphon" => "087824607464"
            ],
            [
             "Nama Lengkap" => "Gaozhan Raisafdhal Irfangi",
             "NamaAkun" => "GaozhanTS",
             "Course" => ["48786967-5b7f-4583-94ef-d3b1730eec23"],
             "Sekolah" => "Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "effie.adji@gmail.com",
             "Nomor Telphon" => "081219274879"
            ],
            [
             "Nama Lengkap" => "Kenzie",
             "NamaAkun" => "KenzieTS",
             "Course" => ["d21fb6d5-de8a-483c-a1ee-164d13f5b97a", "e686dd6d-e740-41f3-a687-04308780f8c4"],
             "Sekolah" => "SDIT Insan Mulia Surakarta ",
             "Asal Kota" => "Indonesia",
             "Email" => "dianp.wibawa@gmail.com",
             "Nomor Telphon" => "081328282660"
            ],
            [
             "Nama Lengkap" => "Hudzaifah Abdurrahman Hannan",
             "NamaAkun" => "HudzaifahTS",
             "Course" => ["941f7427-57f4-497a-a504-746d7570ef8c", "06266603-6247-4a0f-8ddc-d34dd66a787d"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "laila.utari@gmail.com",
             "Nomor Telphon" => "085271933237"
            ],
            [
             "Nama Lengkap" => "Jedi Abdiel",
             "NamaAkun" => "JediTS",
             "Course" => ["b1092657-3ff6-4904-9641-9c4f9a835bff"],
             "Sekolah" => "SDK Penabur Harapan Indah",
             "Asal Kota" => "Jakarta Garden City, Jl. Alamanda XVI no. 286, Cakung, Jakarta Timur 13910",
             "Email" => "yohanna.irma.mulyadi@gmail.com",
             "Nomor Telphon" => "08119410410"
            ],
            [
             "Nama Lengkap" => "Ayun Prayogo",
             "NamaAkun" => "AyunTS",
             "Course" => ["d21fb6d5-de8a-483c-a1ee-164d13f5b97a"],
             "Sekolah" => "SD N Plus Tunas Global Depok",
             "Asal Kota" => "Indonesia",
             "Email" => "listra.mindo@gmail.com",
             "Nomor Telphon" => "082114638279"
            ],
            [
             "Nama Lengkap" => "Margaret",
             "NamaAkun" => "MargaretTS",
             "Course" => ["9c2dc53e-a419-40db-8973-c7b242387819"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "kartiikahartono.ebc@gmail.com",
             "Nomor Telphon" => "081310258937"
            ],
            [
             "Nama Lengkap" => "Muhammad Izzuddin el fakhri ",
             "NamaAkun" => "MuhammadTS",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "Homeschooling pkbm zam-zam ",
             "Asal Kota" => "Indonesia",
             "Email" => "mamaizzilove@gmail.com",
             "Nomor Telphon" => "082115001221"
            ],
            [
             "Nama Lengkap" => "Kelana Faisal",
             "NamaAkun" => "KelanaTS",
             "Course" => ["48786967-5b7f-4583-94ef-d3b1730eec23"],
             "Sekolah" => "Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "kelana.faisal@piwulangbecik.org",
             "Nomor Telphon" => "085643909698"
            ],
            [
             "Nama Lengkap" => "Kania Faisal",
             "NamaAkun" => "KaniaTS",
             "Course" => ["0e2cb0e9-2764-4445-a44e-e136223c7f33"],
             "Sekolah" => "Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "kania.faisal@piwulangbecik.org",
             "Nomor Telphon" => "085643909697"
            ],
            [
             "Nama Lengkap" => "Kainan Azka Nerissa",
             "NamaAkun" => "KainanTS",
             "Course" => ["06266603-6247-4a0f-8ddc-d34dd66a787d"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "kecilzone@gmail.com",
             "Nomor Telphon" => "081336047880"
            ],
            [
             "Nama Lengkap" => "Raissa Valerin Nerissa",
             "NamaAkun" => "RaissaTS",
             "Course" => ["d21fb6d5-de8a-483c-a1ee-164d13f5b97a"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "kecilzone@gmail.com",
             "Nomor Telphon" => "081336047880"
            ],
            [
             "Nama Lengkap" => "Gwyneth Rheine (Gwen)",
             "NamaAkun" => "GwynethTS",
             "Course" => ["d501cdae-4b52-47c8-873c-b0d9b3d98a73"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "nataleeyachna@gmail.com",
             "Nomor Telphon" => "081908881770"
            ],
            [
             "Nama Lengkap" => "Thayden Hananya Nommensen Siahaan ",
             "NamaAkun" => "ThaydenTS",
             "Course" => ["d501cdae-4b52-47c8-873c-b0d9b3d98a73"],
             "Sekolah" => "Homeschooling ",
             "Asal Kota" => "The Golden Stone Cluster Agate Blok G11",
             "Email" => "tristan.trevyn@gmail.com",
             "Nomor Telphon" => "08179279896"
            ],
            [
             "Nama Lengkap" => "Kenzie Avicenna Wihardama",
             "NamaAkun" => "KenzieATS",
             "Course" => ["91267b96-9162-4539-a3fd-38b351ff3b1d", "48786967-5b7f-4583-94ef-d3b1730eec23"],
             "Sekolah" => "SD. Al Furqon Jember",
             "Asal Kota" => "Dsn. Krasak ds. Pancakarya kec. Ajung Jember",
             "Email" => "dinawati.fkip@unej.ac.id",
             "Nomor Telphon" => "082143279422"
            ],
            [
             "Nama Lengkap" => "Evan Bodhikumaro Tjan",
             "NamaAkun" => "EvanTS",
             "Course" => ["91267b96-9162-4539-a3fd-38b351ff3b1d"],
             "Sekolah" => "Piwulang Becik",
             "Asal Kota" => "Perum Villa Tamara Samarinda Kaltim 75123",
             "Email" => "kusalacitta@gmail.com",
             "Nomor Telphon" => "085330200802"
            ],
            [
             "Nama Lengkap" => "Arkaan Ghaniyy Farras Rahmanta",
             "NamaAkun" => "ArkaanTS",
             "Course" => ["91267b96-9162-4539-a3fd-38b351ff3b1d"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Jl. Pahlawan Seribu, cluster Santiago F7-21, Delatinos. Tangerang Selatan",
             "Email" => "ihok149@gmail.com \/ faurista.arkaci@gmail.com",
             "Nomor Telphon" => "081346870936"
            ],
            [
             "Nama Lengkap" => "Keanu Ahnaf Kurniawan",
             "NamaAkun" => "KeanuTS",
             "Course" => ["91267b96-9162-4539-a3fd-38b351ff3b1d", "48786967-5b7f-4583-94ef-d3b1730eec23"],
             "Sekolah" => "SD Al furqon Jember",
             "Asal Kota" => "Perum Jawa asri cc 4 kec. Sumbersari kab. Jember provinsi. Jatim",
             "Email" => "Idakeikurniawan@gmail.com",
             "Nomor Telphon" => "082334805333"
            ],
            [
             "Nama Lengkap" => "Kasih Fabian",
             "NamaAkun" => "KasihTS",
             "Course" => ["875bd9de-0110-407b-95a7-616c117b8fe2"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "nabilahasanah1301@gmail.com",
             "Nomor Telphon" => "82245820849"
            ],
            [
             "Nama Lengkap" => "Hadiyan Mahdiyyan",
             "NamaAkun" => "HadiyanTS",
             "Course" => ["875bd9de-0110-407b-95a7-616c117b8fe2"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Jl. Ikan Gurami 2 No 6 Perak Surabaya ",
             "Email" => "anisafebria07@gmail.com",
             "Nomor Telphon" => "85646011600"
            ],
            [
             "Nama Lengkap" => "Muhammad Jalaludin A.",
             "NamaAkun" => "MuhammadTS",
             "Course" => ["875bd9de-0110-407b-95a7-616c117b8fe2"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "rizkiakbar.petrol@gmail.com",
             "Nomor Telphon" => "8568076875"
            ],
            [
             "Nama Lengkap" => "Naura Hafidza Khairana",
             "NamaAkun" => "NauraTS",
             "Course" => ["875bd9de-0110-407b-95a7-616c117b8fe2"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "ikacansay@gmail.com",
             "Nomor Telphon" => "82137971886"
            ],
            [
             "Nama Lengkap" => "Aufa Atqiya",
             "NamaAkun" => "AufaTS",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "britaniasari@gmail.com",
             "Nomor Telphon" => "8118442010"
            ],
            [
             "Nama Lengkap" => "Ansell Xavier Arfianto",
             "NamaAkun" => "KenzieATS",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "febe.arianti.axa@gmail.com",
             "Nomor Telphon" => "82262122442"
            ],
            [
             "Nama Lengkap" => "Iccha TS",
             "NamaAkun" => "IcchaTS",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "lydiachandra81@gmail.com",
             "Nomor Telphon" => "81225639002"
            ],
            [
             "Nama Lengkap" => "Tristan TS",
             "NamaAkun" => "TristanTS",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "The Golden Stone Cluster Agate Blok G11",
             "Email" => "tristan.trevyn@gmail.com",
             "Nomor Telphon" => "08179279896"
            ],
            [
             "Nama Lengkap" => "Lindy Lea Lonardi",
             "NamaAkun" => "LindyTS",
             "Email" => "LindyTS@gmail.com",
             "Course" => ["9a9e5f33-730b-4c4e-af53-c40fd9232229"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Cengkareng indah KC No.20 RT.007 RW.014 Kel.Kapuk Kec.Cengkareng Jakarta barat 11720",
             "Nomor Telphon" => "0000000000"
            ],
            [
             "Nama Lengkap" => "Allyster Xivera Arfianto",
             "NamaAkun" => "KasihTS",
             "Course" => ["9c2dc53e-a419-40db-8973-c7b242387819"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "febe.arianti.axa@gmail.com",
             "Nomor Telphon" => "82262122442"
            ],
            [
             "Nama Lengkap" => "Ghifary Raisakbar",
             "NamaAkun" => "GhifaryTS",
             "Course" => ["9c2dc53e-a419-40db-8973-c7b242387819"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "effie.adji@gmail.com",
             "Nomor Telphon" => "081219274879"
            ],
            [
             "Nama Lengkap" => "Trevyn Scheaffer Azarya Siahaan",
             "NamaAkun" => "TrevynTS",
             "Course" => ["9c2dc53e-a419-40db-8973-c7b242387819"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "The Golden Stone Cluster Agate Blok G11",
             "Email" => "tristan.trevyn@gmail.com",
             "Nomor Telphon" => "08179279896"
            ],
            [
             "Nama Lengkap" => "Syafiq Muhammad Haidar",
             "NamaAkun" => "SyafiqTS",
             "Course" => ["b1092657-3ff6-4904-9641-9c4f9a835bff"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "murdiana.elsa847@gmail.com",
             "Nomor Telphon" => "81385126987"
            ],
            [
             "Nama Lengkap" => "Rigia TS",
             "NamaAkun" => "RigiaTS",
             "Course" => ["0e2cb0e9-2764-4445-a44e-e136223c7f33"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Email" => "sithaayularasati@gmail.com",
             "Nomor Telphon" => "8568076875"
            ],
            [
             "Nama Lengkap" => "Nicholas TS",
             "NamaAkun" => "KenzieATS",
             "Course" => ["941f7427-57f4-497a-a504-746d7570ef8c"],
             "Sekolah" => "SD",
             "Asal Kota" => "Indonesia",
             "Email" => "tere181281@gmail.com",
             "Nomor Telphon" => "85694363056"
            ],
            [
             "Nama Lengkap" => "Renata Maria Samatha",
             "NamaAkun" => "RenataTS",
             "Course" => ["941f7427-57f4-497a-a504-746d7570ef8c"],
             "Sekolah" => "SD",
             "Asal Kota" => "Bekasi",
             "Email" => "Caesiliaw@gmail.com",
             "Nomor Telphon" => "08111294779"
            ],
            [
             "Nama Lengkap" => "Krisna Duta",
             "NamaAkun" => "KrisnaTS",
             "Course" => ["e686dd6d-e740-41f3-a687-04308780f8c4"],
             "Sekolah" => "SD",
             "Asal Kota" => "Bogor",
             "Email" => "evafauziah@gmail.com",
             "Nomor Telphon" => "089638429804"
            ],
            [
             "Nama Lengkap" => "Narendra Muhammad Arsyad",
             "NamaAkun" => "NarendraTS",
             "Course" => ["06266603-6247-4a0f-8ddc-d34dd66a787d", "d501cdae-4b52-47c8-873c-b0d9b3d98a73"],
             "Sekolah" => "PKBM Piwulang Becik",
             "Asal Kota" => "Indonesia",
             "Email" => "wprimarty@gmail.com",
             "Nomor Telphon" => "085283891626"
            ],
            [
             "Nama Lengkap" => "Kalea TS",
             "NamaAkun" => "KaleaTS",
             "Email" => "KaleaTS@gmail.com",
             "Course" => ["d501cdae-4b52-47c8-873c-b0d9b3d98a73"],
             "Sekolah" => "Homeschooling",
             "Asal Kota" => "Indonesia",
             "Nomor Telphon" => "87898915911"
            ]
            ];

            
        foreach ($students as $studentData) {
            // Buat user baru
            $user = User::create([
                'name' => $studentData['Nama Lengkap'],
                'email' => $studentData['Email'],
                'password' => bcrypt($studentData['NamaAkun']),
                'role' => 'student',
            ]);

            $userId = User::where('name', $studentData['Nama Lengkap'])->value('id');

            $student = Student::create([
                'name' => $studentData['Nama Lengkap'],
                'school_name' => $studentData['Sekolah'],
                'addres' => $studentData['Asal Kota'],
                'email' => $studentData['Email'],
                'phone' => $studentData['Nomor Telphon'],
                'user_id' => $userId,
            ]);
    
            $kelas_id = $studentData['Course'];
            $student->kelas()->sync($kelas_id);
        }
    }
}
