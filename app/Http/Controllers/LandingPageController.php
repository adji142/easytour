<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\dem_negara;

class LandingPageController extends Controller
{
    public function becomevendor()
    {
        $negara = dem_negara::all();
        return Inertia::render('BecomeVendorView', ['negara' => $negara]);
    }
}
