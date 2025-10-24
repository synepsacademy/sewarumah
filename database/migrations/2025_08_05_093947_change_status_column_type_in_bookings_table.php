<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Ubah tipe kolom status menjadi string jika belum
            $table->string('status')->default('menunggu')->change();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Optional: ubah kembali ke tipe sebelumnya jika diperlukan
            // Misalnya enum:
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu')->change();
        });
    }
};
