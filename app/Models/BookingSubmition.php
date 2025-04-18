<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSubmition extends Model
{
    use HasFactory;
    protected $table = 'bookingsubmition';
    protected $fillable = [
        'DocumentNumber', 'BookingDate', 'BookingTime', 'UserID', 'BookingType',
        'ProductID', 'PackageID', 'PartnerCode', 'BookingFullName', 'BookingEmail',
        'BookingPhone', 'BookingIdentityID', 'AdultBookingPerson', 'ChildBookingPerson',
        'InfantBookingPerson', 'TransactionAmt', 'TransactionTax', 'TransactionDiscount',
        'DiscountVoucerCode', 'DiscountVoucerAmt', 'TotalNetTransaction',
        'TotalPayment', 'PaymentMethod', 'PaymentReff', 'SpecialRequest', 'BookingStatus','PaymentIssued'
    ];
}
