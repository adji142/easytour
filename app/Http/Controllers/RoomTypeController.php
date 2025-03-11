<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;

use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    public function View(Request $request)
    {
        $roomType = RoomType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->get();

        $title = 'Delete Room Type !';
        $text = "Are you sure you want to delete ?";
        confirmDelete($title, $text);

        return view("Hotel.RoomType", [
            'roomType' => $roomType
        ]);
    }

    public function Form($id = null)
    {
        $sql = "roomtype.*";
        $roomtype = RoomType::selectRaw($sql)
            ->where('roomtype.RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->where('roomtype.id', '=', $id)->get();

        return view("Hotel.RoomType-Input", [
            'roomtype' => $roomtype,
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new RoomType;
            $model->RoomTypeName = $request->input('RoomTypeName');
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Room Type Saved Successfully';
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
            $model = RoomType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->findOrFail($id);
            $model->RoomTypeName = $request->input('RoomTypeName');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Room Type Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function deletedata(Request $request){
        try {
    		$roomtype = DB::table('roomtype')
	                ->where('id','=', $request->id)
	                ->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)
	                ->delete();

	        if ($roomtype) {
	        	alert()->success('Success','Delete Room Type Successfuly.');
	        }
	        else{
	        	alert()->error('Error','Delete Room Type Failed.');
	        }
	        return redirect('bedtypes');
    	} catch (Exception $e) {
    		Log::debug($e->getMessage());

            alert()->error('Error',$e->getMessage());
    	}
    }
}
