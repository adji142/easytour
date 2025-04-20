<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\HotelDetail;
use App\Models\HotelImage;
use App\Models\HotelRoom;
use App\Models\dem_negara;
use App\Models\dem_provinsi;
use App\Models\dem_kota;
use App\Models\EasyTourSetting;
use Inertia\Inertia;

class HotelDetailController extends Controller
{
    public function index(){
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();

        $subImage = DB::table('hotelimage')
            ->select('HotelID', DB::raw('MIN(RoomImage) as RoomImage'))
            ->groupBy('HotelID');

        $subPackage = DB::table('hotelroom')
            ->select('HotelID', DB::raw('MIN(RoomPrice - RoomDiscount) as FinalPrice'))
            ->groupBy('HotelID');

        $hotels = DB::table('hoteldetail as td')
            ->leftJoinSub($subImage, 'ti', 'td.id', '=', 'ti.HotelID')
            ->leftJoinSub($subPackage, 'tp', 'td.id', '=', 'tp.HotelID')
            ->leftJoin('dem_kota', function ($value){
                $value->on('dem_kota.city_id','=','td.HotelCity');
            })
            ->select('td.id','td.HotelName', 'ti.RoomImage', 'tp.FinalPrice', 'dem_kota.city_name', DB::raw('CAST(td.HotelRating AS decimal) HotelRating'))
            ->get();

        return Inertia::render('Hotels',[
            'easyTourSetting' => $easyTourSetting,
            'hotels' => $hotels,
            'hotelcount' => count($hotels),
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
            'BannerName' => "Hotel"
        ]);
    }
    public function detail($id){
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();

        $hotelDetail = HotelDetail::selectRaw('hoteldetail.*, dem_kota.city_name')
                        ->leftJoin('dem_kota', function ($value){
                            $value->on('dem_kota.city_id','=','hoteldetail.HotelCity');
                        })
                        ->where('hoteldetail.id', $id)
                        ->first();
        $hotelImage = HotelImage::where('HotelID', $id)->get();
        $hotelRoom = HotelRoom::selectRaw("hotelroom.*, roomtype.RoomTypeName, bedtype.BedTypeName")
                        ->leftJoin('roomtype', function ($value){
                            $value->on('roomtype.id','=','hotelroom.RoomType')
                            ->on('roomtype.RecordOwnerID','=', 'hotelroom.RecordOwnerID');
                        })
                        ->leftJoin('bedtype', function ($value){
                            $value->on('bedtype.id','=','hotelroom.RoomBedType')
                            ->on('bedtype.RecordOwnerID','=', 'hotelroom.RecordOwnerID');
                        })
                        ->where('HotelID', $id)->get();
        return Inertia::render('HotelDetailPage', [
            'easyTourSetting' => $easyTourSetting,
            'hotelDetail' => $hotelDetail,
            'hotelImage' => $hotelImage,
            'hotelRoom' => $hotelRoom,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
            'BannerName' => "Hotel Detail"
        ]);
    }
    public function View(Request $request)
    {
        $keyword = $request->input('keyword');
        $hotelstatus = array('Y' => 'Active', 'N' => 'Inactive');
        $sql = "*, CASE WHEN HotelStatus = 'Y' THEN 'Active' ELSE 'Inactive' END AS HotelStatusDesc";

        $hotel = HotelDetail::selectRaw($sql)
        		->where('hoteldetail.RecordOwnerID','=',Auth::user()->RecordOwnerID);

        if($request->input('HotelStatus') != null){
            $hotel->where('hoteldetail.HotelStatus', $request->input('HotelStatus'));
        }
        
        return view("Hotel.Hotel",[
            'hotel' => $hotel->get(), 
            'hotelstatus' => $hotelstatus,
            'oldStatus' => $request->input('HotelStatus')
        ]);
    }

    public function Form($id = null)
    {
    	$sql = "hoteldetail.*";
    	$hoteldetail = HotelDetail::selectRaw($sql)
	        ->where('hoteldetail.RecordOwnerID','=',Auth::user()->RecordOwnerID)
	        ->where('hoteldetail.id','=', $id)->get();
        
        $negara = dem_negara::all();
        $provinsi = dem_provinsi::all();
        $kota = dem_kota::all();

        $hotelstatus = array('Y' => 'Active', 'N' => 'Inactive');
        $hotelrating = array('1' => '1 Star', '2' => '2 Star', '3' => '3 Star', '4' => '4 Star', '5' => '5 Star');

        return view("Hotel.Hotel-Input",[
            'hotel' => $hoteldetail,
            'negara' => $negara,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'hotelstatus' => $hotelstatus,
            'hotelrating' => $hotelrating
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new HotelDetail;
            $model->HotelName = $request->input('HotelName');
            $model->HotelAddress = $request->input('HotelAddress');
            $model->HotelLocation = $request->input('HotelLocation');
            $model->HotelState = $request->input('HotelState');
            $model->HotelProvince = $request->input('HotelProvince');
            $model->HotelCity = $request->input('HotelCity');
            $model->HotelLogo = $request->input('HotelLogo');
            $model->HotelBanner = $request->input('HotelBanner');
            $model->HotelPhone = $request->input('HotelPhone');
            $model->HotelEmail = $request->input('HotelEmail');
            $model->HotelWebsite = $request->input('HotelWebsite');
            $model->HotelDescription = $request->input('HotelDescription');
            $model->HotelIncludeExclude = $request->input('HotelIncludeExclude');
            $model->HotelRating = $request->input('HotelRating');
            $model->HotelStatus = $request->input('HotelStatus');
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Hotel Saved Successfuly';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function edit(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $id = $request->input('id');
            $model = HotelDetail::where('RecordOwnerID', Auth::user()->RecordOwnerID)->findOrFail($id);
            $model->HotelName = $request->input('HotelName');
            $model->HotelAddress = $request->input('HotelAddress');
            $model->HotelLocation = $request->input('HotelLocation');
            $model->HotelState = $request->input('HotelState');
            $model->HotelProvince = $request->input('HotelProvince');
            $model->HotelCity = $request->input('HotelCity');
            $model->HotelLogo = $request->input('HotelLogo');
            $model->HotelBanner = $request->input('HotelBanner');
            $model->HotelPhone = $request->input('HotelPhone');
            $model->HotelEmail = $request->input('HotelEmail');
            $model->HotelWebsite = $request->input('HotelWebsite');
            $model->HotelDescription = $request->input('HotelDescription');
            $model->HotelIncludeExclude = $request->input('HotelIncludeExclude');
            $model->HotelRating = $request->input('HotelRating');
            $model->HotelStatus = $request->input('HotelStatus');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Hotel Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

}
