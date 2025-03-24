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
        Schema::create('tourdetail', function (Blueprint $table) {
            $table->id();
            $table->string('TourName');
            $table->integer('TourTypeID');
            $table->integer('TourDuration');
            $table->integer('TourGroupSize')->nullable();
            $table->string('TourLocation');
            $table->string('TourCheckPoints');
            $table->string('TourCheckPoints2')->nullable();
            $table->string('TourCheckPoints3')->nullable();
            $table->text('TourDescription');
            $table->text('TourIncludeExclude');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourdetail');
    }
};
