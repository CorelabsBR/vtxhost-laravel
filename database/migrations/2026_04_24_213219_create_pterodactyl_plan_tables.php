<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pterodactyl_location', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('pterodactyl_eggs', function (Blueprint $table) {
            $table->id();
            $table->integer('egg_id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('pterodactyl_nodes', function (Blueprint $table) {
            $table->id();
            $table->string('fqdn');
            $table->foreignId('locationid')->constrained('pterodactyl_location');
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->increments('plan');
            $table->string('name');
            $table->foreignId('jogo_id')->constrained('jogos_prod');
            $table->integer('ram');
            $table->integer('disk');
            $table->foreignId('egg')->nullable()->constrained('pterodactyl_eggs');
            $table->integer('cpu')->nullable();
            $table->integer('price')->default(0);
            $table->foreignId('location_id')->constrained('location_prod');
            $table->timestamp('created_at')->useCurrent();
        });

        DB::table('location_prod')->insert([
            ['localidade' => 'Brasil'],
        ]);

        DB::table('jogos_prod')->insert([
            ['nome' => 'Minecraft Java'],
            ['nome' => 'Minecraft Bedrock'],
            ['nome' => 'Terraria'],
            ['nome' => 'GTA V'],
            ['nome' => 'GTA SA'],
            ['nome' => 'BeamNG Drive'],
            ['nome' => 'RDR2'],
            ['nome' => 'Hogwarts Legacy'],
            ['nome' => 'ARMA 3'],
        ]);

        DB::table('pterodactyl_eggs')->insert([
            ['egg_id' => 5, 'name' => 'Minecraft Java'],
            ['egg_id' => 78, 'name' => 'Minecraft Bedrock'],
            ['egg_id' => 60, 'name' => 'Terraria'],
            ['egg_id' => 63, 'name' => 'FiveM'],
            ['egg_id' => 66, 'name' => 'MTA'],
            ['egg_id' => 79, 'name' => 'BeamMP'],
            ['egg_id' => 71, 'name' => 'RedM'],
            ['egg_id' => 70, 'name' => 'Hogwarp'],
            ['egg_id' => 69, 'name' => 'ARMA3'],
        ]);

        DB::table('pterodactyl_location')->insert([
            ['name' => 'vtx-sa-1'],
        ]);

        DB::table('pterodactyl_nodes')->insert([
            ['fqdn' => 'node.ion.vortex.corelabs.dev.br', 'locationid' => 1],
        ]);

        DB::table('plans')->insert([
            ['name' => 'Tier Carvão', 'jogo_id' => 1, 'ram' => 2000, 'disk' => 40000, 'cpu' => null, 'location_id' => 1, 'egg' => 1],
            ['name' => 'Tier Ferro', 'jogo_id' => 1, 'ram' => 4000, 'disk' => 80000, 'cpu' => null, 'location_id' => 1, 'egg' => 1],
            ['name' => 'Tier Ouro', 'jogo_id' => 1, 'ram' => 8000, 'disk' => 160000, 'cpu' => null, 'location_id' => 1, 'egg' => 1],
            ['name' => 'Tier Diamante', 'jogo_id' => 1, 'ram' => 12000, 'disk' => 320000, 'cpu' => null, 'location_id' => 1, 'egg' => 1],
            ['name' => 'Tier Netherite', 'jogo_id' => 1, 'ram' => 16000, 'disk' => 640000, 'cpu' => null, 'location_id' => 1, 'egg' => 1],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
        Schema::dropIfExists('pterodactyl_nodes');
        Schema::dropIfExists('pterodactyl_eggs');
        Schema::dropIfExists('pterodactyl_location');
    }
};