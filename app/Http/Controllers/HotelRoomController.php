<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;

use Illuminate\Http\Request;

use App\Models\HotelDetail;
use App\Models\HotelRoom;
use App\Models\RoomType;
use App\Models\BedType;

class HotelRoomController extends Controller
{
    public function View(Request $request)
    {
        $keyword = $request->input('keyword');
        $roomstatus = array('Y' => 'Available', 'N' => 'Unavailable');
        $sql = "hotelroom.*, hoteldetail.HotelName, CASE WHEN hotelroom.RoomStatus = 'Y' THEN 'Available' ELSE 'Unavailable' END AS RoomStatusDesc, 
                roomtype.RoomTypeName, bedtype.BedTypeName
        ";

        $rooms = HotelRoom::selectRaw($sql)
            ->join('hoteldetail', function($join) {
                $join->on('hotelroom.HotelID', '=', 'hoteldetail.ID')
                     ->on('hotelroom.RecordOwnerID', '=', 'hoteldetail.RecordOwnerID');
            })
            ->leftJoin('roomtype', function($join) {
                $join->on('hotelroom.RoomType', '=', 'roomtype.ID')
                     ->on('hotelroom.RecordOwnerID', '=', 'roomtype.RecordOwnerID');
            })
            ->leftJoin('bedtype', function($join) {
                $join->on('hotelroom.RoomBedType', '=', 'bedtype.ID')
                     ->on('hotelroom.RecordOwnerID', '=', 'bedtype.RecordOwnerID');
            })
            ->where('hotelroom.RecordOwnerID', '=', Auth::user()->RecordOwnerID);

        if ($request->input('RoomStatus') != null) {
            $rooms->where('hotelroom.RoomStatus', $request->input('RoomStatus'));
        }

        if ($request->input('HotelID') != null) {
            $rooms->where('hotelroom.HotelID', $request->input('HotelID'));
        }
        $hotel = HotelDetail::select('id', 'HotelName')
            ->where('RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->get();

        return view("Hotel.Rooms", [
            'rooms' => $rooms->get(),
            'roomstatus' => $roomstatus,
            'hotel' => $hotel,
            'oldStatus' => $request->input('RoomStatus'),
            'oldHotelID' => $request->input('HotelID')
        ]);
    }

    public function Form($id = null)
    {
    	$sql = "hotelroom.*";
    	$hotelroom = HotelRoom::selectRaw($sql)
	        ->where('hotelroom.RecordOwnerID','=',Auth::user()->RecordOwnerID)
	        ->where('hotelroom.id','=', $id)->get();
        
        $hotel = HotelDetail::select('id', 'HotelName')
            ->where('RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->get();
        $roomtype = DB::table('roomtype')
            ->where('RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->get();
        $bedtype = DB::table('bedtype')
            ->where('RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->get();
        return view("Hotel.HotelRoom-Input",[
            'hotelroom' => $hotelroom,
            'hotel' => $hotel,
            'roomtype' => $roomtype,
            'bedtype' => $bedtype
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new HotelRoom;
            $model->HotelID = $request->input('HotelID');
            $model->RoomName = $request->input('RoomName');
            $model->RoomType = $request->input('RoomType');
            $model->RoomCapacity = $request->input('RoomCapacity');
            $model->RoomSize = $request->input('RoomSize');
            $model->RoomBedType = $request->input('RoomBedType');
            $model->RoomPrice = $request->input('RoomPrice');
            $model->RoomStatus = $request->input('RoomStatus');
            $model->RoomDescription = $request->input('RoomDescription');
            $model->RoomRating = $request->input('RoomRating');
            $model->RoomDiscount = $request->input('RoomDiscount');
            $model->RoomDiscountStart = $request->input('RoomDiscountStart');
            $model->RoomDiscountEnd = $request->input('RoomDiscountEnd');
            $model->RoomDiscountStatus = $request->input('RoomDiscountStatus');
            $model->RoomFacilityAC = $request->input('RoomFacilityAC');
            $model->RoomFacilityTV = $request->input('RoomFacilityTV');
            $model->RoomFacilityShower = $request->input('RoomFacilityShower');
            $model->RoomFacilityWaterHeater = $request->input('RoomFacilityWaterHeater');
            $model->RoomFacilityFreeWifi = $request->input('RoomFacilityFreeWifi');
            $model->RoomFacilityBreakfast = $request->input('RoomFacilityBreakfast');
            $model->RoomFacilityNoSmoking = $request->input('RoomFacilityNoSmoking');
            $model->RoomFacilityParking = $request->input('RoomFacilityParking');
            $model->RoomFacilitySwimmingPool = $request->input('RoomFacilitySwimmingPool');
            $model->RoomFacilityFitness = $request->input('RoomFacilityFitness');
            $model->RoomInclude = $request->input('RoomInclude');
            $model->RoomExclude = $request->input('RoomExclude');
            $model->RoomWhyChooseUS = $request->input('RoomWhyChooseUS');
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Hotel Room Saved Successfuly';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }


}
