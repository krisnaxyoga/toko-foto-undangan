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
        Schema::table('undangan_orders', function (Blueprint $table) {
            $table->string('tempat_acara')->nullable();
            $table->string('waktu_mulai')->nullable();
            $table->string('waktu_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('undangan_orders', function (Blueprint $table) {
            //
        });
    }
};
