<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function update(User $user, Course $course)
    {
        return $user->id === $course->instructor_id;
    }
} 