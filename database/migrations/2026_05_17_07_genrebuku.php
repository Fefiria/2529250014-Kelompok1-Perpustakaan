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
        Schema::create('genre_bukus', function (Blueprint $table) {
            $table->id('idGenreBuku');
            $table->integer('idGenre')->constrained('genres', 'idGenre')->onDelete('cascade');
            $table->integer('idBuku')->constrained('bukus', 'idBuku')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_bukus');
    }
};
