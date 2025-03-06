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
        Schema::create('hoteldetail', function (Blueprint $table) {
            $table->id();
            $table->string('HotelName')->unique();
            $table->string('HotelAddress');
            $table->string('HotelLocation');
            $table->string('HotelState');
            $table->string('HotelProvince');
            $table->string('HotelCity');
            $table->string('HotelLogo');
            $table->string('HotelBanner');
            $table->string('HotelPhone');
            $table->string('HotelEmail');
            $table->string('HotelWebsite');
            $table->string('HotelDescription');
            $table->string('HotelRating');
            $table->string('HotelStatus');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoteldetail');
    }
};
