<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;

use Illuminate\Http\Request;
use App\Models\TourType;

class TourTypeController extends Controller
{
    public function View(Request $request)
    {
        $tourType = TourType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->get();

        $title = 'Delete Tour Type !';
        $text = "Are you sure you want to delete ?";
        confirmDelete($title, $text);

        return view("Tour.TourType", [
            'tourType' => $tourType
        ]);
    }

    public function Form($id = null)
    {
        $sql = "tourtype.*";
        $tourtype = TourType::selectRaw($sql)
            ->where('tourtype.RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->where('tourtype.id', '=', $id)->get();

        return view("Tour.TourType-Input", [
            'tourtype' => $tourtype,
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new TourType;
            $model->TourTypeName = $request->input('TourTypeName');
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Tour Type Saved Successfully';
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
            $model = TourType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->findOrFail($id);
            $model->TourTypeName = $request->input('TourTypeName');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Tour Type Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function deletedata(Request $request){
        try {
    		$tourtype = DB::table('tourtype')
	                ->where('id','=', $request->id)
	                ->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)
	                ->delete();

	        if ($tourtype) {
	        	alert()->success('Success','Delete Tour Type Successfuly.');
	        }
	        else{
	        	alert()->error('Error','Delete Tour Type Failed.');
	        }
	        return redirect('tourtypes');
    	} catch (Exception $e) {
    		Log::debug($e->getMessage());

            alert()->error('Error',$e->getMessage());
    	}
    }
}
