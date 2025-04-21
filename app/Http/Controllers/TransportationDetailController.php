<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;

use App\Models\TransportationDetail;
use App\Models\TransportationPackage;
use App\Models\TransportationImage;

class TransportationDetailController extends Controller
{
    public function View(Request $request)
    {
        $keyword = $request->input('keyword');
        $status = array('Y' => 'Available', 'N' => 'Unavailable');

        $sql = "transportationdetail.*, 
                CASE WHEN transportationdetail.Status = 'Y' THEN 'Available' ELSE 'Unavailable' END AS StatusDesc";

        $transportation = TransportationDetail::selectRaw($sql)
            ->where('RecordOwnerID', '=', Auth::user()->RecordOwnerID);

        if ($request->input('HotelStatus') != null) {
            $transportation->where('Status', $request->input('HotelStatus'));
        }

        return view("Transportation.Transportation", [
            'transportation' => $transportation->get(),
            'status' => $status,
            'oldStatus' => $request->input('Status')
        ]);
    }

    public function Form($id = null)
    {
        $transportationdetail = TransportationDetail::where('RecordOwnerID', Auth::user()->RecordOwnerID)
            ->where('id', $id)
            ->get();

        $transportationpackage = TransportationPackage::where('TransportationID', $id)
            ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
            ->get();

        $transportationimage = TransportationImage::where('TransportationID', $id)
            ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
            ->get();

        return view("Transportation.Transportation-Input", [
            'transportationdetail' => $transportationdetail,
            'transportationpackage' => $transportationpackage,
            'transportationimage' => $transportationimage
        ]);
    }

    public function store(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array());

        DB::beginTransaction();

        try {
            $oPackageData = json_decode($request->input('oPackageData'), true);
            $oImageData = json_decode($request->input('oImageData'), true);

            $model = new TransportationDetail;
            $model->TransportationName = $request->input('TransportationName');
            $model->TransportationType = $request->input('TransportationType');
            $model->TransportationDescription = $request->input('TransportationDescription');
            $model->TransportationTnC = $request->input('TransportationTnC');
            $model->TransportationCapacity = $request->input('TransportationCapacity');
            $model->Status = 'Y';
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $oSaved = $model->save();

            if ($oSaved) {
                if (!empty($oImageData)) {
                    foreach ($oImageData as $image) {
                        $oTourImage = new TransportationImage;
                        $oTourImage->TransportationID = $model->id;
                        $oTourImage->TransportationImage = $image['TransportationImage'];
                        $oTourImage->isBanner = 0;
                        $oTourImage->ImageCategory = json_encode($image['ImageCategory']);
                        $oTourImage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourImage->save();
                    }
                }
                if (!empty($oPackageData)) {
                    foreach ($oPackageData as $oItem) {
                        $oImage = new TransportationPackage;
                        $oImage->TransportationID = $model->id;
                        $oImage->PackageName = $oItem['PackageName'];
                        $oImage->PackagePrice = $oItem['PackagePrice'];
                        $oImage->PackagePriceDiscount = $oItem['PackagePriceDiscount'];
                        $oImage->TransportationCapacity = $oItem['TransportationCapacity'];
                        $oImage->TransportationRentDuration = $oItem['TransportationRentDuration'];
                        $oImage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oImage->save();
                    }
                }
            }

            $data['success'] = true;
            $data['message'] = 'Transportation Saved Successfully';
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }

        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array());

        try {
            $oImageData = json_decode($request->input('oImageData'), true);

            $id = $request->input('id');
            $model = TransportationDetail::where('RecordOwnerID', Auth::user()->RecordOwnerID)->findOrFail($id);
            $model->TransportationName = $request->input('TransportationName');
            $model->TransportationType = $request->input('TransportationType');
            $model->TransportationDescription = $request->input('TransportationDescription');
            $model->TransportationTnC = $request->input('TransportationTnC');
            $model->TransportationCapacity = $request->input('TransportationCapacity');
            $model->Status = 'Y';
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $oSaved = $model->save();

            if ($oSaved) {
                TransportationPackage::where('TransportationID', $model->id)
                    ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
                    ->delete();
                TransportationImage::where('TransportationID', $model->id)
                    ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
                    ->delete();

                if (!empty($oImageData)) {
                    foreach ($oImageData as $image) {
                        $oTourImage = new TransportationImage;
                        $oTourImage->TransportationID = $model->id;
                        $oTourImage->TransportationImage = $image['TransportationImage'];
                        $oTourImage->isBanner = 0;
                        $oTourImage->ImageCategory = json_encode($image['ImageCategory']);
                        $oTourImage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oTourImage->save();
                    }
                }
                
                if (!empty($oPackageData)) {
                    foreach ($oPackageData as $oItem) {
                        $oImage = new TransportationPackage;
                        $oImage->TransportationID = $model->id;
                        $oImage->PackageName = $oItem['PackageName'];
                        $oImage->PackagePrice = $oItem['PackagePrice'];
                        $oImage->PackagePriceDiscount = $oItem['PackagePriceDiscount'];
                        $oImage->TransportationCapacity = $oItem['TransportationCapacity'];
                        $oImage->TransportationRentDuration = $oItem['TransportationRentDuration'];
                        $oImage->RecordOwnerID = Auth::user()->RecordOwnerID;
                        $oImage->save();
                    }
                }
            }

            $data['success'] = true;
            $data['message'] = 'Transportation Updated Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $th->getMessage();
            $data['success'] = false;
        }

        return response()->json($data);
    }
}

