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
    Schema::table('jogos_prod', function (Blueprint $table) {
        $table->string('icon')->nullable()->after('banner'); // ex: minecraft.png
    });
}

public function down(): void
{
    Schema::table('jogos_prod', function (Blueprint $table) {
        $table->dropColumn('icon');
    });
}
};
