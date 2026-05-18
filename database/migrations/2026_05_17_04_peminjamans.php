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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id('idPeminjaman');
            $table->foreignId('idUser')->constrained('users', 'idUser')->onDelete('cascade');
            $table->foreignId('idBuku')->constrained('bukus', 'idBuku')->onDelete('cascade');
            $table->date('tanggalPeminjaman');
            $table->integer('lamaPinjam');
            $table->integer('jumlahBuku')->default(1);
            $table->string('status');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
