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
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->string('name');
            $table->text('deskripsi');
            $table->enum('kategori', [
                'Kancing',
                'Kain',
                'Benang',
                'Resleting',
                'Jarum',
                'Gunting',
                'Minyak Mesin',
                'Penggaris',
                'Karet',
                'Tali',
                'Label',
                'Aksesoris',
                'Lainnya'
            ]);
            $table->integer('harga');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
