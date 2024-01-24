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
        Schema::table('orders', function (Blueprint $table) {
            
            $table->integer('extratime_price')->after('total')->nullable();
            $table->integer('addbackground_price')->after('total')->nullable();
            $table->integer('addprint_price')->after('total')->nullable();
            $table->integer('person_price')->after('total')->nullable();
            $table->integer('person')->after('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
