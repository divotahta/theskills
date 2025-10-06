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
        Schema::table('course_contents', function (Blueprint $table) {
            // Tambahkan kolom yang hilang
            if (!Schema::hasColumn('course_contents', 'topic_id')) {
                $table->foreignId('topic_id')->nullable()->constrained()->onDelete('set null');
            }
            
            if (!Schema::hasColumn('course_contents', 'material_content')) {
                $table->longText('material_content')->nullable();
            }
            
            if (!Schema::hasColumn('course_contents', 'youtube_embed_url')) {
                $table->string('youtube_embed_url')->nullable();
            }
            
            if (!Schema::hasColumn('course_contents', 'file_path')) {
                $table->string('file_path')->nullable();
            }
            
            if (!Schema::hasColumn('course_contents', 'file_name')) {
                $table->string('file_name')->nullable();
            }
            
            if (!Schema::hasColumn('course_contents', 'announcement')) {
                $table->text('announcement')->nullable();
            }
            
            if (!Schema::hasColumn('course_contents', 'order')) {
                $table->integer('order')->default(1);
            }
            
            if (!Schema::hasColumn('course_contents', 'is_published')) {
                $table->boolean('is_published')->default(false);
            }

            // Tambahkan index untuk performa
            $table->index(['course_id', 'order']);
            $table->index(['course_id', 'is_published']);
            $table->index('topic_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_contents', function (Blueprint $table) {
            // Hapus index terlebih dahulu
            $table->dropIndex(['course_id', 'order']);
            $table->dropIndex(['course_id', 'is_published']);
            $table->dropIndex(['topic_id']);
            
            // Hapus kolom
            $table->dropColumn([
                'topic_id',
                'material_content',
                'youtube_embed_url',
                'file_path',
                'file_name',
                'announcement',
                'order',
                'is_published'
            ]);
        });
    }
};