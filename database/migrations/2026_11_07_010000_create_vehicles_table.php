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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kendaraan');
            $table->string('merk');
            $table->string('jenis'); // Mobil / Motor
            $table->year('tahun');
            // bigInteger karena integer biasa maksimal sekitar Rp2,1 miliar
            $table->bigInteger('harga');
            $table->integer('stok');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
