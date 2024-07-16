<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentsTableNullableColumns extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Kolom grade, email, dan phone menjadi nullable
            $table->integer('grade')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->integer('birth')->nullable()->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Revert changes jika perlu
            $table->integer('grade')->change();
            $table->string('email')->change();
            $table->string('phone')->change();
            $table->integer('birth')->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->change();
        });
    }
}
