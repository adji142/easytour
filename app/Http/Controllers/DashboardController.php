<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\EasyTourSetting;
use App\Models\BookingSubmition;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();

        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();
        
        $endDate = $request->input('endDate') ?? Carbon::today()->toDateString();
        $startDate = $request->input('startDate') ?? Carbon::today()->subDays(90)->toDateString();

        $queryRaw = "*, 
            CASE WHEN bookingsubmition.BookingStatus = 0 THEN 'PENDING' ELSE 
                    CASE WHEN bookingsubmition.BookingStatus = 1 THEN 'PAYMENT' ELSE 
                        CASE WHEN bookingsubmition.BookingStatus = 2 THEN 'PAYMENT CONFIRMED' ELSE 
                            CASE WHEN bookingsubmition.BookingStatus = 3 THEN 'BOOKING REJECTED' ELSE '' END
                        END
                    END
                END BookingStatusName,
                CASE WHEN bookingsubmition.BookingStatus = 0 THEN 'text-warning' ELSE 
                    CASE WHEN bookingsubmition.BookingStatus = 1 THEN 'text-info' ELSE 
                        CASE WHEN bookingsubmition.BookingStatus = 2 THEN 'text-success' ELSE 
                            CASE WHEN bookingsubmition.BookingStatus = 3 THEN 'text-danger' ELSE '' END
                        END
                    END
                END BookingStatusColor,
                bookingsubmition.RejectFactor, 
                bookingsubmition.ApprovedAt,
                bookingsubmition.ApprovedBy
        ";

        $bookingList = BookingSubmition::selectRaw($queryRaw)
                    ->where('UserID', $user->id)
                    ->whereDate('BookingDate', '>=', $startDate)
                    ->whereDate('BookingDate', '<=', $endDate)
                    ->orderBy('BookingDate', 'desc')
                    ->paginate(10)
                    ->withQueryString();

        if($user->RecordOwnerID == '-'){
            return Inertia::render('userDashboard',[
                'easyTourSetting' => $easyTourSetting,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'bookingList' => $bookingList,
                'isLoggedIn' => Auth::check(),
                'user' => Auth::user(),
                'BannerName' => 'User Dashboard'
            ]);
        }
        else{
            return redirect('dashboard');
        }
    }
    public function Profile(){
        $easyTourSetting = EasyTourSetting::orderBy('created_at', 'desc')->first();
        return Inertia::render('Profile',[
            'easyTourSetting' => $easyTourSetting,
            'isLoggedIn' => Auth::check(),
            'user' => Auth::user(),
        ]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|string', // base64
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;

        if ($request->photo) {
            $base64 = $request->photo;
            $user->image = $base64;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
