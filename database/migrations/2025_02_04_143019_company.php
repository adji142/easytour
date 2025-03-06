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
        Schema::create('company', function (Blueprint $table) {
            $table->string('PartnerCode')->primary();
            $table->string('PartnerName');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('ShippingAddress');
            $table->string('ShippingState');
            $table->string('ShipingProvince');
            $table->string('ShippingCity');
            $table->string('ShippingZip');
            $table->string('ShippingCountry');
            $table->string('BillingAddress');
            $table->string('BillingState');
            $table->string('BillingProvince');
            $table->string('BillingCity');
            $table->string('BillingZip');
            $table->string('BillingCountry');
            $table->string('Phone')->unique();
            $table->string('Email')->unique();
            $table->string('Website')->nullable();
            $table->string('Logo')->nullable();
            $table->string('Status');
            $table->string('Notes');
            $table->integer('EmailVerified')->nullable();
            $table->datetime('EmailVerifiedAt')->nullable();
            $table->integer('PhoneVerified')->nullable();
            $table->datetime('PhoneVerifiedAt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
