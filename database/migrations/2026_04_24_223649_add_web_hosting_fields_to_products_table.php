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
    Schema::table('products', function (Blueprint $table) {
        $table->string('ram')->nullable()->after('preco');
        $table->string('armazenamento')->nullable()->after('ram');
        $table->string('processamento')->nullable()->after('armazenamento');
        $table->string('bancos_dados')->nullable()->after('processamento');
        $table->string('dominios')->nullable()->after('bancos_dados');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
