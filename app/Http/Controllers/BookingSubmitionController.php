<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;

use Illuminate\Http\Request;
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

use Inertia\Inertia;
use Midtrans\Snap;
use Midtrans\Config;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingSubmitionController extends Controller
{
    public function index($encoded) {
        $decoded = base64_decode(urldecode($encoded));
        $bookingData = json_decode($decoded, true);

        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();

        $BookingType = $bookingData['BookingType'];
        $ProductID = $bookingData['ProductID'];
        $PackageID = $bookingData['PackageID'];
        $AdultBookingPerson = $bookingData['AdultBookingPerson'];
        $ChildBookingPerson = $bookingData['ChildBookingPerson'];
        $InfantBookingPerson = $bookingData['InfantBookingPerson'];
        $UserID = $bookingData['UserID'];
        $BookingDate = $bookingData['BookingDate'];
        $SpecialRequest = $bookingData['SpecialRequest'];


        $oDataProduk = null;
        $oDataProdukImage = null;
        $oDataProdukPackage = null;

        $oDataUser = User::where('id', $UserID)->first();

        switch ($BookingType) {
            case 'Hotel':
                # code...
                $oDataProduk = HotelDetail::where('id',$ProductID)->first();
                $oDataProdukImage = HotelImage::where('HotelID', $ProductID)->get();
                $oDataProdukPackage = HotelRoom::selectRaw("hotelroom.*, roomtype.RoomTypeName, bedtype.BedTypeName")
                                        ->leftJoin('roomtype', function ($value){
                                            $value->on('roomtype.id','=','hotelroom.RoomType')
                                            ->on('roomtype.RecordOwnerID','=', 'hotelroom.RecordOwnerID');
                                        })
                                        ->leftJoin('bedtype', function ($value){
                                            $value->on('bedtype.id','=','hotelroom.RoomBedType')
                                            ->on('bedtype.RecordOwnerID','=', 'hotelroom.RecordOwnerID');
                                        })
                                        ->first();
                break;
            case 'Tour':
                $oDataProduk = TourDetail::where('id',$ProductID)->first();
                $oDataProdukImage = TourImage::where('TourID', $ProductID)->get();
                $oDataProdukPackage = TourPackage::where('TourID', $ProductID)
                                        ->where('id', $PackageID)
                                        ->first();
                break;
            case 'Transport':
                $oDataProduk = TransportationDetail::where('id',$ProductID)->first();
                $oDataProdukImage = TransportationImage::where('TransportationID', $ProductID)->get();
                $oDataProdukPackage = TransportationPackage::selectRaw("id, TransportationID, PackageName, CAST(PackagePrice AS double) PackagePrice, CAST(PackagePriceDiscount AS double) PackagePriceDiscount, TransportationCapacity, TransportationRentDuration, RecordOwnerID")
                                        ->where('TransportationID', $ProductID)
                                        ->where('id', $PackageID)
                                        ->first();
                break;
            
            default:
                # code...
                break;
        }

        // dd(Auth::user());
        return Inertia::render('PaymentPage',[
            'easyTourSetting' => $easyTourSetting,
            'oDataProduk' => $oDataProduk,
            'oDataProdukImage' => $oDataProdukImage,
            'oDataProdukPackage' => $oDataProdukPackage,
            'oDataUser' => $oDataUser,
            'bookingData' => $bookingData,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
            'BannerName' => 'Booking Payment'
        ]);
    }

    public function createMidTransTransaction(Request $request){
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Data transaksi yang akan dikirimkan ke Midtrans
        $transaction_details = [
            'order_id' => uniqid().time(),
            'gross_amount' => floatval($request->amount), // Jumlah total transaksi
        ];

        $customer_details = [
            'first_name' => $request->name,
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function SaveBooking(Request $request) {
        $data = array('success' => false, 'message' => '', 'data' => array());

        $dataRequest = $request->formData;

        DB::beginTransaction();
        try {
            // $numberingData = new DocumentNumbering();
            // $NoTransaksi = $numberingData->GetNewDoc("bookingsubmition","DocumentNumber");
            $currentDate = Carbon::now();
            $Year = $currentDate->format('y');
            $Month = $currentDate->format('m');

            $prefix = $Year.$Month;
            // $lastNoTRX = DB::select(DB::raw("SELECT * FROM bookingsubmition WHERE LEFT(DocumentNumber, ".strlen($prefix).") = '".$prefix."' " ));
            // // var_dump($lastNoTRX);
            // $NoTransaksi = $prefix.str_pad(count($lastNoTRX) + 1, $CharLength, '0', STR_PAD_LEFT);
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
                'TotalPayment' => $dataRequest['TotalPayment'],
                'PaymentMethod' => $dataRequest['PaymentMethod'] ?? null,
                'PaymentReff' => $dataRequest['PaymentReff'] ?? null,
                'PaymentIssued' => $dataRequest['PaymentIssued'],
                'SpecialRequest' => $dataRequest['SpecialRequest'],
                'BookingStatus' => 1, // Success
            ]);

            DB::commit();

            // return redirect()->back()->with('success', 'Booking saved successfully!');
            $data['success'] = true;
        } catch (\Exception $e) {
            DB::rollBack();
            $data['success'] = false;
            $data['message']='Failed to save booking: ' . $e->getMessage();
            // return redirect()->back()->with('error', 'Failed to save booking: ' . $e->getMessage());
        }
        return response()->json($data);
    }

    public function BookingHistoryList(Request $request){
        // $TglAwal = $requst->input('TglAwal');
        // $TglAkhir = $request->input('TglAkhir');

        $sql = "bookingsubmition.id     as BookingID, 
                bookingsubmition.DocumentNumber,
                bookingsubmition.BookingDate, 
                bookingsubmition.BookingTime,
                bookingsubmition.BookingType,
                bookingsubmition.BookingFullName,
                bookingsubmition.BookingEmail,
                bookingsubmition.AdultBookingPerson,
                bookingsubmition.ChildBookingPerson,
                bookingsubmition.InfantBookingPerson,
                CASE WHEN bookingsubmition.BookingType = 'Tour' THEN tourdetail.TourName ELSE 
                    CASE WHEN bookingsubmition.BookingType = 'Hotel' THEN hoteldetail.HotelName ELSE 
                        CASE WHEN bookingsubmition.BookingType = 'Travel' THEN '' ELSE '' END
                    END
                END BookingItem, 
                CASE WHEN bookingsubmition.BookingType = 'Tour' THEN tourpackage.TourPackageName ELSE 
                    CASE WHEN bookingsubmition.BookingType = 'Hotel' THEN hotelroom.RoomName ELSE 
                        CASE WHEN bookingsubmition.BookingType = 'Travel' THEN '' ELSE '' END
                    END
                END BookingPackage, 
                bookingsubmition.TotalNetTransaction, 
                bookingsubmition.PaymentMethod,
                bookingsubmition.PaymentReff, 
                bookingsubmition.PaymentIssued ";
        $bookings = BookingSubmition::selectRaw($sql)
                        ->leftJoin('users', function ($value){
                            $value->on('bookingsubmition.UserID','=','users.id');
                        })
                        ->leftJoin('tourdetail', function ($value){
                            $value->on('tourdetail.id','=','bookingsubmition.ProductID')
                            ->on('tourdetail.RecordOwnerID','=','bookingsubmition.PartnerCode');
                        })
                        ->leftJoin('tourpackage', function ($value){
                            $value->on('tourpackage.id','=','bookingsubmition.PackageID')
                            ->on('tourpackage.RecordOwnerID','=','bookingsubmition.PartnerCode');
                        })
                        ->leftJoin('hoteldetail', function ($value){
                            $value->on('hoteldetail.id','=','bookingsubmition.ProductID')
                            ->on('hoteldetail.RecordOwnerID','=','bookingsubmition.ProductID');
                        })
                        ->leftJoin('hotelroom', function ($value){
                            $value->on('hotelroom.id','=','bookingsubmition.PackageID')
                            ->on('hotelroom.RecordOwnerID','=','bookingsubmition.PartnerCode');
                        })
                        // Transport
                        // ->whereBetween('bookingsubmition.BookingDate',[$TglAwal, $TglAkhir])
                        ->where('bookingsubmition.PartnerCode',Auth::user()->RecordOwnerID )
                        ->get();
        return view("Booking.BookingList", [
            'bookings' => $bookings
        ]);
    }

    function DownloadPDF($documentnumber) {
        // $BookingType = $request->BookingType;
        // $BookingID = $request->BookingID;

        $sql = "bookingsubmition.id     as BookingID, 
                bookingsubmition.DocumentNumber,
                bookingsubmition.BookingDate, 
                bookingsubmition.BookingTime,
                bookingsubmition.BookingType,
                bookingsubmition.BookingFullName,
                bookingsubmition.BookingEmail,
                bookingsubmition.AdultBookingPerson,
                bookingsubmition.ChildBookingPerson,
                bookingsubmition.InfantBookingPerson,
                CASE WHEN bookingsubmition.BookingType = 'Tour' THEN tourdetail.TourName ELSE 
                    CASE WHEN bookingsubmition.BookingType = 'Hotel' THEN hoteldetail.HotelName ELSE 
                        CASE WHEN bookingsubmition.BookingType = 'Travel' THEN '' ELSE '' END
                    END
                END BookingItem, 
                CASE WHEN bookingsubmition.BookingType = 'Tour' THEN tourpackage.TourPackageName ELSE 
                    CASE WHEN bookingsubmition.BookingType = 'Hotel' THEN hotelroom.RoomName ELSE 
                        CASE WHEN bookingsubmition.BookingType = 'Travel' THEN '' ELSE '' END
                    END
                END BookingPackage, 
                bookingsubmition.TotalNetTransaction, 
                bookingsubmition.PaymentMethod,
                bookingsubmition.PaymentReff, 
                bookingsubmition.PaymentIssued,
                company.PartnerName, 
                company.BillingAddress,
                company.Phone as CompanyPhone,
                company.Email as CompanyEmail,
                bookingsubmition.SpecialRequest ";
        $bookings = BookingSubmition::selectRaw($sql)
                        ->leftJoin('users', function ($value){
                            $value->on('bookingsubmition.UserID','=','users.id');
                        })
                        ->leftJoin('tourdetail', function ($value){
                            $value->on('tourdetail.id','=','bookingsubmition.ProductID')
                            ->on('tourdetail.RecordOwnerID','=','bookingsubmition.PartnerCode');
                        })
                        ->leftJoin('tourpackage', function ($value){
                            $value->on('tourpackage.id','=','bookingsubmition.PackageID')
                            ->on('tourpackage.RecordOwnerID','=','bookingsubmition.PartnerCode');
                        })
                        ->leftJoin('hoteldetail', function ($value){
                            $value->on('hoteldetail.id','=','bookingsubmition.ProductID')
                            ->on('hoteldetail.RecordOwnerID','=','bookingsubmition.ProductID');
                        })
                        ->leftJoin('hotelroom', function ($value){
                            $value->on('hotelroom.id','=','bookingsubmition.PackageID')
                            ->on('hotelroom.RecordOwnerID','=','bookingsubmition.PartnerCode');
                        })
                        ->leftJoin('company', function ($value){
                            $value->on('company.PartnerCode','=','bookingsubmition.PartnerCode');
                        })
                        // Transport
                        // ->whereBetween('bookingsubmition.BookingDate',[$TglAwal, $TglAkhir])
                        ->where('bookingsubmition.DocumentNumber',$documentnumber )
                        ->first();
        $pdf = Pdf::loadView('pdf.voucherbooking', ['data' => $bookings]);
        $filename = 'voucher_' . now()->format('Ymd_His') . '.pdf';
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $filename);
    }
}
