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
        Schema::create('transportationdetail', function (Blueprint $table) {
            $table->id();
            $table->string('TransportationName');
            $table->string('TransportationType');
            $table->string('TransportationDescription');
            $table->string('TransportationTnC');
            $table->string('TransportationCapacity');
            $table->string('Status');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportationdetail');
    }
};
