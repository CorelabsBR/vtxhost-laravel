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
<<<<<<< HEAD
    Schema::table('user', function (Blueprint $table) {
=======
    Schema::table('users', function (Blueprint $table) {
>>>>>>> e9adfd2 (feat: atualizações do vortex hosting)
        $table->string('google_id')->nullable()->unique();
        $table->string('discord_id')->nullable()->unique();
        $table->string('avatar')->nullable();
        $table->string('provider')->nullable();
        $table->timestamp('email_verified_at')->nullable()->change();
        $table->string('password')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD
        Schema::table('user', function (Blueprint $table) {
=======
        Schema::table('users', function (Blueprint $table) {
>>>>>>> e9adfd2 (feat: atualizações do vortex hosting)
            //
        });
    }
};
