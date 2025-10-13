@extends('layouts.student-tutor')

@section('content')
<div x-data="{ mobileMenuOpen: false }">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('student.notifications.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Notifikasi</h1>
                    <p class="text-gray-600 mt-2">Informasi lengkap tentang notifikasi ini</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                @if($notification->is_read)
                    <button onclick="markAsUnread({{ $notification->id }})" 
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-eye-slash mr-2"></i>
                        Tandai Belum Dibaca
                    </button>
                @else
                    <button onclick="markAsRead({{ $notification->id }})" 
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-check mr-2"></i>
                        Tandai Dibaca
                    </button>
                @endif
                
                <button onclick="deleteNotification({{ $notification->id }})" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Notification Detail -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-8">
            <!-- Header -->
            <div class="flex items-start space-x-6">
                <!-- Icon -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 rounded-full {{ $notification->is_read ? 'bg-gray-100' : 'bg-blue-100' }} flex items-center justify-center">
                        <i class="{{ $notification->icon }} {{ $notification->color }} text-2xl"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 {{ !$notification->is_read ? 'font-bold' : '' }}">
                            {{ $notification->title }}
                        </h2>
                        <div class="flex items-center space-x-3">
                            @if(!$notification->is_read)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-circle text-xs mr-2"></i>
                                    Belum Dibaca
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle text-xs mr-2"></i>
                                    Sudah Dibaca
                                </span>
                            @endif
                            
                            <span class="text-sm text-gray-500">
                                {{ $notification->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="prose max-w-none">
                        <p class="text-lg text-gray-700 leading-relaxed">{{ $notification->message }}</p>
                    </div>

                    <!-- Additional Data -->
                    @if($notification->data && count($notification->data) > 0)
                        <div class="mt-8 border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tambahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($notification->data as $key => $value)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <dt class="text-sm font-medium text-gray-600 capitalize">
                                            {{ str_replace('_', ' ', $key) }}
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            @if(is_array($value))
                                                {{ json_encode($value) }}
                                            @else
                                                {{ $value }}
                                            @endif
                                        </dd>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-600">Dibuat</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $notification->created_at->format('d M Y, H:i:s') }}
                                    <span class="text-gray-500 ml-2">({{ $notification->created_at->diffForHumans() }})</span>
                                </dd>
                            </div>
                            
                            @if($notification->read_at)
                                <div>
                                    <dt class="text-sm font-medium text-gray-600">Dibaca</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $notification->read_at->format('d M Y, H:i:s') }}
                                        <span class="text-gray-500 ml-2">({{ $notification->read_at->diffForHumans() }})</span>
                                    </dd>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Actions -->
    @if($notification->data)
        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Terkait</h3>
                <div class="flex flex-wrap gap-4">
                    @if(isset($notification->data['course_id']))
                        <a href="{{ route('courses.show', $notification->data['course_id']) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Lihat Kursus
                        </a>
                    @endif
                    
                    @if(isset($notification->data['payment_id']))
                        <a href="{{ route('student.payments.show', $notification->data['payment_id']) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                            <i class="fas fa-credit-card mr-2"></i>
                            Lihat Pembayaran
                        </a>
                    @endif
                    
                    <a href="{{ route('student.notifications.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-list mr-2"></i>
                        Semua Notifikasi
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function markAsRead(notificationId) {
    fetch(`/student/notifications/${notificationId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

function markAsUnread(notificationId) {
    fetch(`/student/notifications/${notificationId}/mark-unread`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

function deleteNotification(notificationId) {
    if (confirm('Hapus notifikasi ini?')) {
        fetch(`/student/notifications/${notificationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/student/notifications';
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>
@endsection
