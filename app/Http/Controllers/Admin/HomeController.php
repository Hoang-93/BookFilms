<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class HomeController extends Controller
{
    //
    public function Index(){
    	//Thành viên website
    	$count_user = DB::table('users')
    					->where('account', '!=', 'admin')
            			->count();

        //Doanh thu
        $count_money = DB::table('book_ticket')->sum('TotalPrice');

        //Vé đặt trước
    	$count_ticket = DB::table('book_ticket')
                        ->where('Status', true)
            			->count();
        
        //Xếp hạng phim
        $lstFilm = DB::table('film')
                        	->orderBy('Vote', 'desc')
        					->take(10)
        					->get();
       	$cate = DB::table('categoryfilm')
    					->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
    					->join('film', 'film.ID', '=', 'categoryfilm.film_ID')
            			->select('categoryfilm.Film_ID','category.Name')
            			->get();
        //Phim đặt vé nhiều
        $film_ticket = DB::table('book_ticket')
    					->join('film', 'film.ID', '=', 'book_ticket.Film_ID')
            			->select('film.Name', DB::raw('COUNT(book_ticket.Film_ID) as count_film'))
                        ->orderBy('count_film', 'desc')
            			->groupBy('film.Name','book_ticket.Film_ID')
            			->get();

        //đánh giá phim mới
        $Comment = DB::table('comment')->get();    
        $comment_today = 0;
        foreach ($Comment as $item) {
        	# code...
        	$date = Carbon::parse($item->CreatedDate)->format('d m Y');
        	$datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('d m Y');
        	if($date == $datenow){
        		$comment_today++;
        	}

            // echo "date: " . $date;
            // echo "datenow: " . $datenow;
        }

        //Thống kê vé đặt hàng hôm nay
        $order_date = DB::table('book_ticket')->select('CreatedDate')->get();
        $ticket_today = 0;
        foreach ($order_date as $item) {
        	# code...
        	$date = Carbon::parse($item->CreatedDate)->format('d m Y');
        	$datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('d m Y');
        	if($date == $datenow){
        		$ticket_today++;
        	}
        }

        $DateNow = Carbon::now('Asia/Ho_Chi_Minh');
        //Phim đang chiếu
        $moviePlay = DB::table('film')
    					->where('ReleaseDate', '<', $DateNow)
            			->count();

        //Phim sắp chiếu
        $comingMovie = DB::table('film')
    					->where('ReleaseDate', '>=', $DateNow)
            			->count(); 			
        return view('admin.home.index')->with([
    										'count_user'=> $count_user,
    										'count_money'=> $count_money,
    										'count_ticket'=> $count_ticket,
    										'lstFilm'=> $lstFilm,
    										'cate'=> $cate,
    										'film_ticket'=> $film_ticket,
    										'comment_today'=> $comment_today,
    										'ticket_today'=> $ticket_today,
    										'moviePlay'=> $moviePlay,
    										'comingMovie'=> $comingMovie
    									]);
    }

}
