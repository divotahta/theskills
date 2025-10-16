<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | TheSkills</title>
    <meta name="description" content="Halaman yang Anda cari tidak ditemukan. Kembali ke beranda atau jelajahi kursus kami.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        .bounce {
            animation: bounce 2s infinite;
        }
        
        .pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glow {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        
        .bg-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
        }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center px-4">
    <div class="max-w-4xl mx-auto text-center">
        <!-- 404 Illustration -->
        <div class="relative mb-8">
            <div class="floating">
                <div class="text-9xl md:text-[12rem] font-black gradient-text mb-4">
                    404
                </div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute -top-4 -left-4 w-8 h-8 bg-blue-500 rounded-full opacity-20 bounce"></div>
            <div class="absolute -top-2 -right-8 w-6 h-6 bg-purple-500 rounded-full opacity-30 bounce" style="animation-delay: 0.5s;"></div>
            <div class="absolute -bottom-4 -left-8 w-4 h-4 bg-indigo-500 rounded-full opacity-25 bounce" style="animation-delay: 1s;"></div>
            <div class="absolute -bottom-2 -right-4 w-5 h-5 bg-pink-500 rounded-full opacity-20 bounce" style="animation-delay: 1.5s;"></div>
        </div>
        
        <!-- Error Message -->
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Oops! Halaman Tidak Ditemukan
            </h1>
            <p class="text-xl text-gray-600 mb-6 max-w-2xl mx-auto">
                Maaf, halaman yang Anda cari sepertinya sudah pindah atau tidak ada. 
                Jangan khawatir, mari kita bantu Anda menemukan apa yang Anda butuhkan.
            </p>
        </div>
        
        <!-- Search Box -->
        <div class="mb-8">
            <div class="max-w-md mx-auto relative">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari kursus, instruktur, atau topik..." 
                           class="w-full px-6 py-4 pr-12 border-2 border-gray-200 rounded-2xl focus:border-blue-500 focus:outline-none transition-all duration-300 text-lg shadow-lg hover:shadow-xl">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-500 transition-colors">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="{{ url('/') }}" 
               class="group px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl font-semibold text-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl glow">
                <i class="fas fa-home mr-2 group-hover:scale-110 transition-transform"></i>
                Kembali ke Beranda
            </a>
            
            <a href="{{ url('/courses') }}" 
               class="group px-8 py-4 bg-white text-gray-700 border-2 border-gray-200 rounded-2xl font-semibold text-lg hover:border-blue-500 hover:text-blue-600 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                <i class="fas fa-graduation-cap mr-2 group-hover:scale-110 transition-transform"></i>
                Jelajahi Kursus
            </a>
        </div>
        
        <!-- Popular Links -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Mungkin Anda Mencari:</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ url('/courses') }}" 
                   class="group p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-blue-600 text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Semua Kursus</h4>
                    <p class="text-sm text-gray-600">Jelajahi koleksi kursus kami</p>
                </a>
                
                <a href="{{ url('/about') }}" 
                   class="group p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl hover:from-green-100 hover:to-emerald-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-green-600 text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Tentang Kami</h4>
                    <p class="text-sm text-gray-600">Pelajari lebih lanjut tentang TheSkills</p>
                </a>
                
                <a href="{{ url('/contact') }}" 
                   class="group p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl hover:from-purple-100 hover:to-pink-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-purple-600 text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Hubungi Kami</h4>
                    <p class="text-sm text-gray-600">Butuh bantuan? Hubungi tim kami</p>
                </a>
            </div>
        </div>
        
        <!-- Fun Facts -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl p-8 text-white">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-lightbulb text-3xl mr-3 pulse-slow"></i>
                <h3 class="text-2xl font-bold">Fakta Menarik</h3>
            </div>
            <p class="text-lg opacity-90">
                Tahukah Anda? Rata-rata pengguna menghabiskan 2-3 menit untuk mencari halaman yang tepat. 
                Mari kita bantu Anda menemukan kursus yang sempurna untuk mengembangkan skill Anda!
            </p>
        </div>
        
        <!-- Footer -->
        <div class="mt-12 text-center">
            <p class="text-gray-500 mb-2">
                © {{ date('Y') }} TheSkills. Semua hak dilindungi.
            </p>
            <p class="text-sm text-gray-400">
                Jika Anda yakin ini adalah kesalahan, silakan 
                <a href="mailto:support@theskills.com" class="text-blue-500 hover:text-blue-600 transition-colors">
                    hubungi tim support kami
                </a>
            </p>
        </div>
    </div>
    
    <!-- Background Animation -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 4s;"></div>
    </div>
</body>
</html>
