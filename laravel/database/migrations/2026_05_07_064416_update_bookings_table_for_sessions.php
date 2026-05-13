<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Primero eliminamos la referencia antigua si existía
            if (Schema::hasColumn('bookings', 'movie_id')) {
                $table->dropColumn('movie_id');
            }
            // Añadimos la relación con la sesión específica
            $table->foreignId('showtime_id')->after('user_id')->constrained('showtimes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
