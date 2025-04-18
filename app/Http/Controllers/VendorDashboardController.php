<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;

use Inertia\Inertia;
use App\Models\BookingSubmition;
class VendorDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('vendordashboard');
    }
    public function dashboard(Request $request) {
        $TglAwal = Carbon::now()->startOfMonth()->toDateString();
        $TglAkhir = Carbon::now()->endOfMonth()->toDateString();

        $sql = "PartnerCode, 
                SUM(CASE WHEN BookingType = 'Tour' THEN TotalNetTransaction ELSE 0 END ) AS TOUR,
                SUM(CASE WHEN BookingType = 'Hotel' THEN TotalNetTransaction ELSE 0 END ) AS HOTEL,
                SUM(CASE WHEN BookingType = 'Travel' THEN TotalNetTransaction ELSE 0 END ) AS Travel ";

        $rawData = BookingSubmition::selectRaw($sql)
                    ->whereBetween('BookingDate', [$TglAwal, $TglAkhir])
                    ->where('PartnerCode', Auth::user()->RecordOwnerID)
                    ->groupBy('PartnerCode')
                    ->first();

        // Format angka ke satuan pendek

        $Tour = $rawData->TOUR ?? 0;
        $Hotel = $rawData->HOTEL ?? 0;
        $Travel = $rawData->Travel ?? 0;

        // dd($Tour);

        return view("dashboard", [
            'omset_tour' => $this->formatNumberShort($Tour),
            'omset_hotel' => $this->formatNumberShort($Hotel),
            'omset_travel' => $this->formatNumberShort($Travel),
            'chart_data' => [
                'Tour' => $Tour,
                'Hotel' => $Hotel,
                'Travel' => $Travel,
            ]
        ]);
    }
    public function dashboardadmin(Request $request) {
        return view("dashboardadmin");
    }

    private function formatNumberShort($number) {
        if ($number >= 1000000000000) {
            return round($number / 1000000000000, 1) . ' T';
        } elseif ($number >= 1000000000) {
            return round($number / 1000000000, 1) . ' M';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 1) . ' Jt';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . ' K';
        }
    
        return number_format($number, 0, ',', '.'); // default pakai ribuan
    }
}
