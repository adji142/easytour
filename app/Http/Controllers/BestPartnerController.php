<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\BestPartner;

class BestPartnerController extends Controller
{
    public function View(Request $request)
    {
        $bestPartners = BestPartner::all();

        $title = 'Delete Best Partner!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view("EasyTourAdmin.BestPartner", [
            'bestPartners' => $bestPartners
        ]);
    }

    public function Form($id = null)
    {

        $bestpartner = BestPartner::selectRaw("*")
            ->where('bestpartner.id', '=', $id)->get();

        return view("EasyTourAdmin.BestPartner-Input", [
            'bestpartner' => $bestpartner,
        ]);
    }

    public function store(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array());
        
        if($request->input('Icon_Base64') != null || $request->input('Icon_Base64') != "") {
            if($this->ValidateImage($request->input('Icon_Base64'), 117, 90) != "OK"){
                $data['message'] = $this->ValidateImage($request->input('Base64_AboutImage'), 117, 90);
                $data['success'] = false;
                return response()->json($data);
            }
        }

        try {
            $model = new BestPartner;
            $model->PartnerCode = $request->input('PartnerCode');
            $model->Icon = $request->input('Icon_Base64');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Best Partner Saved Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array());

        if($request->input('Icon_Base64') != null || $request->input('Icon_Base64') != "") {
            if($this->ValidateImage($request->input('Icon_Base64'), 117, 90) != "OK"){
                $data['message'] = $this->ValidateImage($request->input('Icon_Base64'), 117, 90);
                $data['success'] = false;
                return response()->json($data);
            }
        }

        try {
            $id = $request->input('id');
            $model = BestPartner::findOrFail($id);
            $model->PartnerCode = $request->input('PartnerCode');
            $model->Icon = $request->input('Icon_Base64');
            $model->save();

            $data['success'] = true;
            $data['message'] = 'Best Partner Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function deletedata(Request $request)
    {
        try {
            $deleted = BestPartner::destroy($request->id);

            if ($deleted) {
                alert()->success('Success', 'Delete Best Partner Successfully.');
            } else {
                alert()->error('Error', 'Delete Best Partner Failed.');
            }

            return redirect('bestpartner');
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            alert()->error('Error', $e->getMessage());
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
