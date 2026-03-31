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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id('fotoID'); // Primary Key [cite: 66]
    $table->string('judulFoto', 255); // [cite: 67]
    $table->text('deskripsiFoto'); // [cite: 68]
    $table->date('tanggalUnggah'); // [cite: 69]
    $table->string('lokasiFile', 255); // [cite: 70]
    $table->unsignedBigInteger('albumID'); // Foreign Key ke album [cite: 71]
    $table->unsignedBigInteger('userID'); // Foreign Key ke users [cite: 72]

    $table->foreign('albumID')->references('albumID')->on('albums')->onDelete('cascade');
    $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
