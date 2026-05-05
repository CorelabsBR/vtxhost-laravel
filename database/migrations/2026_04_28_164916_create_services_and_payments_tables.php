<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->string('provider')->default('mercadopago');
            $table->string('provider_payment_id')->nullable()->index();
            $table->string('preference_id')->nullable()->index();

            $table->decimal('amount', 10, 2);
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'cancelled',
                'refunded'
            ])->default('pending');

            $table->json('raw_payload')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('user')
                ->cascadeOnDelete();

            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->nullOnDelete();

            $table->foreignId('order_item_id')
                ->nullable()
                ->constrained('order_items')
                ->nullOnDelete();

            $table->foreignId('product_id')
                ->constrained('products');

            $table->enum('type', [
                'web',
                'game',
                'vps'
            ]);

            $table->enum('status', [
                'pending',
                'provisioning',
                'active',
                'suspended',
                'cancelled',
                'failed'
            ])->default('pending');

            $table->string('name')->nullable();
            $table->string('domain')->nullable();

            $table->timestamp('expires_at')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('pterodactyl_servers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->unsignedInteger('plan_id')->nullable();

            $table->integer('pterodactyl_user_id')->nullable();
            $table->integer('pterodactyl_server_id')->nullable();
            $table->string('uuid')->nullable();
            $table->string('identifier')->nullable();
            $table->integer('allocation_id')->nullable();

            $table->integer('node_id')->nullable();
            $table->integer('egg_id')->nullable();

            $table->json('raw_response')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('plan_id');
        });

        Schema::create('hestia_accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('hestia_user')->nullable();
            $table->string('domain')->nullable();
            $table->string('ftp_user')->nullable();
            $table->string('database_name')->nullable();
            $table->string('database_user')->nullable();

            $table->json('raw_response')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hestia_accounts');
        Schema::dropIfExists('pterodactyl_servers');
        Schema::dropIfExists('services');
        Schema::dropIfExists('payments');
    }
};