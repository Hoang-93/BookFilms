<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class AdminController extends Controller
{
    //
    public function ChangePass(){
        return view('admin.admin.changePass');
    }

    public function FormChangePass(Request $request){
    	$OldPass = $request->get("OldPass");
    	$NewPass = $request->get("NewPass");

    	$admin = Session::get('admin');
        if($admin == null){
            Session::flash('error', 'Please login to continue.');
            return redirect('/dang-nhap.html');
        }

    	if($admin->Password != $OldPass){
 phuc
    		Session::flash('error', 'Password does not match, enter again.');

    		Session::flash('error', 'The old password does not match, please re-enter it.');
 master
    		return redirect('/Admin/ChangePass');
    	}else{
    		DB::update('update users set Password = ? where ID = ?', [$NewPass, $admin->ID]);

    		Session::forget('admin');
phuc
    		Session::flash('error', 'Change password success, please login again.');

    		Session::flash('error', 'Change password successfully, please login again.');
 master
    		return redirect('/dang-nhap.html');
    	}

    }
}
