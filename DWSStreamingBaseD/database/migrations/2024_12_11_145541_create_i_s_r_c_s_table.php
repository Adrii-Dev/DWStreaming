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
        Schema::create('isrcs', function (Blueprint $table) {
            $table->id();
            $table->integer('isrc')->unique();
            $table->integer('peli_id')->nullable();
            $table->string('tipo');
            $table->timestamps();
        });
        Schema::table('peliculas', function (Blueprint $table) {
            $table->integer('isrc_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('isrcs');
    }
};
