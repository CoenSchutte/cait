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
        // remove expo_token from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('expo_token');
        });

        // remove app_body from posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('app_body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // add expo_token back to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('expo_token')->nullable()->after('profile_photo_path');
        });

        // add app_body back to posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->text('app_body')->nullable()->after('body');
        });
    }
};
