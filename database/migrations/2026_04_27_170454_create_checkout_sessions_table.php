<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checkout_sessions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->index('user_id');

            $table->string('token_hash', 128)->unique();

            $table->json('cart_payload')->nullable();

            $table->string('source')->default('vortexhost');

            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checkout_sessions');
    }
};