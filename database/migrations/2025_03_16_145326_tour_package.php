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
        Schema::create('tourpackage', function (Blueprint $table) {
            $table->id();
            $table->integer('TourID');
            $table->string('TourPackageName');
            $table->date('TourStartDate');
            $table->date('TourEndDate');
            $table->text('TourPackageDescription');
            $table->double('TourPackagePrice');
            $table->double('TourPackageDiscount');
            $table->double('TourPackageDiscountPrice');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourpackage');
    }
};
