<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class TicketController extends Controller
{
    //
    public function Index(){
    	$DateNow = Carbon::now('Asia/Ho_Chi_Minh');
    	$query = DB::table('book_ticket')
    					->join('film', 'film.ID', '=', 'book_ticket.Film_ID')
        				->join('users', 'users.ID', '=', 'book_ticket.User_ID')
        				->select('book_ticket.ID','book_ticket.Date','book_ticket.Time','book_ticket.CreatedDate','book_ticket.Sit','book_ticket.CountTicket','book_ticket.TotalPrice','book_ticket.Status','film.Name','users.Fullname')
                        ->orderBy('book_ticket.CreatedDate', 'desc')
            			->paginate(20);
        
        //Cập nhật trạng thái vé
        foreach ($query as $item) {
        	# code...
        	$date = strtotime($item->Date);
        	$time = strtotime($item->Time);

        	$Dateformat = date('Y-m-d',$date);
        	$timeformat = date('h:i A.',$time);
        	$Date = Carbon::parse($DateNow)->format('Y-m-d');
        	$Time = Carbon::parse($DateNow)->format('h:i A.');

            // echo "Date film: " . $Dateformat . " time film: " . $timeformat . "<br>";
            // echo "Date format: " . $Date . " time format: " . $Time . "<br>";
        	if($Dateformat < $Date || $Dateformat == $Date && $timeformat < $Time)
                // echo $Dateformat . " < " . $Date . "<br>";
        		DB::update('update book_ticket set Status = ? where ID = ?', [false, $item->ID]);
        	
        }

        return view('admin.ticket.index')->with([
    										'query'=> $query
    									]);
    }

    public function ChangeStatus($ID){
    	$book = DB::table('book_ticket')->where('ID', $ID)->first();
    	$status = "";
    	if($book->Status == true)
    		$status = false;
    	else
    		$status = true;
    	DB::update('update book_ticket set Status = ? where ID = ?', [$status, $ID]);
    	return response()->json([
    		'success' => 'Record deleted successfully!'
    	]);
    }

    public function Detail($BookTicket_ID){
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
        return view('admin.ticket.detail')->with([
    										'food_drink'=> $food_drink,
    										'ticket'=> $ticket
    									]);
    }

     public function DeleteTicket($ID){
     	$book = DB::table('book_ticket')->where('ID', $ID)->first();

        DB::table('book_fd')->where("BookTicket_ID", $ID)->delete();
        DB::table('book_sit')->where("BookTicket_ID", $ID)->delete();
        DB::table('book_ticket')->where("BookTicket_ID", $ID)->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

}
