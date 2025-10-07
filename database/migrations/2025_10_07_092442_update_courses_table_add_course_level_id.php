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
        Schema::table('courses', function (Blueprint $table) {
            // Add course_level_id column
            $table->unsignedBigInteger('course_level_id')->nullable()->after('category_id');
            
            // Add foreign key constraint
            $table->foreign('course_level_id')->references('id')->on('course_levels')->onDelete('set null');
            
            // Remove old level column if it exists
            if (Schema::hasColumn('courses', 'level')) {
                $table->dropColumn('level');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['course_level_id']);
            
            // Drop course_level_id column
            $table->dropColumn('course_level_id');
            
            // Add back old level column
            $table->string('level')->nullable();
        });
    }
};
