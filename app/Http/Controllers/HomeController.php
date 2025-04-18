<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use App\Models\TopServices;
use App\Models\EasyTourSetting;
use App\Models\Testimonial;
use App\Models\BestPartner;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $topServices = TopServices::all()->map(function ($service) {
            return [
                'HeadLine' => $service->HeadLine,
                'Description' => $service->Description,
                'Icon' => $service->Icon, // Asumsi icon disimpan sebagai base64
            ];
        });

        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();

        $testimonial = Testimonial::all()->map(function ($service) {
            return [
                'SenderName' => $service->SenderName,
                'SenderJobTitle' => $service->SenderJobTitle,
                'TestimonnialTitle' => $service->TestimonnialTitle,
                'Testimonnial' => $service->Testimonnial,
            ];
        });
        $bestPartner = BestPartner::all()->map(function ($service) {
            return [
                'PartnerCode' => $service->PartnerCode,
                'Icon' => $service->Icon,
            ];
        });

        // Kirimkan data ke tampilan dengan Inertia
        return Inertia::render('Home', [
            'topServices' => $topServices,
            'easyTourSetting' => $easyTourSetting,
            'testimonial' => $testimonial,
            'bestPartner' => $bestPartner,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
        ]);
    }
}
