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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // movie_id en texto porque tus IDs son "01", "02", etc.
            $table->string('movie_id'); 
            // Relación con el usuario que escribe la reseña
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // La puntuación (estrellas)
            $table->integer('rating');
            // El texto de la reseña
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};