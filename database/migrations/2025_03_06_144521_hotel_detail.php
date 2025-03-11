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
            $table->string('HotelLogo')->nullable();
            $table->string('HotelBanner')->nullable();
            $table->string('HotelPhone')->nullable();
            $table->string('HotelEmail')->nullable();
            $table->string('HotelWebsite')->nullable();
            $table->string('HotelDescription')->nullable();
            $table->string('HotelRating')->nullable();
            $table->string('HotelStatus')->default('Y');
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
