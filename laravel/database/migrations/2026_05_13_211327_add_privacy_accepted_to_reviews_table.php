<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('reviews', function (BluePrint $table) {
        $table->boolean('privacy_accepted')->default(false); // Guardará 0 o 1
    });
}
};
