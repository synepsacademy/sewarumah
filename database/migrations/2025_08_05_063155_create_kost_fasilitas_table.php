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
        Schema::create('kost_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datakost_id');
            $table->unsignedBigInteger('fasilitas_id');
            $table->timestamps();

            // optional foreign keys
            $table->foreign('datakost_id')->references('id')->on('datakosts')->onDelete('cascade');
            $table->foreign('fasilitas_id')->references('id')->on('fasilitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kost_fasilitas');
    }
};
