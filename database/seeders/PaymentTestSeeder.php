<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use App\Models\Payment;

class PaymentTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some courses and users for testing
        $courses = Course::where('price', '>', 0)->take(5)->get();
        $users = User::where('role', 'student')->take(3)->get();

        if ($courses->isEmpty() || $users->isEmpty()) {
            $this->command->info('No courses or users found for payment testing');
            return;
        }

        // Create some test payments
        foreach ($courses as $course) {
            foreach ($users as $user) {
                // Create a completed payment
                Payment::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'amount' => $course->price,
                    'status' => 'completed',
                    'transaction_id' => 'TXN-' . now()->format('Ymd') . '-' . strtoupper(substr(md5($user->id . $course->id . time()), 0, 8)),
                ]);
            }
        }

        $this->command->info('Payment test data created successfully');
    }
}
