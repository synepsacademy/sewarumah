<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('datakost_id')->constrained()->onDelete('cascade');
            $table->date('checkin_date');
            $table->enum('status', ['menunggu', 'diproses', 'dibayar', 'dibatalkan'])->default('menunggu');
            $table->string('kode_booking')->unique();
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
