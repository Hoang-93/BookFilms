<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;

class RoomController extends Controller
{
    //
    public function Index(){
    	$query = DB::table('room_detail')
                        ->orderBy('Level', 'desc')
            			->paginate(10);
        $ticket = DB::table('room_detail')
                        ->where('ID', 1)
                        ->first();
        return view('admin.room.index')->with([
                                            'query'=> $query,
    										'ticket'=> $ticket
    									]);
    }

    public function GetRoomDetailByID($ID)
    {
    	# code...
    	$room = DB::table('room_detail')->where('ID', $ID)->first();
        return response()->json([
    		'room' => $room
    	]);
    }

    public function GetPriceTicket()
    {
        # code...
        $ticket =DB::table('room_detail')
                        ->where('ID', 1)
                        ->first();
        return response()->json([
            'ticket' => $ticket
        ]);
    }

    public function EditRoomDetail(Request $request){
    	$ID = $request->get("ID");
    	$Row = $request->get("Row");
    	$Column = $request->get("Column");
    	$Price = $request->get("Price");

    	$room = DB::table('room_detail')->where('ID', $ID)->first();

    	if($room->Column != $Column){
    		DB::update('update room_detail set `Column` = ? where Room_ID = ?',
                [$Column, $room->Room_ID]);
    	}
    	DB::update('update room_detail set Row = ?, Price = ?  where ID = ?',
                [$Row, $Price / 1000, $ID]);

    	Session::flash('message', 'Update quantity of seat suceessfully!');
    	return redirect('/Admin/Room');
    }

    public function UpdateTicketPrice(Request $request){
        $TicketPrice = $request->get("TicketPrice");

        DB::update('update room_detail set TicketPrice = ? where Room_ID = ?',
            [$TicketPrice, 1]);
        Session::flash('message', 'Update ticket price successfully!');
        return redirect('/Admin/Room');
    }
}
