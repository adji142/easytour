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
use Inertia\Inertia;

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
                break;
            case 'Tour':
                $oDataProduk = TourDetail::where('id',$ProductID)->first();
                $oDataProdukImage = TourImage::where('TourID', $ProductID)->get();
                $oDataProdukPackage = TourPackage::where('TourID', $ProductID)
                                        ->where('id', $PackageID)
                                        ->first();
                break;
            case 'Transport':

                break;
            
            default:
                # code...
                break;
        }

        return Inertia::render('PaymentPage',[
            'easyTourSetting' => $easyTourSetting,
            'oDataProduk' => $oDataProduk,
            'oDataProdukImage' => $oDataProdukImage,
            'oDataProdukPackage' => $oDataProdukPackage,
            'oDataUser' => $oDataUser,
            'bookingData' => $bookingData
        ]);
    }
}
