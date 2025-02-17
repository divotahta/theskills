<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil kursus yang sedang diikuti
        $enrolledCourses = Enrollment::with(['course', 'course.instructor'])
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        // Hitung total kursus yang selesai
        $completedCourses = Enrollment::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        // Hitung total sertifikat
        $totalCertificates = $completedCourses; // Asumsikan setiap kursus selesai dapat sertifikat

        return view('student.dashboard', compact(
            'enrolledCourses',
            'completedCourses',
            'totalCertificates'
        ));
    }
} 