<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Illuminate\Http\Request;

use App\Models\TopServices;

class TopServicesController extends Controller
{
    public function View(Request $request)
    {
        $topServices = TopServices::all();

        $title = 'Delete Top Services !';
        $text = "Are you sure you want to delete ?";
        confirmDelete($title, $text);

        return view("EasyTourAdmin.TopServices", [
            'topServices' => $topServices
        ]);
    }

    public function Form($id = null)
    {
        $sql = "topservices.*";
        $topservices = TopServices::selectRaw($sql)
            ->where('topservices.id', '=', $id)->get();

        return view("EasyTourAdmin.TopServices-Input", [
            'topservices' => $topservices,
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new TopServices;
            $model->HeadLine = $request->input('HeadLine');
            $model->Description = $request->input('Description');
            $model->Icon = $request->input('Icon_Base64');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Top Services Saved Successfully';
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
            $model = TopServices::findOrFail($id);
            $model->HeadLine = $request->input('HeadLine');
            $model->Description = $request->input('Description');
            $model->Icon = $request->input('Icon_Base64');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Top Services Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function deletedata(Request $request){
        try {
    		$topservices = DB::table('topservices')
	                ->where('id','=', $request->id)
	                ->delete();

	        if ($topservices) {
	        	alert()->success('Success','Delete Top Services Successfuly.');
	        }
	        else{
	        	alert()->error('Error','Delete Top Services Failed.');
	        }
	        return redirect('bedtypes');
    	} catch (Exception $e) {
    		Log::debug($e->getMessage());

            alert()->error('Error',$e->getMessage());
    	}
    }
}
