<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
class VendorDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('vendordashboard');
    }
    public function dashboard(Request $request) {
        return view("dashboard");
    }
}
