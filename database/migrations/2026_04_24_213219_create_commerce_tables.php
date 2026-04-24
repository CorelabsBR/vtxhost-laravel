<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->foreignId('categoria_id')->constrained('categoria_prod');
            $table->foreignId('jogo_id')->nullable()->constrained('jogos_prod');
            $table->foreignId('local_id')->nullable()->constrained('location_prod');
            $table->unsignedInteger('plan')->nullable();
            $table->boolean('ddos_protection')->default(false);
            $table->boolean('featured')->default(false);
            $table->integer('sort_order')->default(1);
            $table->timestamp('criado_em')->useCurrent();
            $table->timestamp('atualizado_em')->useCurrent()->useCurrentOnUpdate();

            //$table->foreign('plan')->references('plan')->on('plans')->nullOnDelete();
            $table->index('plan', 'idx_products_plan');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pendente', 'pago', 'cancelado'])->default('pendente');
            $table->string('mp_pagamento_id')->nullable();
            $table->timestamp('criado_em')->useCurrent();
            $table->timestamp('atualizado_em')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantidade');
            $table->decimal('preco', 10, 2);
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('quantidade');
            $table->timestamp('adicionado_em')->useCurrent();

            $table->unique(['user_id', 'product_id'], 'uq_user_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
    }
};