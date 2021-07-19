<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

class LoginController extends Controller
{
    //
    public function Login(){
    	return view('login.login');
    }

    public function FormLogin(Request $request){
    	$account = $request->get("Account");
    	$password = $request->get("Password");

    	if(DB::table('users')->where('Account', $account)->where('Password', $password)->count() > 0){
            if($account == "admin"){
                $user = DB::table('users')
                    ->where('Account', $account)
                    ->where('Password', $password)
                    ->first();

                Session::put('admin', $user);
                return redirect('/Admin/Home');
            }else{
                $user = DB::table('users')
                ->where('Account', $account)
                ->where('Password', $password)
                ->first();
                if($user->Status == false){
                    Session::flash('error', 'Your account is banned.');
                    return redirect('/dang-nhap.html');
                }else{
                    Session::put('user', $user);
                    return redirect('/');
                }
            }

    	}else{
            Session::flash('error', 'Wrong account and password. Please login again.');
    		return redirect('/dang-nhap.html');
    	}
    }

    public function Register(){
    	return view('login.register');
    }

    public function FormRegister(Request $request){
    	$Account = $request->get("Account");
        $Email = $request->get('Email');
    	$Password = $request->get("Password");
    	$Fullname = $request->get("Fullname");
    	$Address = $request->get("Address");
    	$Phone = $request->get("Phone");
    	$Sex = $request->get("Sex");
    	$BirthDay = $request->get("BirthDay");

        $isExist = DB::table('users')
                ->where('Account', $Account)
                ->count();
        $isEmail = DB::table('users')->where('Email', $Email)->count();
        if($isExist > 0){
            Session::flash('error', 'Your account already exists, Please enter again.');
            return redirect('/dang-ky.html');
        } elseif($isEmail > 0) {
            Session::flash('error', 'Your Email already exists, Please enter again.');
            return redirect('/dang-ky.html');
        }
            DB::insert('insert into users
                (Account, Email, Password, Fullname, Address, Phone, Sex, BirthDay, Type, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [$Account, $Email, $Password, $Fullname, $Address, $Phone, $Sex, $BirthDay, 1, 1]);
            Session::flash('success', 'Your account has successfully registered. Please login to continue.');
            return redirect('/dang-nhap.html');

    }

    public function ChangePass(){
        return view('login.changePass');
    }

    public function FormChangePass(Request $request){
    	$OldPass = $request->get("OldPass");
    	$NewPass = $request->get("NewPass");

    	$user = Session::get('user');
        if($user == null){
            Session::flash('error', 'Please login to continue.');
            return redirect('/dang-nhap.html');
        }

    	if($user->Password != $OldPass){
    		Session::flash('error', 'Your password is incorrect, Please enter again.');
    		return redirect('/doi-mat-khau.html');
    	}else{
    		DB::update('update users set Password = ? where ID = ?', [$NewPass, $user->ID]);

    		Session::forget('user');
    		Session::flash('error', 'Change password successfully, please login again.');
    		return redirect('/dang-nhap.html');
    	}

    }

    public function HistoryTicket()
    {
        $DateNow = Carbon::now('Asia/Ho_Chi_Minh');
        $user = Session::get('user');

        if($user == null){
            Session::flash('error', 'Please login to continue.');
            return redirect('/dang-nhap.html');
        }

        $query = DB::table('book_ticket')
                        ->join('film', 'film.ID', '=', 'book_ticket.Film_ID')
                        ->join('users', 'users.ID', '=', 'book_ticket.User_ID')
                        ->where('users.ID', $user->ID)
                        ->select('book_ticket.ID','book_ticket.Date','book_ticket.Time','book_ticket.CreatedDate','book_ticket.Sit','book_ticket.CountTicket','book_ticket.TotalPrice','book_ticket.Status','film.Name','film.ReleaseDate')
                        ->orderBy('book_ticket.CreatedDate', 'desc')
                        ->paginate(10);
        $member = DB::table('member')
                        ->where('User_ID', $user->ID)
                        ->first();

        //phim đang chiếu
        $MoviePlay = DB::table('film')
                        ->where('ReleaseDate', '<', $DateNow)
                        ->take(10)
                        ->get();

        //phim sắp chiếu
        $ComingMovie = DB::table('film')
                        ->where('ReleaseDate', '>=', $DateNow)
                        ->take(10)
                        ->get();
        return view('login.history_ticket')->with([
                                            'query'=> $query,
                                            'member'=> $member,
                                            'MoviePlay'=> $MoviePlay,
                                            'ComingMovie'=> $ComingMovie
                                        ]);
    }

    public function DetailTicket($BookTicket_ID){
        $DateNow = Carbon::now('Asia/Ho_Chi_Minh');
        $ticket = DB::table('book_ticket')
                        ->join('film', 'film.ID', '=', 'book_ticket.Film_ID')
                        ->join('users', 'users.ID', '=', 'book_ticket.User_ID')
                        ->where('book_ticket.ID', $BookTicket_ID)
                        ->select('film.Name','users.Fullname','book_ticket.TotalPrice','book_ticket.Sit')
                        ->first();
        $food_drink = DB::table('book_fd')
                        ->join('book_ticket', 'book_ticket.ID', '=', 'book_fd.BookTicket_ID')
                        ->join('food_drink', 'food_drink.ID', '=', 'book_fd.FoodDrink_ID')
                        ->where('book_fd.BookTicket_ID', $BookTicket_ID)
                        ->select('book_fd.Quantity','food_drink.Name')
                        ->get();
        //phim đang chiếu
        $MoviePlay = DB::table('film')
                        ->where('ReleaseDate', '<', $DateNow)
                        ->take(10)
                        ->get();

        //phim sắp chiếu
        $ComingMovie = DB::table('film')
                        ->where('ReleaseDate', '>=', $DateNow)
                        ->take(10)
                        ->get();
        return view('login.detail')->with([
                                            'food_drink'=> $food_drink,
                                            'ticket'=> $ticket,
                                            'MoviePlay'=> $MoviePlay,
                                            'ComingMovie'=> $ComingMovie
                                        ]);
    }

    public function Update(Request $request){
        $ID = $request->get("ID");
        $Fullname = $request->get("Fullname");
        $Address = $request->get("Address");
        $Phone = $request->get("Phone");
        $BirthDay = $request->get("BirthDay");


        DB::update('update users set Fullname = ?, Address = ?, Phone = ?, BirthDay = ?  where ID = ?',
                [$Fullname, $Address, $Phone, $BirthDay, $ID]);

         $user = DB::table('users')
                ->where('ID', $ID)
                ->first();
        Session::put('user', $user);
        $user = Session::get('user');
        Session::flash('error', 'Update information succesful.');

        return redirect()->action(
                    [LoginController::class, 'UpdateUser'], ['user' => $user]
        );
    }

    public function UpdateUser(){

        $user = Session::get('user');

        if($user == null){
            Session::flash('error', 'Please login to continue.');
            return redirect('/dang-nhap.html');
        }
        return view('login.update')->with([
                                            'user'=> $user
                                        ]);
    }

    public function Fotpassword(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            $userEmail = DB::table('users')->where('Email', $data['Email'])->count();
            if($userEmail == 0) {
                Session::flash('error', 'Your Email does not exist. Please enter again or register');
                 return redirect()->back();
            }
            //get user details
            $userDetails = DB::table('users')->where('Email', $data['Email'])->first();
            //gernetaate random password
            $radom_password = Str::random(8);
            //Encode/Serouc password
            $new_password = bcrypt($radom_password);
            //update password
            DB::table('users')->where('Email', $data['Email'])->update(['Password'=>$radom_password]);
            //send forget Password Email code
            $email = $data['Email'];
            $name = $userDetails->Fullname;
            $messageData = [
                'Email'=>$email,
                'Fullname'=>$name,
                'Password'=>$radom_password
            ];
            Mail::send('login.forgotpassword', $messageData, function($mesage)use($email) {
                $mesage->to($email)->subject('New Password - X-Star Cineplex');
            });
            Session::flash('success', 'Please check your email for new pasword!');
            return redirect('/dang-nhap.html');
        }
        return view('login.forgot');
    }

    public function logout(){
        Session::forget('user');
    	Session::forget('admin');
    	return redirect('/');
    }
}
