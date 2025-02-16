<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('skill')->nullable();
            $table->text('bio')->nullable();
            $table->string('display_name')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'phone', 'skill', 'bio', 'display_name', 'profile_photo', 'cover_photo']);
        });
    }
}; 