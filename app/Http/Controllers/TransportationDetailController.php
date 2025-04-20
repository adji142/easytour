<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;

use App\Models\TransportationDetail;
use App\Models\TransportationPackage;

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

        if ($request->input('Status') != null) {
            $transportation->where('Status', $request->input('Status'));
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

        return view("Transportation.Transportation-Input", [
            'transportationdetail' => $transportationdetail,
            'transportationpackage' => $transportationpackage
        ]);
    }

    public function store(Request $request)
    {
        $data = array('success' => false, 'message' => '', 'data' => array());

        DB::beginTransaction();

        try {
            $oImageData = json_decode($request->input('oImageData'), true);

            $model = new TransportationDetail;
            $model->Name = $request->input('Name');
            $model->Type = $request->input('Type');
            $model->Capacity = $request->input('Capacity');
            $model->Price = $request->input('Price');
            $model->Description = $request->input('Description');
            $model->Status = 'Y';
            $model->RecordOwnerID = Auth::user()->RecordOwnerID;
            $oSaved = $model->save();

            if ($oSaved) {
                if (!empty($oImageData)) {
                    foreach ($oImageData as $image) {
                        $oImage = new TransportationPackage;
                        $oImage->TransportationID = $model->id;
                        $oImage->ImageData = $image['image'];
                        $oImage->ImageCategory = json_encode($image['category']);
                        $oImage->isBanner = 0;
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
            $model->Name = $request->input('Name');
            $model->Type = $request->input('Type');
            $model->Capacity = $request->input('Capacity');
            $model->Price = $request->input('Price');
            $model->Description = $request->input('Description');
            $model->Status = 'Y';
            $oSaved = $model->save();

            if ($oSaved) {
                TransportationPackage::where('TransportationID', $model->id)
                    ->where('RecordOwnerID', Auth::user()->RecordOwnerID)
                    ->delete();

                if (!empty($oImageData)) {
                    foreach ($oImageData as $image) {
                        $oImage = new TransportationPackage;
                        $oImage->TransportationID = $model->id;
                        $oImage->ImageData = $image['image'];
                        $oImage->ImageCategory = json_encode($image['category']);
                        $oImage->isBanner = 0;
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

