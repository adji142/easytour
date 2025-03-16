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
        Schema::create('hotelroom', function (Blueprint $table) {
            $table->id();
            $table->integer('HotelID');
            $table->string('RoomName');
            $table->string('RoomType');
            $table->integer('RoomCapacity');
            $table->integer('RoomSize');
            $table->string('RoomBedType');
            $table->double('RoomPrice');
            $table->string('RoomStatus');
            $table->string('RoomDescription');
            $table->double('RoomRating')->default(0);
            $table->double('RoomDiscount')->default(0);
            $table->datetime('RoomDiscountStart')->nullable();
            $table->datetime('RoomDiscountEnd')->nullable();
            $table->integer('RoomDiscountStatus')->nullable();
            $table->integer('RoomFacilityAC')->default(0);
            $table->integer('RoomFacilityTV')->default(0);
            $table->integer('RoomFacilityShower')->default(0);
            $table->integer('RoomFacilityWaterHeater')->default(0);
            $table->integer('RoomFacilityFreeWifi')->default(0);
            $table->integer('RoomFacilityBreakfast')->default(0);
            $table->integer('RoomFacilityNoSmoking')->default(0);
            $table->integer('RoomFacilityParking')->default(0);
            $table->integer('RoomFacilitySwimmingPool')->default(0);
            $table->integer('RoomFacilityFitness')->default(0);
            $table->string('RoomInclude')->default('');
            $table->string('RoomExclude')->default('');
            $table->string('RoomWhyChooseUS')->default('');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotelroom');
    }
};
