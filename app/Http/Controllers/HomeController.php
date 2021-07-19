<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
     public function index(){
     	$DateNow = Carbon::now('Asia/Ho_Chi_Minh');

     	//phim đang chiếu
     	$MoviePlay = DB::table('film')
                        ->where('ReleaseDate', '<', $DateNow)
                        ->where('Status', true)
            			->paginate(8);

        //phim sắp chiếu
     	$ComingMovie = DB::table('film')
                        ->where('ReleaseDate', '>=', $DateNow)
                         ->where('Status', true)
            			->paginate(8);
        //thể loại phim
        $lstCate = DB::table('categoryfilm')
    					->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
            			->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
            			->select('category.Name', 'category.Link', 'category.ID', 'categoryfilm.Film_ID')
            			->get();
    	return view('home.index')->with([
    										'ComingMovie'=> $ComingMovie,
    										'lstCate'=> $lstCate,
    										'MoviePlay'=> $MoviePlay
    									]);
    }

     public function MoviePlay(){
        $DateNow = Carbon::now('Asia/Ho_Chi_Minh');

        //phim đang chiếu
        $film = DB::table('film')
                        ->where('ReleaseDate', '<', $DateNow)
                        ->paginate(8);

        //thể loại phim
        $lstCate = DB::table('categoryfilm')
                        ->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
                        ->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
                        ->select('category.Name', 'categoryfilm.Film_ID')
                        ->get();
        return view('home.movie_play')->with([
                                            'lstCate'=> $lstCate,
                                            'film'=> $film
                                        ]);
    }

    public function ComingMovie(){
        $DateNow = Carbon::now('Asia/Ho_Chi_Minh');

        //phim sắp chiếu
        $film = DB::table('film')
                        ->where('ReleaseDate', '>=', $DateNow)
                        ->paginate(8);
        //thể loại phim
        $lstCate = DB::table('categoryfilm')
                        ->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
                        ->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
                        ->select('category.Name', 'categoryfilm.Film_ID')
                        ->get();
        return view('home.coming_movie')->with([
                                            'film'=> $film,
                                            'lstCate'=> $lstCate
                                        ]);
    }

    public function GetFilmByCate($Link, $ID){
        $film = DB::table('categoryfilm')
                        ->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
                        ->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
                        ->where('categoryfilm.Category_ID', $ID)
                        ->select('film.ID', 'film.Name', 'film.Metatitle', 'film.Image', 'film.Time', 'film.Vote')
                        ->paginate(8);

        $cate = DB::table('category')
                        ->where('ID', $ID)
                        ->first();
        //thể loại phim
        $lstCate = DB::table('categoryfilm')
                        ->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
                        ->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
                        ->select('category.Name', 'categoryfilm.Film_ID')
                        ->get();
        return view('home.categoryfilm')->with([
                                            'film'=> $film,
                                            'cate'=> $cate,
                                            'lstCate'=> $lstCate
                                        ]);
    }
}
