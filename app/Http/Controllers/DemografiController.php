<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\dem_negara;
use App\Models\dem_provinsi;
use App\Models\dem_kota;

class DemografiController extends Controller
{
    public function index()
    {
        return Inertia::render('Demografi/Index', [
            'provinsi' => dem_provinsi::all(),
            'negara' => dem_negara::all(),
            'kota' => dem_kota::all(),
        ]);
    }

    public function ReadNegara()
    {
        return dem_negara::all();
    }

    public function getProvinsi($negara_id)
    {
        return response()->json(dem_provinsi::where('locationid', $negara_id)->get());
    }

    public function getKota($provinsi_id)
    {
        return response()->json(dem_kota::where('prov_id', $provinsi_id)->get());
    }
}
