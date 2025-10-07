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
        Schema::create('course_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Beginner", "Intermediate", "Advanced"
            $table->string('slug')->unique(); // e.g., "beginner", "intermediate", "advanced"
            $table->text('description')->nullable(); // Description of the level
            $table->integer('sort_order')->default(0); // For ordering levels
            $table->string('color', 50)->nullable(); // Color theme for the level
            $table->boolean('is_active')->default(true); // Whether the level is active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_levels');
    }
};
