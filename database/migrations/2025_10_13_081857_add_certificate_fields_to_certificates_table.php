<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('certificate_number')->unique()->after('course_id');
            $table->timestamp('expires_at')->nullable()->after('issued_at');
            $table->boolean('is_valid')->default(true)->after('expires_at');
            $table->integer('download_count')->default(0)->after('is_valid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn(['certificate_number', 'expires_at', 'is_valid', 'download_count']);
        });
    }
};