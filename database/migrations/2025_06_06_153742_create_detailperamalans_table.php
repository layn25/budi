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
        Schema::create('detail_peramalans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_peramalan');
            $table->foreign('id_peramalan')->references('id')->on('peramalans')->onDelete('cascade');
            $table->string('periode'); // format YYYY-MM
            $table->integer('hasil_ramalan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailperamalans');
    }
};
