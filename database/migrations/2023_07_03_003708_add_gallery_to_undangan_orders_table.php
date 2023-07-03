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
            $table->text('gallery')->nullable();
            $table->string('fotopria')->nullable();
            $table->string('fotowanita')->nullable();
            $table->string('ortupria')->nullable();
            $table->string('ortuwanita')->nullable();
            $table->string('asalwanita')->nullable();
            $table->string('asalpria')->nullable();
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
