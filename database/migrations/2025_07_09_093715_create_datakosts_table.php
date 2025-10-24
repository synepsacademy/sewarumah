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
        Schema::create('datakosts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kost');
            $table->integer('harga');
            $table->text('alamat');
            $table->integer('jumlah_kamar');
            $table->string('kota');
            $table->string('foto')->nullable(); // opsional kalo kamu upload gambar
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datakosts');
    }
};
