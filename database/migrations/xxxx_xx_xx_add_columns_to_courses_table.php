<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->after('video_url');
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])->nullable()->after('is_public');
            $table->integer('max_students')->nullable()->after('difficulty_level');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['thumbnail', 'difficulty_level', 'max_students']);
        });
    }
}; 