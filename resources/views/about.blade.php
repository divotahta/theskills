@extends('layouts.public')

@section('title', 'About Us - TheSkills')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">About TheSkills</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Platform pembelajaran online terbaik untuk mengembangkan skill dan pengetahuan Anda
            </p>
        </div>
    </div>
</div>

<!-- Mission & Vision -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Misi Kami</h2>
                <p class="text-lg text-gray-600 mb-6">
                    TheSkills berkomitmen untuk memberikan akses pendidikan berkualitas tinggi kepada semua orang, 
                    di mana pun dan kapan pun. Kami percaya bahwa setiap individu berhak mendapatkan kesempatan 
                    untuk mengembangkan potensi mereka melalui pembelajaran yang efektif dan menyenangkan.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <p class="text-gray-600">Pembelajaran yang fleksibel dan dapat diakses 24/7</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <p class="text-gray-600">Instruktur berpengalaman dan terverifikasi</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <p class="text-gray-600">Kurikulum yang relevan dengan industri</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-graduation-cap text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                        <p class="text-gray-600 text-lg">
                            Menjadi platform pembelajaran online terdepan di Indonesia yang memberdayakan 
                            jutaan orang untuk mencapai impian mereka melalui pendidikan berkualitas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Pencapaian Kami</h2>
            <p class="text-lg text-gray-600">Angka-angka yang membanggakan dari perjalanan TheSkills</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">10,000+</div>
                <div class="text-gray-600">Siswa Aktif</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">500+</div>
                <div class="text-gray-600">Kursus Tersedia</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">200+</div>
                <div class="text-gray-600">Instruktur Ahli</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">98%</div>
                <div class="text-gray-600">Tingkat Kepuasan</div>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim Kami</h2>
            <p class="text-lg text-gray-600">Orang-orang hebat di balik TheSkills</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">CEO & Founder</h3>
                <p class="text-gray-600 mb-4">Pemimpin visioner dengan pengalaman 15+ tahun di industri teknologi</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
            <div class="text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">CTO</h3>
                <p class="text-gray-600 mb-4">Ahli teknologi dengan fokus pada inovasi dan pengalaman pengguna</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                </div>
            </div>
            <div class="text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-white text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Head of Education</h3>
                <p class="text-gray-600 mb-4">Pakar pendidikan dengan passion untuk pembelajaran yang efektif</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Values Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
            <p class="text-lg text-gray-600">Prinsip-prinsip yang memandu setiap keputusan kami</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-lightbulb text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Inovasi</h3>
                <p class="text-gray-600">Kami selalu mencari cara baru untuk meningkatkan pengalaman pembelajaran</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-heart text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Integritas</h3>
                <p class="text-gray-600">Kami berkomitmen untuk transparansi dan kejujuran dalam semua aspek</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-users text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kolaborasi</h3>
                <p class="text-gray-600">Kami percaya bahwa pembelajaran terbaik terjadi dalam komunitas</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Bergabunglah dengan Perjalanan Kami</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Jadilah bagian dari komunitas pembelajaran yang berkembang dan mulailah perjalanan 
            pengembangan skill Anda hari ini.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('courses.index') }}" 
               class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                <i class="fas fa-graduation-cap mr-2"></i>
                Jelajahi Kursus
            </a>
            <a href="{{ route('register') }}" 
               class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
