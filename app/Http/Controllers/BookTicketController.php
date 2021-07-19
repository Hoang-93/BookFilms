<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;

class BookTicketController extends Controller
{
    //
     public function BookDateTime($ID){
     	if(Session::get('user') == null){
     		Session::flash('error', 'Please login to book tickets.');
     		return redirect('/dang-nhap.html');
     	}

     	$film = DB::table('film')->where('ID', $ID)->select('*')->first();
    	return view('bookticket.datetime')->with([
    										'film'=> $film
    									]);
    }

    public function BookSit(Request $request){
        Session::forget('bookDateTime');
    	$Date = $request->get("Date");
    	$Time = $request->get("Time");
    	$ID = $request->get("Film_ID");

    	$User_ID = Session::get('user')->ID;

    	//Save date & time
    	if(Session::get('bookDateTime') == null){

    		$book = [
    			$User_ID =>[
    				"Date" => $Date,
    				"Time" => $Time
    			]
			];
    		Session::put('bookDateTime', $book);

    	}else{
    		$book = Session::get('bookDateTime');
    		if($book == $User_ID){
    			$book[$User_ID] =	[
    					"Date" => $Date,
    					"Time" => $Time
    				];
    			Session::put('bookDateTime', $book);
    		}
    	}

        //Load total seat in cinema
        $dem = 1;
        $CharRow = array();
        foreach( range('A', 'Z') as $item) {

            // array_push($CharRow, $dem, $item);
            $CharRow[$dem] = $item;
            $dem++;
        }

        //Check booked seat
        $book_film = DB::table('book_ticket')
                            ->where('Film_ID', $ID)
                            ->where('Status', true)
                            ->get();
        $sitBooked = array();
        $str = '';
        $Date = Carbon::createFromFormat('d/m/Y', $Date)->format('Y-m-d');
        $Time = Carbon::parse($Time)->format('h:i');
        foreach ($book_film as $item) {
            # code...
            if($item->Date == $Date && Carbon::parse($item->Time)->format('h:i') == $Time){
                $str .= $item->Sit;
            }
        }
        $sitBooked = explode(',', $str);
        $arr_sit = array();
        for ($i=0; $i <= count($sitBooked); $i++) {
            if(count($sitBooked) > $i){
                $arr_sit[] = trim($sitBooked[$i]);
            }
        }
        array_pop($arr_sit);
        // var_export($arr_sit);
        $priceSit = array();
        $room = DB::table('room_detail')->get();
        foreach ($room as $item) {
            $priceSit[$item->Level] = $item->Price;
        }



    	$film = DB::table('film')->where('ID', $ID)->select('*')->first();

    	$lstFoodDrink = DB::table('food_drink')->get();
    	return view('bookticket.sitAndFood')->with([
                                            'CharRow'=> $CharRow,
                                            'arr_sit'=> $arr_sit,
                                            'room'=> $room,
                                            'priceSit'=> $priceSit,
    										'film'=> $film,
    										'lstFoodDrink'=> $lstFoodDrink
    									]);
    }



    public function BookFoodDrink(Request $request){
    	$TypeExpansive = $request->get("Type-expansive"); //total ticket row 1
    	$TypeMiddle = $request->get("Type-middle");//total ticket row 2
    	$TypeCheap = $request->get("Type-cheap"); //total ticket row 3

    	$CountTicket = $request->get("CountTicket"); //total ticket
    	$SitCheap = $request->get("Sit-cheap"); //seat  on row 3
    	$SitMiddle = $request->get("Sit-middle"); //seat on row 2
    	$SitExpansive = $request->get("Sit-expansive"); //seat on row  1

    	$Sits = $request->get("Sits"); //seat total
    	$TotalMoney = $request->get("TotalMoney"); //Total payment

    	$CreatedDate = Carbon::now('Asia/Ho_Chi_Minh');

    	$ID = $request->get("Film_ID");
    	$User_ID = Session::get('user')->ID;


        Session::forget('bookSit');
        Session::forget('bookFoodDrink');
        Session::forget('TypeSit');
    	// var_dump($Sits);
    	//save booking seat
    	if(Session::get('bookSit') == null){

    		$book = [
    			$User_ID =>[
    				"CreatedDate" => $CreatedDate,
    				"Sit" => $Sits,
    				"CountTicket" => $CountTicket,
    				"TotalPrice" => $TotalMoney,
    				"Film_ID" => $ID
    			]
			];
    		Session::put('bookSit', $book);

    	}else{
    		$book = Session::get('bookSit');
    		if($book == $User_ID){
    			$book[$User_ID] = [
    					"CreatedDate" => $CreatedDate,
    					"Sit" => $Sits,
    					"CountTicket" => $CountTicket,
    					"TotalPrice" => $TotalMoney,
    					"Film_ID" => $ID
    				];
    			Session::put('bookSit', $book);
    		}
    	}

    	$TypeSit = array(
    		"1" => array
    		(
    			"Sit" => $SitCheap,
    			"Type" => 3,
    			"Count" => $TypeCheap,
    			"Price" => 15000
    		),

    		"2" => array
    		(
    			"Sit" => $SitMiddle,
    			"Type" => 2,
    			"Count" => $TypeMiddle,
    			"Price" => 10000
    		),

    		"3" => array
    		(
    			"Sit" => $SitExpansive,
    			"Type" => 1,
    			"Count" => $TypeExpansive,
    			"Price" => 5000
    		)
    	);
    	Session::put('TypeSit', $TypeSit);


    	//Lưu đồ ăn đặt sẵn

    	//save exist food

    	for ($i=0; $i < count($request->BookFood_ID); $i++) {
    		# code...
    		$FoodDrink_ID = $request->BookFood_ID[$i];
    		$Quantity = $request->Quantity[$i];
    		$food_drink = DB::table('food_drink')->where('ID', $FoodDrink_ID)->select('*')->first();
    		// Session::forget('bookFoodDrink');


    		if(Session::get('bookFoodDrink') == null){

    			if($Quantity != 0){
    				$book = [
    					$i => [
    							"User_ID" => $User_ID,
    							"FoodDrink_ID" => $FoodDrink_ID,
    							"NameFood" => $food_drink->Name,
    							"PriceFood" => $food_drink->Price,
    							"Quantity" => $Quantity
    					]
    				];

    				Session::put('bookFoodDrink', $book);
    			}

    		}else{
    			if($Quantity != 0){
    				$book = Session::get('bookFoodDrink');
    				// var_dump($book);
    				// print_r($book['0']);

    				$book[$i] = [
    						"User_ID" => $User_ID,
    						"FoodDrink_ID" => $FoodDrink_ID,
    						"NameFood" => $food_drink->Name,
    						"PriceFood" => $food_drink->Price,
    						"Quantity" => $Quantity
    					];
    				Session::put('bookFoodDrink', $book);
    			}
    		}
    	}

    	$food_drink = Session::get('bookFoodDrink');
    	$bookSit = Session::get('bookSit');
    	$user_id = Session::get('user')->ID;

    	$TotalFoodDrink = 0;
        if($food_drink != null){
            foreach ($food_drink as $key=>$value){
                $TotalFoodDrink += $value['PriceFood'] * $value['Quantity'];
            }

        }

        $ticket = DB::table('room_detail')
                        ->where('ID', 1)
                        ->first();
    	$TotalMoney = $bookSit[$User_ID]['TotalPrice'] + $bookSit[$User_ID]['CountTicket'] * $ticket->TicketPrice + $TotalFoodDrink;
    	// var_dump(Session::get('bookDateTime'));
    	// var_dump(Session::get('bookSit'));
    	// var_dump(Session::get('bookFoodDrink'));
    	// var_dump($request->BookFood_ID);

    	$film = DB::table('film')->where('ID', $ID)->select('*')->first();
    	return view('bookticket.checkout')->with([
                                            'film'=> $film,
    										'ticket'=> $ticket,
    										'food_drink'=> $food_drink,
    										'booksit'=> $bookSit,
    										'user_id'=> $user_id,
    										'TotalFoodDrink'=> $TotalFoodDrink,
    										'TotalMoney'=> $TotalMoney
    									]);
    }

    public function Payment(Request $request){
    	$card = array(
    		"1" => array
    		(
    			"CardNumber" => 123456789,
    			"Month" => 6,
    			"Year" => 2021,
    			"NameCard" => "DO CONG HUNG"
    		),

    		"2" => array
    		(
    			"CardNumber" => 123456789,
    			"Month" => 6,
    			"Year" => 2021,
    			"NameCard" => "LE TUAN XUYEN"
    		),

    		"3" => array
    		(
    			"CardNumber" => 123456789,
    			"Month" => 6,
    			"Year" => 2021,
    			"NameCard" => "DUONG QUA"
    		)
    	);

    	$CardNumber = $request->get("CardNumber");
    	$Month = $request->get("Month");
    	$Year = $request->get("Year");

    	$NameCard = $request->get("NameCard");

    	$isPayment = false;
    	foreach ($card as $key => $value) {
    		# code...

    		if($CardNumber == $value['CardNumber'] && $Month == $value['Month'] && $Year == $value['Year'] && $NameCard == $value['NameCard']){
    			$isPayment = true;
    		}
    	}

    	$datetime = Session::get('bookDateTime');
    	$booksit = Session::get('bookSit');
    	$food_drink = Session::get('bookFoodDrink');
    	$user_id = Session::get('user')->ID;
    	$typesit = Session::get('TypeSit');
    	$ID = $request->get("Film_ID");
    	if($isPayment == true){
              $Date = Carbon::createFromFormat('d/m/Y', $datetime[$user_id]['Date'])->format('Y-m-d');
    		  $Time = Carbon::parse($datetime[$user_id]['Time'])->format('h:i');

    		$TotalMoney = $request->get("TotalMoney");
    		DB::insert('insert into book_ticket
    		(Date, Time, CreatedDate, Sit, CountTicket, TotalPrice, User_ID, Film_ID, Status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
    		[
    			$Date,
    			$Time,
    			$booksit[$user_id]['CreatedDate'],
    			$booksit[$user_id]['Sit'],
    			$booksit[$user_id]['CountTicket'],
    			$TotalMoney,
    			$user_id,
    			$booksit[$user_id]['Film_ID'],
                true
    		]);

    		$book_ticket_id = DB::table('book_ticket')->max('ID');
            if($food_drink != null){
                foreach ($food_drink as $key=>$value){
                    $TotalPrice = $value['PriceFood'] * $value['Quantity'];

                    DB::insert('insert into book_fd
                        (Quantity, TotalPrice, BookTicket_ID, FoodDrink_ID)
                        values (?, ?, ?, ?)',
                        [
                            $value['Quantity'],
                            $TotalPrice,
                            $book_ticket_id,
                            $value['FoodDrink_ID']
                        ]);
                }
            }


    		foreach ($typesit as $key=>$value){
    			$TotalMoney = $value['Price'] * $value['Count'];
                if($value['Sit'] != null){
                    DB::insert('insert into book_sit
                    (Sit, Type, Count, Price, TotalMoney, BookTicket_ID) values (?, ?, ?, ?, ?, ?)',
                    [
                        $value['Sit'],
                        $value['Type'],
                        $value['Count'],
                        $value['Price'],
                        $TotalMoney,
                        $book_ticket_id
                    ]);
                }

    		}

    		$TotalFoodDrink = 0;
    		if($food_drink != null){
                foreach ($food_drink as $key=>$value){
                    $TotalFoodDrink += $value['PriceFood'] * $value['Quantity'];
                }

            }

             $ticket = DB::table('room_detail')
                        ->where('ID', 1)
                        ->first();
    		$TotalMoney = $booksit[$user_id]['TotalPrice'] + $booksit[$user_id]['CountTicket'] * $ticket->TicketPrice + $TotalFoodDrink;
    		$film = DB::table('film')->where('ID', $ID)->select('*')->first();

    		Session::forget('bookDateTime');
    		Session::forget('bookSit');
    		Session::forget('bookFoodDrink');
    		Session::forget('TypeSit');

    		//Membership Points
    		$member = DB::table('member')->where('User_ID', $user_id)->select('*')->first();
    		if($member != null){
    			$point = $member->Point + 10;

    			$name = "";
                if($point >= 10 && $point <= 30)
                	$name .= "Bronze";
                else if($point > 30 && $point <= 60)
                	$name .= "Sliver";
                else if($point > 60 && $point <= 90)
                	$name .= "Gold";
                else if($point > 90)
 
                	$name .= "Diamond";
            
                DB::update('update member set Name = ?, Point = ? where ID = ?',
                [$name, $point, $member->ID]);
    		}else{
    			DB::insert('insert into member
    				(Point, Name, User_ID) values (?, ?, ?)',
    				[
    					10,
    					'Đồng',
    					$user_id
    				]);
    		}

    		return view('bookticket.success')->with([
    										'film'=> $film,
    										'food_drink'=> $food_drink,
    										'booksit'=> $booksit,
    										'user_id'=> $user_id,
    										'datetime'=> $datetime,
    										'TotalMoney'=> $TotalMoney
    									]);

    	}else{
    		$TotalFoodDrink = 0;
    		if($food_drink != null){
                foreach ($food_drink as $key=>$value){
                    $TotalFoodDrink += $value['PriceFood'] * $value['Quantity'];
                }

            }
             $ticket = DB::table('room_detail')
                        ->where('ID', 1)
                        ->first();

    		$TotalMoney = $booksit[$user_id]['TotalPrice'] + $booksit[$user_id]['CountTicket'] * $ticket->TicketPrice + $TotalFoodDrink;
    		Session::flash('error', 'Số thẻ, ngày phát hành hoặc tên tin trên thẻ sai, vui lòng nhập lại.');
    		$film = DB::table('film')->where('ID', $ID)->select('*')->first();
    		return view('bookticket.checkout')->with([
    										'film'=> $film,
    										'food_drink'=> $food_drink,
    										'booksit'=> $booksit,
    										'user_id'=> $user_id,
    										'TotalFoodDrink'=> $TotalFoodDrink,
    										'TotalMoney'=> $TotalMoney
    									]);
    	}
    }


}
