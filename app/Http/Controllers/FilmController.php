<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class FilmController extends Controller
{
    //
     public function Detail($Metatitle, $ID){
     	$DateNow = Carbon::now('Asia/Ho_Chi_Minh');
     	$film = DB::table('film')->where('ID', $ID)->select('*')->first();

     	//Đánh giá
     	$lstComment = DB::table('comment')
    					->join('film', 'film.ID', '=', 'comment.Film_ID')
            			->join('users', 'users.ID', '=', 'comment.User_ID')
            			->where('comment.Film_ID', $ID)
                        ->where('comment.Status', true)
            			->select('comment.ID','comment.Content', 'comment.Rate', 'users.Fullname', 'comment.CreatedDate')
                        ->orderBy('comment.CreatedDate')
            			->get();
        //Trả lời đánh giá
        $lstReply = DB::table('reply')
    					->join('comment', 'comment.ID', '=', 'reply.Comment_ID')
            			->join('users', 'users.ID', '=', 'reply.User_ID')
                        ->where('comment.Film_ID', $ID)
            			->select('reply.ID','reply.Content', 'reply.Comment_ID', 'users.Fullname', 'reply.CreatedDate')
                        ->orderBy('reply.CreatedDate')
            			->get();
        //thể loại phim
        $lstCate = DB::table('categoryfilm')
    					->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
            			->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
            			->where('categoryfilm.Film_ID', $ID)
            			->select('category.Name')
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
    	return view('film.detail')->with([
    										'film'=> $film,
    										'MoviePlay'=> $MoviePlay,
    										'ComingMovie'=> $ComingMovie,
    										'lstCate'=> $lstCate,
    										'lstReply'=> $lstReply,
    										'lstComment'=> $lstComment
    									]);
    }

    public function addComment($user_id, $film_id, $content, $rate){
    	$currentDate = Carbon::now('Asia/Ho_Chi_Minh');

    	DB::insert('insert into comment 
    		(Content, Rate, CreatedDate, User_ID, Film_ID)  values (?, ?, ?, ?, ?)', 
    		[$content, $rate, $currentDate , $user_id, $film_id]);

        //Cập nhật điểm đánh giá
        $film = DB::table('film')
                            ->where('ID', $film_id)
                            ->first();
        $vote = round(( $film->Vote + $rate ) / 3, 1);
        
        DB::update('update film set Vote = ? where ID = ?', [$vote, $film_id]);

    	return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    public function addReply(Request $request){
    	$currentDate = Carbon::now('Asia/Ho_Chi_Minh');
    	$User_ID = $request->get("User_ID");
    	$Comment_ID = $request->get("Comment_ID");
    	$Content = $request->get("Content");
    	$Film_ID = $request->get("Film_ID");

    	DB::insert('insert into reply 
    		(Content, CreatedDate, User_ID, Comment_ID)  values (?, ?, ?, ?)', 
    		[$Content, $currentDate , $User_ID, $Comment_ID]);

    	$film = DB::table('film')
    						->where('ID', $Film_ID)
    						->first();
    	return redirect()->action(
    				[FilmController::class, 'Detail'], ['Metatitle' => $film->Metatitle, 'ID' => $film->ID]
		);
    }

     public function ListName($query){
        // $search = $request->query;
        $product = DB::table('film')->where('Name', 'like', '%'.$query.'%')->select('Image','Name')->get();

        $response = array();
        foreach($product as $autocomplate){
            $response[] = array("value"=>$autocomplate->Image,"label"=>$autocomplate->Name);
       }

      echo json_encode($response);
        // return response()->json([
        //     'product' => $product
        // ]);
    }

    public function Search(Request $request){
        $keyword = $request->get('keyword');
        $film = DB::table('film')->where('Name', 'like', '%'.$keyword.'%')->get();
        $lstCate = DB::table('categoryfilm')
                        ->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
                        ->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
                        ->select('category.Name', 'categoryfilm.Film_ID')
                        ->get();
        return view('film.search', ['film' => $film])->with([
                'film'=> $film,
                'lstCate'=> $lstCate,
                'keyword'=> $keyword
            ]);
    }	
}
