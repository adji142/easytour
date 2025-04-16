<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\dem_negara;
use App\Models\EasyTourSetting;

class LandingPageController extends Controller
{
    public function becomevendor()
    {
        $negara = dem_negara::all();
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();
        return Inertia::render('BecomeVendorView', [
            'negara' => $negara,
            'easyTourSetting' => $easyTourSetting,
        ]);
    }
}
