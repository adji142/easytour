<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\roles;
use App\Models\User;
use App\Models\UserRole;

class UserController extends Controller
{
    public function View(Request $request)
    {
    	$field = ['KodeUser','NamaUser'];
        $keyword = $request->input('keyword');
        $KelompokAkses = $request->input('KelompokAkses');
        $StatusUser = $request->input('StatusUser');

        $sql = "users.id, users.name, users.email, CASE WHEN users.Active = 'Y' THEN 'Aktif' ELSE 'Tidak Aktif' END StatusUser, roles.RoleName";

        $users = User::selectRaw($sql)
				->leftJoin('userrole','users.id','=','userrole.userid')
				->leftJoin('roles','roles.id','=','userrole.roleid')
                ->where('users.RecordOwnerID','=',Auth::user()->RecordOwnerID);

        if ($KelompokAkses != "") {
        	$users->where('roles.id','=', $KelompokAkses);
        }

        if ($StatusUser != "") {
        	$users->where('users.Active','=', $StatusUser);
        }

        // KelompokAkses
        $roles = roles::selectRaw("*")
        		->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)->get();

        $title = 'Delete User !';
        $text = "Are you sure you want to delete ?";
        confirmDelete($title, $text);
        return view("master.Auth.User",[
            'users' => $users->get(), 
            'rolesdata' => $roles,
            'oldKelompokAkses' => $KelompokAkses,
            'oldStatusUser' => $StatusUser
        ]);
    }

    public function Form($id = null)
    {
    	$sql = "users.*, roles.id as KelompokAkses,roles.RoleName";
    	$users = User::selectRaw($sql)
			->leftJoin('userrole','users.id','=','userrole.userid')
			->leftJoin('roles','roles.id','=','userrole.roleid')
	        ->where('users.RecordOwnerID','=',Auth::user()->RecordOwnerID)
	        ->where('users.id','=', $id)->get();
        
        $roles = roles::selectRaw("*")
        		->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)->get();

        return view("master.Auth.User-Input",[
            'users' => $users,
            'rolesdata' => $roles,
        ]);
    }

    public function store(Request $request)
    {
    	Log::debug($request->all());

    	// DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
	            'name' => 'required|string|max:255',
	            'email' => 'required|email|unique:users,email',
	            'password' => 'required|string|min:8|confirmed',
	        ]);

	        // if ($validator->fails()) {
	        //     return redirect()->back()
	        //                 ->withErrors($validator)
	        //                 ->withInput();
	        // }
            
            $KelompokAkses = $request->input('KelompokAkses');


            $save = User::insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'Active' => $request->input('Active'),
                'RecordOwnerID' => Auth::user()->RecordOwnerID
            ]);

            if ($save) {
            	if ($KelompokAkses != "") {
            		$model = new UserRole;
            		$model->userid = $save;
            		$model->roleid = $KelompokAkses;
            		$model->RecordOwnerID = Auth::user()->RecordOwnerID;

            		$saveRole = $model->save();
            		if (!$saveRole) {
            			throw new \Exception('Gagal Menyimpan Data Akses');
            			goto jump;
            		}
            	}

                alert()->success('Success','Data User Berhasil disimpan.');
                return redirect('user');
                jump:
            }else{
                throw new \Exception('Penambahan Data Gagal');
                // DB::rollback();
            }

            
            // DB::commit();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            // DB::rollback();
            alert()->error('Error',$e->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        Log::debug($request->all());
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
	            'email' => 'required|email',
            ]);

            $model = User::where('id','=',$request->input('id'));
            $KelompokAkses = $request->input('KelompokAkses');

            if ($model) {
            	// $model->Kode = $request->input('Kode');
             //    $model->Nama = $request->input('Nama');
                $update = DB::table('users')
                			->where('id','=', $request->input('id'))
                            ->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)
                			->update(
                				[
									'name' => $request->input('name'),
									'email' => $request->input('email'),
                                    'Active' => $request->input('Active')
                				]
                			);

                if ($KelompokAkses != "") {
            		$saveRole = DB::table('userrole')
        			->where('userid','=', $request->input('id'))
                    ->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)
        			->update(
        				[
							'roleid' => $KelompokAkses
        				]
        			);
            		if (!$saveRole) {
            			throw new \Exception('Gagal Menyimpan Data Akses');
            			// DB::rollback();
            			goto jump;
            		}
            	}
                alert()->success('Success','Data User berhasil disimpan.');
                return redirect('user');
                jump:
            } else{
                throw new \Exception('Grup User not found.');
            }
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            alert()->error('Error',$e->getMessage());
            return redirect()->back();
        }
    }

    public function deletedata(Request $request)
    {
        $users = DB::table('users')
                ->where('KodeUser','=', $request->id)
                ->where('RecordOwnerID','=',Auth::user()->RecordOwnerID)
                ->delete();

        if ($users) {
        	alert()->success('Success','Delete User berhasil.');
        }
        else{
        	alert()->error('Error','Delete User Gagal.');
        }
        return redirect('users');
    }
}