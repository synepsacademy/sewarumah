<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('kosts');
    }

    public function down()
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            // isi kolom seperti sebelumnya kalau perlu rollback
            $table->timestamps();
        });
    }
};
