<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Mail\VerificationEmail;
use Log;

use Inertia\Inertia;
use App\Models\dem_negara;
use App\Models\Company;
use App\Models\User;
use App\Models\roles;
use App\Models\UserRole;
use App\Models\PermissionRole;
use App\Models\Permission;

use Laravel\Socialite\Facades\Socialite;

use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }

    public function verifyOTP(Request $request)
    {

        return Inertia::render('Auth/OTPVerify', [
            'Phone' => $request->Phone,
        ]);
    }

    public function VendorRegistrationAction(Request $request)  {
        $data = array('success' => false, 'message'=>'', 'data'=>array());
        DB::beginTransaction();

        // return response()->json($data);

        // Validasi Email
        $email = Company::where('Email', $request->Email)->first();
        if ($email) {
            $data['success'] = false;
            $data['message'] = 'Email Has Been Registered';
            return response()->json($data);
        }

        // Validasi Phone
        $phone = Company::where('Phone', $request->Phone)->first();
        if ($phone) {
            $data['success'] = false;
            $data['message'] = 'Phone Number Has Been Registered';
            return response()->json($data);
        }
        try {
            $KodeVendor = "";
            $prefix = "SP";
            $lastNoTrx = Company::where(DB::raw('LEFT(PartnerCode,2)'),'=',$prefix)->count()+1;
            $KodeVendor = $prefix.str_pad($lastNoTrx, 6, '0', STR_PAD_LEFT);

            $model = new Company();
            $model->PartnerCode = $KodeVendor;
            $model->PartnerName = $request->FirstName. ' '. $request->LastName;
            $model->FirstName = $request->FirstName;
            $model->LastName = $request->LastName;
            $model->ShippingAddress = $request->BillingAddress;
            $model->ShippingState = $request->BillingState;
            $model->ShipingProvince = $request->BillingProvince;
            $model->ShippingCity = $request->BillingCity;
            $model->ShippingZip = '';
            $model->ShippingCountry = $request->BillingState;
            $model->BillingAddress = $request->BillingAddress;
            $model->BillingState = $request->BillingState;
            $model->BillingProvince = $request->BillingProvince;
            $model->BillingCity = $request->BillingCity;
            $model->BillingZip = '';
            $model->BillingCountry = $request->BillingState;
            $model->Phone = $request->Phone;
            $model->Email = $request->Email;
            $model->Website = '';
            $model->Logo = '';
            $model->Status = '1';
            $model->Notes = '';
            
            $save = $model->save();

            // Buat User
            $user = new User();
            $user->name = $request->FirstName . ' ' . $request->LastName;
            $user->email = $request->Email;
            $user->password = Hash::make($request->Password); // Bisa diganti dengan password acak atau yang dikirim ke email
            $user->RecordOwnerID = $KodeVendor; // Hubungkan user dengan company
            $user->VerificationToken = Str::random(64);
            $user->is_verified = false;
            $user->save();

            // Kirim Email Verifikasi
            Mail::to($user->email)->send(new VerificationEmail($user));

            DB::commit();

            $data['success'] = true;
            $data['message'] = 'Registration Complate, Please Check Tour email to Confirm Your Identity';
            $data['data'] = $request->Phone;
            // if($save){
            //     $data['success'] = true;
            //     $data['message'] = 'Data berhasil disimpan';
            //     $data['data'] = $request->Phone;
            // }else{
            //     $data['success'] = false;
            //     $data['message'] = 'Data gagal disimpan';
            // }
        } catch (\Throwable $th) {
            DB::rollback();
            $data['success'] = false;
            $data['message'] = 'Data gagal disimpan '.$th->getMessage();
        }
        return response()->json($data);
    }

    public function verifyEmail($token)
    {
        $user = User::where('VerificationToken', $token)->firstOrFail();

        if (!$user->is_verified) {
            $user->is_verified = true;
            $user->VerificationOn = Carbon::now();
            $user->VerificationToken = null;
            $user->save();

            // Update status perusahaan
            $company = Company::where('Email', $user->email)->first();
            if ($company) {
                // $company->EmailVerified = 1;
                // $company->EmailVerifiedAt = Carbon::now();
                // $company->save();

                $update = DB::table('company')
                			->where('PartnerCode','=', $company->PartnerCode)
                			->update(
                				[
                					'EmailVerified'=>1,
                					'EmailVerifiedAt'=>Carbon::now(),
                				]
                			);
            }

            // Add Role
            $roles = roles::create([
                'RoleName' => 'Super Admin',
                'RecordOwnerID' => $user->RecordOwnerID,
            ]);

            $lastRolesID = $roles->id;

            // Add User Role
            $userRole = UserRole::create([
                'userid' => $user->id,
                'roleid' => $lastRolesID,
                'RecordOwnerID' => $user->RecordOwnerID,
            ]);

            // Add Permission Role
            $permission = Permission::all();
            foreach ($permission as $key => $value) {
                $permissionRole = PermissionRole::create([
                    'permissionid' => $value->id,
                    'roleid' => $lastRolesID,
                    'RecordOwnerID' => $user->RecordOwnerID,
                ]);
            }
        }

        return redirect('/')->with('success', 'Email successfully verified.');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek apakah user sudah ada
            $user = User::where('email', $googleUser->email)->first();
            $token = "";
            // dd($user);
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(env('DFL_PWD')), // Password random
                    'google_id' => $googleUser->id,
                    'RecordOwnerID' => '-',
                    'is_verified' => true,
                    'VerificationOn' => Carbon::now(),
                    'VerificationToken' => null,
                ]);

                Auth::login($user);
                Alert::success('Success', 'Welcome! Account created and logged in.');

                // return redirect('/register')->with('success', 'Login Successfuly');
                // $datalogin = [
                //     'email' => $googleUser->email,
                //     'password' => env('DFL_PWD'),
                // ];

                // if (Auth::attempt($datalogin)) {
                //     $token = $user->createToken('authToken')->plainTextToken;
                //     return redirect('/');
                // }
                // else{
                //     return redirect('/register')->with('error', 'Login Failed');
                // }
            }
            else{
                // return redirect('/register')->with('error', 'User is already registered');
                // $datalogin = [
                //     'email' => $googleUser->email,
                //     'password' => env('DFL_PWD'),
                // ];
                // // dd($datalogin);

                // if (Auth::attempt($datalogin)) {
                //     $token = $user->createToken('authToken')->plainTextToken;
                //     return redirect('/');
                // }

                Auth::login($user);

                Alert::success('Welcome Back', 'You are now logged in.');
            }
            return redirect()->intended('/');
            // Buat token JWT
            // $token = $user->createToken('authToken')->plainTextToken;
        } catch (\Exception $e) {
            // return redirect('/register')->with('error', 'User is already registered');
            Alert::error('Login Failed', 'Google authentication failed.');
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function action_login(Request $request) {
        $data = array('success' => false, 'message'=>'', 'data'=>array(), 'redirect'=>"");

        try {
            $this->validate($request, [
                'email'=>'required',
                'password'=>'required',
            ]);

            $data = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];

            $RecordOwnerID = "";

            $user = User::where('email', '=', $request->input('email'))->first();
            if ($user) {
            	$RecordOwnerID = $user->RecordOwnerID;
            }

            // Validasi Kode Partner Exist
            $oPartner = Company::where('PartnerCode','=',$RecordOwnerID)->first();

            

            if (Auth::Attempt($data)) {
                if ($oPartner) {
                    $data['success'] = true;
                    $data['redirect'] = 'dashboard';
                }
                else{
                    if ($RecordOwnerID == "999999") {
                        $data['success'] = true;
                        $data['redirect'] = 'admin';
                    }
                    else{
                        $data['success'] = true;
                        $data['redirect'] = 'userdashboard';
                    }
                }
            }
            else{
                $data['success'] = false;
                $data['message'] = 'Email or Password incorect';
            }

            jump:
        } catch (\Throwable $th) {
            $data['success'] = false;
            $data['message'] = 'Error '.$th->getMessage();
            $data['redirect'] = 'login';
        }

        return response()->json($data);
    }
}
