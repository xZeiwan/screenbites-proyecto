<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('movie_id');
            $table->string('seats')->nullable(); // Guardará "D7,D8,D9"
            $table->decimal('total_price', 8, 2)->default(0);
            $table->timestamps();
        });
    }
};
