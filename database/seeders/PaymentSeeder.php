<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Enrollment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enrollments = Enrollment::all();

        if ($enrollments->isEmpty()) {
            $this->command->warn('Tidak ada enrollment yang ditemukan. Jalankan EnrollmentSeeder terlebih dahulu.');
            return;
        }

        $paymentMethods = ['credit_card', 'bank_transfer', 'e_wallet', 'virtual_account'];
        $paymentStatuses = ['pending', 'completed', 'failed'];

        foreach ($enrollments as $enrollment) {
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            $paymentStatus = $paymentStatuses[array_rand($paymentStatuses)];
            
            // Random payment date (around enrollment date)
            $paymentDate = \Carbon\Carbon::parse($enrollment->enrolled_at)->addMinutes(rand(0, 60));
            
            // Random discount (0-20%)
            $discount = rand(0, 20);
            $discountedAmount = $enrollment->course->price * (100 - $discount) / 100;
            
            // Random fee (0-5000)
            $fee = rand(0, 5000);
            $totalAmount = $discountedAmount + $fee;

            Payment::create([
                'user_id' => $enrollment->user_id,
                'course_id' => $enrollment->course_id,
                'amount' => $enrollment->course->price,
                'status' => $paymentStatus,
                'transaction_id' => 'TXN' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
            ]);
        }

        $this->command->info('PaymentSeeder berhasil dijalankan!');
    }
}
