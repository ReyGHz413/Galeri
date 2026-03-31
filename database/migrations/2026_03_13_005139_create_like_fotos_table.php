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
        Schema::create('likefotos', function (Blueprint $table) {
            $table->id('likeID'); // Primary Key [cite: 80]
    $table->unsignedBigInteger('fotoID'); // Foreign Key ke foto [cite: 81]
    $table->unsignedBigInteger('userID'); // Foreign Key ke users [cite: 82]
    $table->date('tanggalLike'); // [cite: 83]

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
        Schema::dropIfExists('likefotos');
    }
};
