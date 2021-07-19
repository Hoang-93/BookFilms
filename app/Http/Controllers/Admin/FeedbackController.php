<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    //
    public function Index(){
    	$query = DB::table('comment')
    					->join('film', 'film.ID', '=', 'comment.Film_ID')
        				->join('users', 'users.ID', '=', 'comment.User_ID')
        				->select('comment.ID','comment.Content','comment.Rate','comment.CreatedDate','comment.Status','film.Name','users.Fullname')
                        ->orderBy('comment.CreatedDate', 'desc')
            			->paginate(20);
        
        return view('admin.feedback.index')->with([
    										'query'=> $query
    									]);
    }

    public function ChangeStatus($ID){
    	$cmt = DB::table('comment')->where('ID', $ID)->first();
    	$status = "";
    	if($cmt->Status == true)
    		$status = false;
    	else
    		$status = true;
    	DB::update('update comment set Status = ? where ID = ?', [$status, $ID]);
    	return response()->json([
    		'success' => 'Record deleted successfully!'
    	]);
    }

    public function Detail($Comment_ID){
    	$comment = DB::table('comment')
    					->join('film', 'film.ID', '=', 'comment.Film_ID')
        				->join('users', 'users.ID', '=', 'comment.User_ID')
        				->where('comment.ID', $Comment_ID)
        				->select('film.Name','users.Fullname','comment.CreatedDate')
            			->first();
        $reply = DB::table('reply')
    					->join('comment', 'comment.ID', '=', 'reply.Comment_ID')
        				->join('users', 'users.ID', '=', 'reply.User_ID')
        				->where('comment.ID', $Comment_ID)
        				->select('reply.ID','reply.Content','reply.CreatedDate','users.Fullname')
            			->get();
        return view('admin.feedback.detail')->with([
    										'comment'=> $comment,
    										'reply'=> $reply
    									]);
    }

}
