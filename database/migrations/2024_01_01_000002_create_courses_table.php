<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('video_type', ['native', 'youtube', 'vimeo'])->nullable();
            $table->string('video_url', 255)->nullable();
            $table->boolean('is_public')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('instructor_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}; 