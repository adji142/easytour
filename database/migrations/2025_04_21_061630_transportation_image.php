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
        Schema::create('transportationimage', function (Blueprint $table) {
            $table->id();
            $table->integer('TransportationID');
            $table->longtext('TransportationImage');
            $table->integer('isBanner');
            $table->string('ImageCategory');
            $table->string('RecordOwnerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportationimage');
    }
};
