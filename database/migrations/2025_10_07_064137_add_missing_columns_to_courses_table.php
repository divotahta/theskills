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
            if (!Schema::hasColumn('courses', 'duration')) {
                $table->integer('duration')->nullable()->after('thumbnail');
            }
            if (!Schema::hasColumn('courses', 'level')) {
                $table->string('level')->nullable()->after('duration');
            }
            if (!Schema::hasColumn('courses', 'age_group')) {
                $table->string('age_group')->nullable()->after('level');
            }
            if (!Schema::hasColumn('courses', 'language')) {
                $table->string('language')->nullable()->after('age_group');
            }
            if (!Schema::hasColumn('courses', 'prerequisites')) {
                $table->text('prerequisites')->nullable()->after('language');
            }
            if (!Schema::hasColumn('courses', 'what_you_will_learn')) {
                $table->text('what_you_will_learn')->nullable()->after('prerequisites');
            }
            if (!Schema::hasColumn('courses', 'course_includes')) {
                $table->text('course_includes')->nullable()->after('what_you_will_learn');
            }
            if (!Schema::hasColumn('courses', 'is_published')) {
                $table->boolean('is_published')->default(false)->after('course_includes');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'duration')) {
                $table->dropColumn('duration');
            }
            if (Schema::hasColumn('courses', 'level')) {
                $table->dropColumn('level');
            }
            if (Schema::hasColumn('courses', 'age_group')) {
                $table->dropColumn('age_group');
            }
            if (Schema::hasColumn('courses', 'language')) {
                $table->dropColumn('language');
            }
            if (Schema::hasColumn('courses', 'prerequisites')) {
                $table->dropColumn('prerequisites');
            }
            if (Schema::hasColumn('courses', 'what_you_will_learn')) {
                $table->dropColumn('what_you_will_learn');
            }
            if (Schema::hasColumn('courses', 'course_includes')) {
                $table->dropColumn('course_includes');
            }
            if (Schema::hasColumn('courses', 'is_published')) {
                $table->dropColumn('is_published');
            }
        });
    }
};