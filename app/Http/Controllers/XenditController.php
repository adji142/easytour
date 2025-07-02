<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Log;

use Xendit\Xendit;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

use App\Models\TourDetail;
use App\Models\TourType;
use App\Models\TourImage;
use App\Models\TourPackage;
use App\Models\TourItinerary;
use App\Models\EasyTourSetting;
use App\Models\User;
use App\Models\BookingSubmition;
use App\Models\DocumentNumbering;
use App\Models\HotelDetail;
use App\Models\HotelImage;
use App\Models\HotelRoom;
use App\Models\TransportationDetail;
use App\Models\TransportationImage;
use App\Models\TransportationPackage;

class XenditController extends Controller
{
    private $invoiceApi;
    public function __construct()
    {
        // Xendit::sendApiKey('');
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
    }

    public function createInvoice(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array(), 'payment_url' => '', 'invoice_id'=>'' );

        $dataRequest = $request->formData;
        // dd($dataRequest);

        $externalId = 'booking-' . uniqid(); // string unik
        $amount = (float) $dataRequest['TotalNetTransaction']; // pastikan float

        $apiInstance = new InvoiceApi();
        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => $externalId,
            'description' => 'Payment Booking User',
            'amount' => $amount,
            'invoice_duration' => 172800,
            'currency' => 'IDR',
            'reminder_time' => 1
        ]); // \Xendit\Invoice\CreateInvoiceRequest

        try {
            $result = $apiInstance->createInvoice($create_invoice_request);
            // dd($result);
            $currentDate = Carbon::now();
            $Year = $currentDate->format('y');
            $Month = $currentDate->format('m');

            $prefix = $Year.$Month;

            $booking = BookingSubmition::create([
                'DocumentNumber' => time(),
                'BookingDate' => $dataRequest['BookingDate'],
                'BookingTime' => Carbon::now(),
                'UserID' => $dataRequest['UserID'],
                'BookingType' => $dataRequest['BookingType'],
                'ProductID' => $dataRequest['ProductID'],
                'PackageID' => $dataRequest['PackageID'],
                'PartnerCode' => $dataRequest['PartnerCode'],
                'BookingFullName' => $dataRequest['BookingFullName'],
                'BookingEmail' => $dataRequest['BookingEmail'],
                'BookingPhone' => $dataRequest['BookingPhone'] ?? '',
                'BookingIdentityID' => $dataRequest['BookingIdentityID'] ?? '',
                'AdultBookingPerson' => $dataRequest['AdultBookingPerson'],
                'ChildBookingPerson' => $dataRequest['ChildBookingPerson'],
                'InfantBookingPerson' => $dataRequest['InfantBookingPerson'],
                'TransactionAmt' => $dataRequest['TransactionAmt'],
                'TransactionTax' => $dataRequest['TransactionTax'],
                'TransactionDiscount' => $dataRequest['TransactionDiscount'],
                'DiscountVoucerCode' => $dataRequest['DiscountVoucerCode'] ?? '',
                'DiscountVoucerAmt' => $dataRequest['DiscountVoucerAmt'],
                'TotalNetTransaction' => $dataRequest['TotalNetTransaction'],
                'TotalPayment' => 0,
                'PaymentMethod' =>$dataRequest['PaymentMethod'],
                'PaymentReff' => $result->getId(),
                'PaymentIssued' => $currentDate->toDateTimeString(),
                'SpecialRequest' => empty($dataRequest['SpecialRequest']) ? "" : $dataRequest['SpecialRequest'],
                'BookingStatus' => 0, // Success
            ]);
            // dd($booking);
            // return redirect($result->getInvoiceUrl());
            $data['success'] = true;
            $data['payment_url'] = $result->getInvoiceUrl();
            $data['invoice_id'] = $result->getId();
        } catch (\Xendit\XenditSdkException $e) {
            $data['message'] = $e->getMessage();
        }
        return response()->json($data, 200);
    }

    public function checkInvoiceStatus($invoiceId)
    {
        try {
            $invoiceApi = new InvoiceApi();
            $invoice = $invoiceApi->getInvoiceById($invoiceId);

            if($invoice->getStatus() == "SETTLED"){
                $booking = BookingSubmition::where('PaymentReff', $invoice->getId())->first();
                if($booking){
                    $booking->BookingStatus = 1; // Update status ke Success
                    $booking->TotalPayment = $invoice->getAmount(); // Update jumlah pembayaran
                    $booking->PaymentIssued = Carbon::now(); // Update tanggal pembayaran
                    $booking->PaymentMethod = $invoice->getPaymentMethod(); // Update metode pembayaran
                    $booking->XenditReturn = json_encode($invoice); // Simpan data callback Xendit
                    $booking->save();
                }
            }
            else if($invoice->getStatus() == "EXPIRED"){
                $booking = BookingSubmition::where('PaymentReff', $invoice->getId())->first();
                if($booking){
                    $booking->BookingStatus = 2; // Update status ke Expired
                    $booking->save();
                }
            }

            return response()->json([
                'status' => $invoice->getStatus(), 
            ]);
        } catch (\Xendit\XenditSdkException $e) {
            Log::error('Xendit invoice status check failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to check payment status.'], 500);
        }
    }

    public function callback(Request $request)
    {
        $data = $request->all();

        // Simpan log atau proses transaksi sesuai business logic
        // \Log::info('Callback dari Xendit:', $data);

        $booking = BookingSubmition::where('PaymentReff', $data['id'])->first();
        if (!$booking) {
            return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
        }

        $booking->BookingStatus = 1; // Update status ke Success
        $booking->TotalPayment = $data['paid_amount']; // Update jumlah pembayaran
        $booking->PaymentIssued = Carbon::now(); // Update tanggal pembayaran
        $booking->PaymentMethod = $data['payment_method']; // Update metode pembayaran
        $booking->XenditReturn = json_encode($data); // Simpan data callback Xendit
        $booking->save();
        // Simpan ke database dsb...

        return response()->json(['status' => 'success']);
    }
}
