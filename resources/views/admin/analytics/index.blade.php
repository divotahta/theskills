@extends('layouts.admin-tutor')

@section('content')
<div x-data="{ mobileMenuOpen: false }">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Analytics Dashboard</h1>
                <p class="text-gray-600 mt-2">Comprehensive insights into platform performance and user engagement</p>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Date Range Filter -->
                <form method="GET" action="{{ route('admin.analytics.index') }}" class="flex items-center space-x-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" 
                               id="start_date" 
                               name="start_date" 
                               value="{{ $startDate }}"
                               class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" 
                               id="end_date" 
                               name="end_date" 
                               value="{{ $endDate }}"
                               class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                    </div>
                </form>
                
                <!-- Export Button -->
                <div class="relative" x-data="{ exportOpen: false }">
                    <button @click="exportOpen = !exportOpen" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Export
                    </button>
                    
                    <div x-show="exportOpen" 
                         @click.away="exportOpen = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                        <a href="{{ route('admin.analytics.export', ['format' => 'csv', 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-file-csv mr-2"></i>
                            Export as CSV
                        </a>
                        <a href="{{ route('admin.analytics.export', ['format' => 'json', 'start_date' => $startDate, 'end_date' => $endDate]) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-file-code mr-2"></i>
                            Export as JSON
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overall Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Courses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_courses']) }}</p>
                </div>
            </div>
        </div>

        {{-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div> --}}

        {{-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <i class="fas fa-star text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Average Rating</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['average_rating'], 1) }}</p>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Additional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <p class="text-sm font-medium text-gray-600">Instructors</p>
                <p class="text-xl font-bold text-gray-900">{{ number_format($stats['total_instructors']) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <p class="text-sm font-medium text-gray-600">Students</p>
                <p class="text-xl font-bold text-gray-900">{{ number_format($stats['total_students']) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <p class="text-sm font-medium text-gray-600">Enrollments</p>
                <p class="text-xl font-bold text-gray-900">{{ number_format($stats['total_enrollments']) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <p class="text-sm font-medium text-gray-600">Reviews</p>
                <p class="text-xl font-bold text-gray-900">{{ number_format($stats['total_reviews']) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <p class="text-sm font-medium text-gray-600">Active Courses</p>
                <p class="text-xl font-bold text-green-600">{{ number_format($stats['active_courses']) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="text-center">
                <p class="text-sm font-medium text-gray-600">Pending Courses</p>
                <p class="text-xl font-bold text-yellow-600">{{ number_format($stats['pending_courses']) }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    {{-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Revenue Trend</h3>
            <div class="relative h-64">
                <div id="revenueChartLoading" class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-2"></div>
                        <p class="text-gray-500">Loading chart...</p>
                    </div>
                </div>
                <canvas id="revenueChart" class="hidden"></canvas>
            </div>
        </div>

        <!-- User Growth Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">User Growth</h3>
            <div class="relative h-64">
                <div id="userGrowthChartLoading" class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto mb-2"></div>
                        <p class="text-gray-500">Loading chart...</p>
                    </div>
                </div>
                <canvas id="userGrowthChart" class="hidden"></canvas>
            </div>
        </div>
    </div> --}}

    <!-- Additional Charts Row -->
    {{-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Course Categories Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Courses by Category</h3>
            <div class="relative h-64">
                <div id="categoryChartLoading" class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600 mx-auto mb-2"></div>
                        <p class="text-gray-500">Loading chart...</p>
                    </div>
                </div>
                <canvas id="categoryChart" class="hidden"></canvas>
            </div>
        </div>

        <!-- Enrollment Trend Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Enrollment Trend</h3>
            <div class="relative h-64">
                <div id="enrollmentChartLoading" class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto mb-2"></div>
                        <p class="text-gray-500">Loading chart...</p>
                    </div>
                </div>
                <canvas id="enrollmentChart" class="hidden"></canvas>
            </div>
        </div>
    </div> --}}

    <!-- Top Performers Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Top Courses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Performing Courses</h3>
            <div class="space-y-4">
                @foreach($topCourses->take(5) as $course)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">{{ $course->title }}</h4>
                        <p class="text-sm text-gray-600">by {{ $course->instructor->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ $course->enrollments_count }} enrollments</p>
                        {{-- <p class="text-xs text-gray-600">{{ number_format($course->reviews_avg_rating, 1) }} ⭐</p> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Top Instructors -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Instructors</h3>
            <div class="space-y-4">
                @foreach($topInstructors->take(5) as $instructor)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">{{ $instructor->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $instructor->courses_count }} courses</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ $instructor->enrollments_count }} enrollments</p>
                        <p class="text-xs text-gray-600">Rp {{ number_format($instructor->courses_sum_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
        <div class="space-y-4">
            @foreach($recentActivity->take(10) as $activity)
            <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                        <i class="{{ $activity['icon'] }} {{ $activity['color'] }} text-sm"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-900">{{ $activity['message'] }}</p>
                    <p class="text-xs text-gray-500">{{ $activity['time']->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, checking ApexCharts...');
    
    // Check if ApexCharts is loaded
    if (typeof ApexCharts === 'undefined') {
        console.error('ApexCharts is not loaded!');
        return;
    }
    
    console.log('ApexCharts loaded successfully');
    console.log('Initializing charts...');
    
    // Revenue Chart
    const revenueElement = document.getElementById('revenueChart');
    const revenueLoading = document.getElementById('revenueChartLoading');
    
    console.log('Revenue chart elements:', { revenueElement, revenueLoading });
    
    if (revenueElement) {
        try {
            const revenueData = {!! json_encode($revenueData['daily']) !!};
            console.log('Revenue data:', revenueData);
            console.log('Revenue data length:', revenueData.length);
            
            if (revenueData && revenueData.length > 0) {
                const options = {
                    series: [{
                        name: 'Daily Revenue',
                        data: revenueData.map(item => item.revenue)
                    }],
                    chart: {
                        type: 'line',
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#3B82F6'],
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.3,
                            stops: [0, 90, 100]
                        }
                    },
                    xaxis: {
                        categories: revenueData.map(item => item.date),
                        labels: {
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    grid: {
                        borderColor: '#f1f5f9',
                        strokeDashArray: 4
                    }
                };
                
                const chart = new ApexCharts(revenueElement, options);
                chart.render();
                
                console.log('Revenue chart created successfully');
                
                // Hide loading and show chart
                if (revenueLoading) {
                    revenueLoading.style.display = 'none';
                }
                revenueElement.style.display = 'block';
            } else {
                console.log('No revenue data available');
                if (revenueLoading) {
                    revenueLoading.innerHTML = '<div class="text-center text-gray-500"><i class="fas fa-chart-line mb-2"></i><p>No data available</p></div>';
                }
            }
            
        } catch (error) {
            console.error('Error creating revenue chart:', error);
            if (revenueLoading) {
                revenueLoading.innerHTML = '<div class="text-center text-red-500"><i class="fas fa-exclamation-triangle mb-2"></i><p>Error: ' + error.message + '</p></div>';
            }
        }
    } else {
        console.error('Revenue chart element not found');
    }

    // User Growth Chart
    const userGrowthElement = document.getElementById('userGrowthChart');
    const userGrowthLoading = document.getElementById('userGrowthChartLoading');
    
    console.log('User growth chart elements:', { userGrowthElement, userGrowthLoading });
    
    if (userGrowthElement) {
        try {
            const userGrowthData = {!! json_encode($userData['growth']) !!};
            console.log('User growth data:', userGrowthData);
            console.log('User growth data length:', userGrowthData.length);
            
            if (userGrowthData && userGrowthData.length > 0) {
                const options = {
                    series: [{
                        name: 'New Users',
                        data: userGrowthData.map(item => item.count)
                    }],
                    chart: {
                        type: 'bar',
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#22C55E'],
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: false,
                        }
                    },
                    xaxis: {
                        categories: userGrowthData.map(item => item.month),
                        labels: {
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return value.toLocaleString('id-ID') + ' users';
                            }
                        }
                    },
                    grid: {
                        borderColor: '#f1f5f9',
                        strokeDashArray: 4
                    }
                };
                
                const chart = new ApexCharts(userGrowthElement, options);
                chart.render();
                
                console.log('User growth chart created successfully');
                
                // Hide loading and show chart
                if (userGrowthLoading) {
                    userGrowthLoading.style.display = 'none';
                }
                userGrowthElement.style.display = 'block';
            } else {
                console.log('No user growth data available');
                if (userGrowthLoading) {
                    userGrowthLoading.innerHTML = '<div class="text-center text-gray-500"><i class="fas fa-chart-bar mb-2"></i><p>No data available</p></div>';
                }
            }
            
        } catch (error) {
            console.error('Error creating user growth chart:', error);
            if (userGrowthLoading) {
                userGrowthLoading.innerHTML = '<div class="text-center text-red-500"><i class="fas fa-exclamation-triangle mb-2"></i><p>Error: ' + error.message + '</p></div>';
            }
        }
    } else {
        console.error('User growth chart element not found');
    }

    // Category Chart
    const categoryElement = document.getElementById('categoryChart');
    const categoryLoading = document.getElementById('categoryChartLoading');
    
    console.log('Category chart elements:', { categoryElement, categoryLoading });
    
    if (categoryElement) {
        try {
            const categoryData = {!! json_encode($courseData['by_category']) !!};
            console.log('Category data:', categoryData);
            console.log('Category data length:', categoryData.length);
            
            if (categoryData && categoryData.length > 0) {
                const options = {
                    series: categoryData.map(item => item.count),
                    chart: {
                        type: 'donut',
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    labels: categoryData.map(item => item.name),
                    colors: [
                        '#3B82F6',
                        '#22C55E',
                        '#FBBF24',
                        '#EF4444',
                        '#A855F7',
                        '#EC4899',
                        '#06B6D4',
                        '#F59E0B'
                    ],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total Courses',
                                        formatter: function (w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        }
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                        fontSize: '12px'
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return value + ' courses';
                            }
                        }
                    }
                };
                
                const chart = new ApexCharts(categoryElement, options);
                chart.render();
                
                console.log('Category chart created successfully');
                
                // Hide loading and show chart
                if (categoryLoading) {
                    categoryLoading.style.display = 'none';
                }
                categoryElement.style.display = 'block';
            } else {
                console.log('No category data available');
                if (categoryLoading) {
                    categoryLoading.innerHTML = '<div class="text-center text-gray-500"><i class="fas fa-chart-pie mb-2"></i><p>No data available</p></div>';
                }
            }
            
        } catch (error) {
            console.error('Error creating category chart:', error);
            if (categoryLoading) {
                categoryLoading.innerHTML = '<div class="text-center text-red-500"><i class="fas fa-exclamation-triangle mb-2"></i><p>Error: ' + error.message + '</p></div>';
            }
        }
    } else {
        console.error('Category chart element not found');
    }

    // Enrollment Chart
    const enrollmentElement = document.getElementById('enrollmentChart');
    const enrollmentLoading = document.getElementById('enrollmentChartLoading');
    
    console.log('Enrollment chart elements:', { enrollmentElement, enrollmentLoading });
    
    if (enrollmentElement) {
        try {
            const enrollmentData = {!! json_encode($enrollmentData['daily']) !!};
            console.log('Enrollment data:', enrollmentData);
            console.log('Enrollment data length:', enrollmentData.length);
            
            if (enrollmentData && enrollmentData.length > 0) {
                const options = {
                    series: [{
                        name: 'Daily Enrollments',
                        data: enrollmentData.map(item => item.count)
                    }],
                    chart: {
                        type: 'area',
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#A855F7'],
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.3,
                            stops: [0, 90, 100]
                        }
                    },
                    xaxis: {
                        categories: enrollmentData.map(item => item.date),
                        labels: {
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return value.toLocaleString('id-ID') + ' enrollments';
                            }
                        }
                    },
                    grid: {
                        borderColor: '#f1f5f9',
                        strokeDashArray: 4
                    }
                };
                
                const chart = new ApexCharts(enrollmentElement, options);
                chart.render();
                
                console.log('Enrollment chart created successfully');
                
                // Hide loading and show chart
                if (enrollmentLoading) {
                    enrollmentLoading.style.display = 'none';
                }
                enrollmentElement.style.display = 'block';
            } else {
                console.log('No enrollment data available');
                if (enrollmentLoading) {
                    enrollmentLoading.innerHTML = '<div class="text-center text-gray-500"><i class="fas fa-chart-line mb-2"></i><p>No data available</p></div>';
                }
            }
            
        } catch (error) {
            console.error('Error creating enrollment chart:', error);
            if (enrollmentLoading) {
                enrollmentLoading.innerHTML = '<div class="text-center text-red-500"><i class="fas fa-exclamation-triangle mb-2"></i><p>Error: ' + error.message + '</p></div>';
            }
        }
    } else {
        console.error('Enrollment chart element not found');
    }
    
    console.log('All ApexCharts initialization completed');
});
</script>
@endsection
