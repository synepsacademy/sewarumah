<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('datakosts', function (Blueprint $table) {
            if (!Schema::hasColumn('datakosts', 'kota_id')) {
                $table->unsignedBigInteger('kota_id')->nullable()->after('jumlah_kamar');
            }
        });
    }

    public function down(): void
    {
        Schema::table('datakosts', function (Blueprint $table) {
            $table->dropForeign(['kota_id']);
            $table->dropColumn('kota_id');
            $table->string('kota');
        });
    }
};
