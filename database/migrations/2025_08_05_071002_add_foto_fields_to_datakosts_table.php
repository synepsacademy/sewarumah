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
        Schema::table('datakosts', function (Blueprint $table) {
            $table->string('foto_1')->nullable();
            $table->string('foto_2')->nullable();
            $table->string('foto_3')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('datakosts', function (Blueprint $table) {
            $table->dropColumn(['foto_1', 'foto_2', 'foto_3']);
        });
    }
};
