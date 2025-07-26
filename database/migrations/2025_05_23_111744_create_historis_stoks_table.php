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
        Schema::create('historis_stoks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_barang');
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
            $table->string('bulan'); // format: YYYY-MM
            $table->integer('stok_terjual')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historis_stoks');
    }
};
