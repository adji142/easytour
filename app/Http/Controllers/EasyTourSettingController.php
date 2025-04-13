<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Illuminate\Http\Request;

use App\Models\EasyTourSetting;

class EasyTourSettingController extends Controller
{
    public function View(Request $request)
    {
        $easytourSetting = EasyTourSetting::all();

        $title = 'Delete Top Services !';
        $text = "Are you sure you want to delete ?";
        confirmDelete($title, $text);

        return view("EasyTourAdmin.EasyTourSetting", [
            'easytourSetting' => $easytourSetting
        ]);
    }

    public function Form(Request $request)
    {
        $sql = "easytoursetting.*";
        $easytoursetting = EasyTourSetting::selectRaw($sql)
            ->where('easytoursetting.id', '=', 1)->get();

        return view("EasyTourAdmin.EasyTourSetting-Input", [
            'easytoursetting' => $easytoursetting,
        ]);
    }

    public function store(Request $request){
        $data = array('success' => false, 'message' => '', 'data' => array());
        try {
            $model = new EasyTourSetting;
            $model->LegalName = $request->input('LegalName');
            $model->AppsName = $request->input('AppsName');
            $model->AppsLogo = $request->input('AppsLogo');
            $model->AppsEmail = $request->input('AppsEmail');
            $model->AppsPhone = $request->input('AppsPhone');
            $model->AppsAddress = $request->input('AppsAddress');
            $model->About = $request->input('About');
            $model->AboutHeadline = $request->input('AboutHeadline');
            $model->AboutIcon1 = $request->input('Base64_AboutIcon1');
            $model->AboutSubHeadline1 = $request->input('AboutSubHeadline1');
            $model->AboutDescriptionSubHeadline1 = $request->input('AboutDescriptionSubHeadline1');
            $model->AboutIcon2 = $request->input('Base64_AboutIcon2');
            $model->AboutSubHeadline2 = $request->input('AboutSubHeadline2');
            $model->AboutDescriptionSubHeadline2 = $request->input('AboutDescriptionSubHeadline2');
            $model->AboutIcon3 = $request->input('Base64_AboutIcon3');
            $model->AboutSubHeadline3 = $request->input('AboutSubHeadline3');
            $model->AboutDescriptionSubHeadline3 = $request->input('AboutDescriptionSubHeadline3');
            $model->AboutImage = $request->input('Base64_AboutImage');

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

            if($request->input('Base64_AboutImage') != null || $request->input('Base64_AboutImage') != "") {
                if($this->ValidateImage($request->input('Base64_AboutImage'), 830, 620) != "OK"){
                    $data['message'] = $this->ValidateImage($request->input('Base64_AboutImage'), 830, 620);
                    $data['success'] = false;
                    return response()->json($data);
                }
            }

            if($request->input('image_icon1_base64') != null || $request->input('image_icon1_base64') != "") {
                if($this->ValidateImage($request->input('image_icon1_base64'), 53, 49) != "OK"){
                    $data['message'] = $this->ValidateImage($request->input('image_icon1_base64'), 53, 49);
                    $data['success'] = false;
                    return response()->json($data);
                }
            }
            if($request->input('image_icon2_base64') != null || $request->input('image_icon2_base64') != "") {
                if($this->ValidateImage($request->input('image_icon2_base64'), 53, 49) != "OK"){
                    $data['message'] = $this->ValidateImage($request->input('image_icon2_base64'), 53, 49);
                    $data['success'] = false;
                    return response()->json($data);
                }
            }
            if($request->input('image_icon3_base64') != null || $request->input('image_icon3_base64') != "") {
                if($this->ValidateImage($request->input('image_icon3_base64'), 53, 49) != "OK"){
                    $data['message'] = $this->ValidateImage($request->input('image_icon3_base64'), 53, 49);
                    $data['success'] = false;
                    return response()->json($data);
                }
            }


            $id = $request->input('id');
            $model = EasyTourSetting::findOrFail($id);
            $model->LegalName = $request->input('LegalName');
            $model->AppsName = $request->input('AppsName');
            $model->AppsLogo = $request->input('AppsLogo');
            $model->AppsEmail = $request->input('AppsEmail');
            $model->AppsPhone = $request->input('AppsPhone');
            $model->AppsAddress = $request->input('AppsAddress');
            $model->About = $request->input('About');
            $model->AboutHeadline = $request->input('AboutHeadline');
            $model->AboutIcon1 = $request->input('image_icon1_base64');
            $model->AboutSubHeadline1 = $request->input('AboutSubHeadline1');
            $model->AboutDescriptionSubHeadline1 = $request->input('AboutDescriptionSubHeadline1');
            $model->AboutIcon2 = $request->input('image_icon2_base64');
            $model->AboutSubHeadline2 = $request->input('AboutSubHeadline2');
            $model->AboutDescriptionSubHeadline2 = $request->input('AboutDescriptionSubHeadline2');
            $model->AboutIcon3 = $request->input('image_icon3_base64');
            $model->AboutSubHeadline3 = $request->input('AboutSubHeadline3');
            $model->AboutDescriptionSubHeadline3 = $request->input('AboutDescriptionSubHeadline3');
            $model->AboutImage = $request->input('Base64_AboutImage');
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
    		$easytoursetting = DB::table('easytoursetting')
	                ->where('id','=', $request->id)
	                ->delete();

	        if ($easytoursetting) {
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

    function ValidateImage($base64, $width, $height)
    {
        // Cek apakah base64 valid
        if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
            $base64 = substr($base64, strpos($base64, ',') + 1);
            $base64 = base64_decode($base64);

            if ($base64 === false) {
                return "Failed to decode base64";
            }
        } else {
            return "Base64 Format is Not Valid";
        }

        // Buat image dari string
        $image = imagecreatefromstring($base64);
        if (!$image) {
            return "Failed to create image from string";
        }

        // Dapatkan ukuran gambar
        $xwidth = imagesx($image);
        $xheight = imagesy($image);

        $toleransi = 20;
        $minWidth = $width - $toleransi;
        $maxWidth = $width + $toleransi;
        $minHeight = $height - $toleransi;
        $maxHeight = $height + $toleransi;

        // Cek ukuran
        if ($xwidth < $minWidth || $xwidth > $maxWidth || $xheight < $minHeight || $xheight > $maxHeight) {
            return "Image Resolution Must be " . $width . " x ".$height;
        }

        return "OK";
        
    }
}
