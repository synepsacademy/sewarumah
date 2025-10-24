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
        Schema::table('datakosts', function (Blueprint $table) {
            $table->dropColumn('kota');
        });
    }

    public function down()
    {
        Schema::table('datakosts', function (Blueprint $table) {
            $table->string('kota')->nullable(); // Bisa sesuaikan sesuai tipe awal
        });
    }
};
