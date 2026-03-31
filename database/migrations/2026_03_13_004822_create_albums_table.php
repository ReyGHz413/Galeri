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
        Schema::create('albums', function (Blueprint $table) {
    $table->id('albumID'); // Primary Key [cite: 60]
    $table->string('namaAlbum', 255); // [cite: 61]
    $table->text('deskripsi'); // [cite: 62]
    $table->date('tanggalDibuat'); // [cite: 63]
    $table->unsignedBigInteger('userID'); // Foreign Key ke users [cite: 64]

    $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
