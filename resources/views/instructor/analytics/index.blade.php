@extends('layouts.instructor-tutor')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Analytics Dashboard</h1>
                <p class="text-gray-600 mt-2">Analisis performa kursus dan engagement siswa</p>
            </div>
            <div class="flex space-x-3">
                <select id="period-selector" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="7" {{ $period == '7' ? 'selected' : '' }}>Last 7 days</option>
                    <option value="30" {{ $period == '30' ? 'selected' : '' }}>Last 30 days</option>
                    <option value="90" {{ $period == '90' ? 'selected' : '' }}>Last 90 days</option>
                    <option value="365" {{ $period == '365' ? 'selected' : '' }}>Last year</option>
                </select>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export Data
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <div class="py-1">
                            <a href="{{ route('instructor.analytics.export', ['type' => 'revenue']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export Revenue</a>
                            <a href="{{ route('instructor.analytics.export', ['type' => 'enrollments']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export Enrollments</a>
                            <a href="{{ route('instructor.analytics.export', ['type' => 'courses']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($revenueData['total'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Total Enrollments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 100-8 4 4 0 000 8zm8 0a4 4 0 100-8 4 4 0 000 8z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Enrollments</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $enrollmentData['total'] }}</p>
                </div>
            </div>
        </div>

        <!-- Completion Rate -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Completion Rate</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $engagementData['completion_rate'] }}%</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Revenue Chart -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Revenue Trend</h2>
            </div>
            <div class="p-6">
                <canvas id="revenueChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Enrollments Chart -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Enrollments Trend</h2>
            </div>
            <div class="p-6">
                <canvas id="enrollmentsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Course Performance -->
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Course Performance</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrollments</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reviews</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($coursePerformance as $course)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $course->category->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $course->enrollments_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $course->reviews_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($course->reviews_avg_rating)
                                        <div class="flex items-center">
                                            <span class="text-yellow-400">★</span>
                                            <span class="ml-1">{{ number_format($course->reviews_avg_rating, 1) }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($course->price * $course->enrollments_count, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No courses found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Reviews -->
    @if($reviewData['recent']->count() > 0)
        <div class="mt-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Recent Reviews</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($reviewData['recent'] as $review)
                        <div class="px-6 py-4">
                            <div class="flex items-start">
                                <img class="h-10 w-10 rounded-full" 
                                     src="{{ $review->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                                     alt="{{ $review->user->name }}">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $review->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $review->course->title }}</p>
                                        </div>
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600">{{ $review->comment }}</p>
                                    <p class="mt-1 text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Period selector
document.getElementById('period-selector').addEventListener('change', function() {
    const period = this.value;
    window.location.href = '{{ route("instructor.analytics.index") }}?period=' + period;
});

// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($revenueData['daily']->pluck('date')) !!},
        datasets: [{
            label: 'Revenue',
            data: {!! json_encode($revenueData['daily']->pluck('revenue')) !!},
            borderColor: 'rgb(59, 130, 246)',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString();
                    }
                }
            }
        }
    }
});

// Enrollments Chart
const enrollmentsCtx = document.getElementById('enrollmentsChart').getContext('2d');
const enrollmentsChart = new Chart(enrollmentsCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($enrollmentData['daily']->pluck('date')) !!},
        datasets: [{
            label: 'Enrollments',
            data: {!! json_encode($enrollmentData['daily']->pluck('enrollments')) !!},
            backgroundColor: 'rgba(16, 185, 129, 0.8)',
            borderColor: 'rgb(16, 185, 129)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
