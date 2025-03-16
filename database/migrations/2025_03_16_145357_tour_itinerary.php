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
        Schema::create('touritinerary', function (Blueprint $table) {
            $table->id();
            $table->integer('TourID');
            $table->string('TourItineraryName');
            $table->string('TourItineraryDescription');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('touritinerary');
    }
};
