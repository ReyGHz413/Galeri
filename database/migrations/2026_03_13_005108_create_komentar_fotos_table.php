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
        Schema::create('komentarfotos', function (Blueprint $table) {
            $table->id('komentarID'); // Primary Key [cite: 74]
    $table->unsignedBigInteger('fotoID'); // Foreign Key ke foto [cite: 75]
    $table->unsignedBigInteger('userID'); // Foreign Key ke users [cite: 76]
    $table->text('isiKomentar'); // [cite: 77]
    $table->date('tanggalKomentar'); // [cite: 78]

    $table->foreign('fotoID')->references('fotoID')->on('fotos')->onDelete('cascade');
    $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentarfotos');
    }
};
