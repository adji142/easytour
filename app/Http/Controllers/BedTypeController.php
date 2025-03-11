<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Illuminate\Http\Request;

use App\Models\BedType;

class BedTypeController extends Controller
{
    public function View(Request $request)
    {
        $bedTypes = BedType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->get();

        $title = 'Delete Bed Type !';
        $text = "Are you sure you want to delete ?";
        confirmDelete($title, $text);

        return view("Hotel.BedType", [
            'bedTypes' => $bedTypes
        ]);
    }

    public function Form($id = null)
    {
        $sql = "bedtype.*";
        $bedtype = BedType::selectRaw($sql)
            ->where('bedtype.RecordOwnerID', '=', Auth::user()->RecordOwnerID)
            ->where('bedtype.id', '=', $id)->get();

        return view("Hotel.BedType-Input", [
            'bedtype' => $bedtype,
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new BedType;
            $model->BedTypeName = $request->input('BedTypeName');
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Bed Type Saved Successfully';
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
            $model = BedType::where('RecordOwnerID', Auth::user()->RecordOwnerID)->findOrFail($id);
            $model->BedTypeName = $request->input('BedTypeName');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Bed Type Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function deletedata(Request $request){
        try {
    		$bedtype = DB::table('bedtype')
	                ->where('id','=', $request->id)
	                ->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)
	                ->delete();

	        if ($bedtype) {
	        	alert()->success('Success','Delete Bed Type Successfuly.');
	        }
	        else{
	        	alert()->error('Error','Delete Bed Type Failed.');
	        }
	        return redirect('bedtypes');
    	} catch (Exception $e) {
    		Log::debug($e->getMessage());

            alert()->error('Error',$e->getMessage());
    	}
    }
}
