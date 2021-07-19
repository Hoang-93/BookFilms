<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Exception;
use File;

class UserController extends Controller
{
    //
    public function Index()
    {
    	# code...
    	$query = DB::table('users')
    					->where('Account', '!=', 'admin')
                        ->orderBy('ID', 'desc')
            			->paginate(10);
        $member = DB::table('member')->get();

        return view('admin.user.index')->with([
    										'query'=> $query,
    										'member'=> $member
    									]);
    }

    public function ChangeStatus($ID){
    	$user = DB::table('users')->where('ID', $ID)->first();
    	$status = "";
    	if($user->Status == true)
    		$status = false;
    	else
    		$status = true;
    	DB::update('update users set Status = ? where ID = ?', [$status, $ID]);
    	return response()->json([
    		'success' => 'Record deleted successfully!'
    	]);
    }

     public function DeleteUser($ID){
         $isExit =  DB::table('book_ticket')->where("User_ID", $ID)->count();
         if($isExit > 0){
            return back()->with('error','You cannot delete it.Because The user account is related to the ticket list!!!');
         }else{
            DB::table('users')->where("ID", $ID)->delete();
            return back()->with('success','Record deleted successfully!!');
         }

       /*  DB::table('users')->where("ID", $ID)->delete();
        if(!$flag) {
            return back()->withErrors(['error'=>'You cannot delete it.Because The user account is related to the ticket list!!!']);
        }
        return back()->with('success','Record deleted successfully!!'); */
      /*   return response()->json([
         'success' => 'Record deleted successfully!'
     ]); */
    }
}
