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
        Schema::create('transportationpackage', function (Blueprint $table) {
            $table->id();
            $table->string('TransportationID');
            $table->string('PackageName');
            $table->decimal('PackagePrice');
            $table->decimal('PackagePriceDiscount');
            $table->string('TransportationCapacity');
            $table->string('TransportationRentDuration');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportationpackage');
    }
};
