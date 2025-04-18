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
        Schema::create('bookingsubmition', function (Blueprint $table) {
            $table->id();
            $table->string('DocumentNumber');
            $table->date('BookingDate');
            $table->datetime('BookingTime');
            $table->integer('UserID');
            $table->string('BookingType'); // Hotel, Tour, Transport
            $table->integer('ProductID');
            $table->integer('PackageID');
            $table->string('PartnerCode');
            $table->string('BookingFullName');
            $table->string('BookingEmail');
            $table->string('BookingPhone');
            $table->string('BookingIdentityID');
            $table->integer('AdultBookingPerson');
            $table->integer('ChildBookingPerson');
            $table->integer('InfantBookingPerson');
            $table->double('TransactionAmt');
            $table->double('TransactionTax');
            $table->double('TransactionDiscount');
            $table->string('DiscountVoucerCode');
            $table->double('DiscountVoucerAmt');
            $table->double('TotalNetTransaction');
            $table->double('TotalPayment');
            $table->string('PaymentMethod');
            $table->string('PaymentReff');
            $table->datetime('PaymentIssued');
            $table->longtext('SpecialRequest');
            $table->integer('BookingStatus'); // 0: WaitingPayment, 1: Paid, 2: Booking Confirmed, 3: Checkin, 4: Done
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingsubmition');
    }
};
