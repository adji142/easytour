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
use Inertia\Inertia;

class TourDetailController extends Controller
{
    public function index() {
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();

        $subImage = DB::table('tourimage')
            ->select('TourID', DB::raw('MIN(TourImage) as TourImage'))
            ->groupBy('TourID');

        $subPackage = DB::table('tourpackage')
            ->select('TourID', DB::raw('MIN(TourPackagePrice - TourPackageDiscount) as FinalPrice'))
            ->groupBy('TourID');

        $tours = DB::table('tourdetail as td')
            ->leftJoinSub($subImage, 'ti', 'td.id', '=', 'ti.TourID')
            ->leftJoinSub($subPackage, 'tp', 'td.id', '=', 'tp.TourID')
            ->leftJoin('tourtype as tt', 'td.TourTypeID', '=', 'tt.id')
            ->select('td.id','td.TourName', 'ti.TourImage', 'tp.FinalPrice', 'tt.TourTypeName')
            ->get();

        $tourType = TourType::selectraw("tourtype.TourTypeName, COUNT(tourdetail.id) as TourCount")
                    ->leftJoin('tourdetail', 'tourtype.id', '=', 'tourdetail.TourTypeID')
                    ->groupBy('tourtype.TourTypeName')
                    ->get();

        return Inertia::render('Tour',[
            'easyTourSetting' => $easyTourSetting,
            'tours' => $tours,
            'tourcount' => count($tours),
            'tourType' => $tourType,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
        ]);
    }
    public function detail($id){
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();

        $tourDetail = TourDetail::selectRaw('tourdetail.*, tourtype.TourTypeName')
                        ->leftJoin('tourtype', function ($value){
                            $value->on('tourtype.id','=','tourdetail.TourTypeID')
                            ->on('tourtype.RecordOwnerID','=','tourdetail.RecordOwnerID');
                        })
                        ->where('tourdetail.id', $id)
                        ->first();
        $tourImage = TourImage::where('TourID', $id)->get();
        $tourItinerary = TourItinerary::where('TourID', $id)->get();
        $tourpackage = TourPackage::where('TourID', $id)->get();
        return Inertia::render('TourDetailPage', [
            'easyTourSetting' => $easyTourSetting,
            'tourDetail' => $tourDetail,
            'tourImage' => $tourImage,
            'tourItinerary' => $tourItinerary,
            'tourpackage' => $tourpackage,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
        ]);
    }
    public function View(Request $request)
    {
        $tourDetail = TourDetail::where('RecordOwnerID', Auth::user()->RecordOwnerID)->get();
        $tourType = TourType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->get();

        $title = 'Delete Tour !';
        $text = "Are you sure you want to delete ?";
        confirmDelete($title, $text);

        return view("Tour.Tour", [
            'tourDetail' => $tourDetail,
            'tourType' => $tourType
        ]);
    }

    public function Form($id = null)
    {
        $tourDetail = TourDetail::selectRaw("*")
            ->where('tourDetail.RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->where('tourDetail.id', '=', $id)->get();
        $tourType = TourType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->get();
        $tourImage = TourImage::where('RecordOwnerID', Auth::user()->RecordOwnerID)
                        ->where('TourID', $id)->get();
        $tourPackage = TourPackage::where('RecordOwnerID', Auth::user()->RecordOwnerID)
                        ->where('TourID', $id)->get();
        $tourItinerary = TourItinerary::where('RecordOwnerID', Auth::user()->RecordOwnerID)
                        ->where('TourID', $id)->get();
        
        return view("Tour.Tour-Input", [
            'tourDetail' => $tourDetail,
            'tourType' => $tourType,
            'tourImage' => $tourImage,
            'tourPackage' => $tourPackage,
            'tourItinerary' => $tourItinerary
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());

        DB::beginTransaction();

        try {
            $oImageData = json_decode($request->input('oImageData'), true);
            $oTourPackageData = json_decode($request->input('oTourPackageData'), true);
            $oTourItineraryData = json_decode($request->input('oTourItineraryData'), true);


            $model = new TourDetail;
            $model->TourTypeID = $request->input('TourTypeID');
            $model->TourName = $request->input('TourName');
            $model->TourTypeID = $request->input('TourTypeID');
            $model->TourDuration = $request->input('TourDuration');
            $model->TourGroupSize = $request->input('TourGroupSize');
            $model->TourLocation = $request->input('TourLocation');
            $model->TourCheckPoints = $request->input('TourCheckPoints');
            $model->TourCheckPoints2 = $request->input('TourCheckPoints2');
            $model->TourCheckPoints3 = $request->input('TourCheckPoints3');
            $model->TourDescription = $request->input('TourDescription');
            $model->TourIncludeExclude = $request->input('TourIncludeExclude');
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $oSaved = $model->save();

            if($oSaved){
                if (!empty($oImageData)) {
                    foreach ($oImageData as $image) {
                        $oTourImage = new TourImage;
                        $oTourImage->TourID = $model->id;
                        $oTourImage->TourImage = $image['image'];
                        $oTourImage->isBanner = 0;
                        $oTourImage->ImageCategory = json_encode($image['category']);
                        $oTourImage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourImage->save();
                    }
                }

                if (!empty($oTourPackageData)) {
                    foreach ($oTourPackageData as $package) {
                        $oTourPackage = new TourPackage;
                        $oTourPackage->TourID = $model->id;
                        $oTourPackage->TourPackageName = $package['TourPackageName'];
                        $oTourPackage->TourStartDate = $package['TourStartDate'];
                        $oTourPackage->TourEndDate = $package['TourEndDate'];
                        $oTourPackage->TourPackageDescription = $package['TourPackageDescription'];
                        $oTourPackage->TourPackagePrice = $package['TourPackagePrice'];
                        if ($package['TourPackageDiscountPrice'] > 0) {
                            $oTourPackage->TourPackageDiscount = $package['TourPackageDiscountPrice'] / $package['TourPackagePrice'] * 100;  
                        }
                        else{
                            $oTourPackage->TourPackageDiscount = 0;
                        }
                        $oTourPackage->TourPackageDiscountPrice = $package['TourPackageDiscountPrice'];
                        $oTourPackage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourPackage->save();
                    }
                }

                if(!empty($oTourItineraryData)){
                    foreach ($oTourItineraryData as $itinerary) {
                        $oTourItinerary = new TourItinerary;
                        $oTourItinerary->TourID = $model->id;
                        $oTourItinerary->DayNumber = $itinerary['DayNumber'];
                        $oTourItinerary->TourItineraryName = $itinerary['TourItineraryName'];
                        $oTourItinerary->TourItineraryDescription = $itinerary['TourItineraryDescription'];
                        $oTourItinerary->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourItinerary->save();
                    }
                }
            }

            $data['success'] = true;
            $data['message'] = 'Tour Saved Successfuly';
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function edit(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $oImageData = json_decode($request->input('oImageData'), true);
            $oTourPackageData = json_decode($request->input('oTourPackageData'), true);
            $oTourItineraryData = json_decode($request->input('oTourItineraryData'), true);

            $id = $request->input('id');
            $model = TourDetail::where('RecordOwnerID', Auth::user()->RecordOwnerID)->findOrFail($id);
            $model->TourTypeID = $request->input('TourTypeID');
            $model->TourName = $request->input('TourName');
            $model->TourTypeID = $request->input('TourTypeID');
            $model->TourDuration = $request->input('TourDuration');
            $model->TourGroupSize = $request->input('TourGroupSize');
            $model->TourLocation = $request->input('TourLocation');
            $model->TourCheckPoints = $request->input('TourCheckPoints');
            $model->TourCheckPoints2 = $request->input('TourCheckPoints2');
            $model->TourCheckPoints3 = $request->input('TourCheckPoints3');
            $model->TourDescription = $request->input('TourDescription');
            $model->TourIncludeExclude = $request->input('TourIncludeExclude');
            $oSaved = $model->save();

            if($oSaved){
                TourImage::where('TourID', $model->id)
                    ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
                    ->delete();
                TourPackage::where('TourID', $model->id)
                    ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
                    ->delete();
                TourItinerary::where('TourID', $model->id)
                    ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
                    ->delete();

                if (!empty($oImageData)) {
                    foreach ($oImageData as $image) {
                        $oTourImage = new TourImage;
                        $oTourImage->TourID = $model->id;
                        $oTourImage->TourImage = $image['image'];
                        $oTourImage->isBanner = 0;
                        $oTourImage->ImageCategory = json_encode($image['category']);
                        $oTourImage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourImage->save();
                    }
                }

                if (!empty($oTourPackageData)) {
                    foreach ($oTourPackageData as $package) {
                        $oTourPackage = new TourPackage;
                        $oTourPackage->TourID = $model->id;
                        $oTourPackage->TourPackageName = $package['TourPackageName'];
                        $oTourPackage->TourStartDate = $package['TourStartDate'];
                        $oTourPackage->TourEndDate = $package['TourEndDate'];
                        $oTourPackage->TourPackageDescription = $package['TourPackageDescription'];
                        $oTourPackage->TourPackagePrice = $package['TourPackagePrice'];
                        if ($package['TourPackageDiscountPrice'] > 0) {
                            $oTourPackage->TourPackageDiscount = $package['TourPackageDiscountPrice'] / $package['TourPackagePrice'] * 100;  
                        }
                        else{
                            $oTourPackage->TourPackageDiscount = 0;
                        }
                        $oTourPackage->TourPackageDiscountPrice = $package['TourPackageDiscountPrice'];
                        $oTourPackage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourPackage->save();
                    }
                }

                if(!empty($oTourItineraryData)){
                    foreach ($oTourItineraryData as $itinerary) {
                        $oTourItinerary = new TourItinerary;
                        $oTourItinerary->TourID = $model->id;
                        $oTourItinerary->DayNumber = $itinerary['DayNumber'];
                        $oTourItinerary->TourItineraryName = $itinerary['TourItineraryName'];
                        $oTourItinerary->TourItineraryDescription = $itinerary['TourItineraryDescription'];
                        $oTourItinerary->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourItinerary->save();
                    }
                }
            }

            $data['success'] = true;
            $data['message'] = 'Tour Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }
}
