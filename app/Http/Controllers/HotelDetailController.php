<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\HotelDetail;
use App\Models\dem_negara;
use App\Models\dem_provinsi;
use App\Models\dem_kota;

class HotelDetailController extends Controller
{
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
