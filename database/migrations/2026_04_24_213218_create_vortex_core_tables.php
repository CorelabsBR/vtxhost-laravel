<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');

            $table->string('cpf_cnpj', 20)->nullable()->unique();
            $table->string('celular', 20)->nullable();

            $table->string('cep', 20)->nullable();
            $table->string('rua')->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();

            $table->date('data_nasc')->nullable();

            $table->enum('tipo_usuario', ['cliente', 'root'])->default('cliente');

            $table->timestamp('criado_em')->useCurrent();
            $table->timestamp('atualizado_em')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::create('categoria_prod', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
        });

        Schema::create('jogos_prod', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->boolean('ativo')->default(true);
        });

        Schema::create('location_prod', function (Blueprint $table) {
            $table->id();
            $table->string('localidade');
            $table->boolean('ativo')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_prod');
        Schema::dropIfExists('jogos_prod');
        Schema::dropIfExists('categoria_prod');
        Schema::dropIfExists('user');
    }
};