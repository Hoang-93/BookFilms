<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use File;

class FilmController extends Controller
{
    //
    public function MoviePlay(){
    	$DateNow = Carbon::now('Asia/Ho_Chi_Minh');
    	$query = DB::table('film')
    					->where('ReleaseDate', '<', $DateNow)
                        ->orderBy('ReleaseDate', 'desc')
            			->paginate(10);
        $cate = DB::table('categoryfilm')
        		->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
        		->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
        		->select('category.Name','categoryfilm.Film_ID')
        		->get();
        $category = DB::table('category')->get();
        return view('admin.film.movie_play')->with([
    										'query'=> $query,
    										'cate' => $cate,
    										'category' => $category
    									]);
    }

    public function ComingMovie(){
    	$DateNow = Carbon::now('Asia/Ho_Chi_Minh');
    	$query = DB::table('film')
    					->where('ReleaseDate', '>=', $DateNow)
                        ->orderBy('ReleaseDate', 'desc')
            			->paginate(10);
         $cate = DB::table('categoryfilm')
        		->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
        		->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
        		->select('category.Name','categoryfilm.Film_ID')
        		->get();
        $category = DB::table('category')->get();
        return view('admin.film.coming_movie')->with([
    										'query'=> $query,
    										'cate' => $cate,
    										'category' => $category
    									]);
    }

    public function Add(){
        return view('admin.film.add');
    }

    public function AddFilm(Request $request){
    	$Name = $request->get("Name");
    	$Director = $request->get("Director");
    	$Actor = $request->get("Actor");
    	$Time = $request->get("Time");
    	$ReleaseDate = $request->get("ReleaseDate");
    	$Country = $request->get("Country");
    	$AgeRestriction = $request->get("AgeRestriction");
    	$Description = $request->get("Description");
    	$Trailer = $request->get("Trailer");
    	$MetaTitle = Str_Metatitle($Name);
    	$hinhanh = "";
    	if ($request->hasFile('Image')){
                $img_hinhanh = $request->file("Image");

                // Thư mục upload
                $uploadPath = public_path('assets/images/film/'); // Thư mục upload
            
                // Bắt đầu chuyển file vào thư mục
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();
            }

    	DB::insert('insert into film 
    		(Name, MetaTitle, Image, Director, Actor, Time, ReleaseDate, Country, Vote, AgeRestriction, Description, Trailer, Status) 
    		values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
    		[$Name, $MetaTitle, $hinhanh, $Director, $Actor, $Time, $ReleaseDate, $Country, 4, $AgeRestriction, $Description, $Trailer, 1]);


    	$DateNow = Carbon::now('Asia/Ho_Chi_Minh');
    	if ($ReleaseDate < $DateNow) {
    		# code...
    		Session::flash('message', 'Add Successful');
    		return redirect('/Admin/Film/MoviePlay');
    	}else{
    		Session::flash('message', 'Add Successful');
    		return redirect('/Admin/Film/ComingMovie');
    	}
    	

    	
    }

    public function Edit($ID){
    	$film = DB::table('film')->where('ID', $ID)->first();
        return view('admin.film.edit')->with([
    										'film'=> $film
    									]);
    }

    public function EditFilm(Request $request){
    	$ID = $request->get("ID");
    	$Name = $request->get("Name");
    	$Director = $request->get("Director");
    	$Actor = $request->get("Actor");
    	$Time = $request->get("Time");
    	$ReleaseDate = $request->get("ReleaseDate");
    	$Country = $request->get("Country");
    	$AgeRestriction = $request->get("AgeRestriction");
    	$Description = $request->get("Description");
    	$Trailer = $request->get("Trailer");
    	$MetaTitle = Str_Metatitle($Name);
    	$hinhanh = "";
    	if ($request->hasFile('Image')){
    		$img_hinhanh = $request->file("Image");

                // Thư mục upload
                $uploadPath = public_path('assets/images/film/'); // Thư mục upload

                // Bắt đầu chuyển file vào thư mục
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();

                $img = DB::table('film')->where('ID', $ID)->first();
                if($img->Image != $hinhanh){//Nếu có sửa file ảnh, thì tiến hành xóa ảnh cũ và thêm ảnh mới
                	File::delete($img->Image);
                    // $img_hinhanh->move($uploadPath, $hinhanh->getClientOriginalName());
                	DB::update('update film set Image = ? where ID = ?', [$hinhanh, $ID]);
                }
            }

    	DB::update('update film set Name = ?, MetaTitle = ?, Director = ?, Actor = ?, Time = ?, ReleaseDate = ?, Country = ?, AgeRestriction = ?, Description = ?, Trailer = ?  where ID = ?', 
                [$Name, $MetaTitle, $Director, $Actor, $Time, $ReleaseDate, $Country, $AgeRestriction, $Description, $Trailer,  $ID]);


    	$DateNow = Carbon::now('Asia/Ho_Chi_Minh');
    	if ($ReleaseDate < $DateNow) {
    		# code...
    		Session::flash('message', 'Sửa phim  thành công.');
    		return redirect('/Admin/Film/MoviePlay');
    	}else{
    		Session::flash('message', 'Sửa phim  thành công.');
    		return redirect('/Admin/Film/ComingMovie');
    	}
    }

    //Thêm thể loại cho phim
    public function AddCate($Film_ID, $Category_ID){
    	DB::insert('insert into categoryfilm 
    		(Film_ID, Category_ID) 
    		values (?, ?)', 
    		[
    			$Film_ID, 
    			$Category_ID
    		]);

    	$ID = DB::table('categoryfilm')->max('ID');
    	$cate = DB::table('categoryfilm')
        		->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
        		->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
        		->where('categoryfilm.ID', $ID)
        		->select('category.Name','categoryfilm.ID')
        		->first();
    	return response()->json([
    		'cate' => $cate
    	]);
    }

    public function DeleteCate($ID){
    	$category_id = DB::table('categoryfilm')->where("ID", $ID)->first();
    	DB::table('categoryfilm')->where("ID", $ID)->delete();
    	$cate = DB::table('category')->where("ID", $category_id->Category_ID)->first();
    	return response()->json([
    		'cate' => $cate
    	]);
    }

    public function GetCategoryFilmByID($Film_ID)
    {
    	# code...
    	$cate = DB::table('categoryfilm')
        		->join('film', 'film.ID', '=', 'categoryfilm.Film_ID')
        		->join('category', 'category.ID', '=', 'categoryfilm.Category_ID')
        		->where('categoryfilm.Film_ID', $Film_ID)
        		->select('category.Name','categoryfilm.ID', 'categoryfilm.Category_ID')
        		->get();
       	$film = DB::table('film')->where('ID', $Film_ID)->first();
        return response()->json([
    		'cate' => $cate,
    		'film' => $film
    	]);
    }

    // public function DeleteFilm($ID){

		

	// 	// $isExit =  DB::table('film')->where("ID", $ID)->firt();
    //     //  if($isExit >0){
    //     //     return back()->with('error','You cannot delete it.Because The user account is related to the ticket list!!!');
    //     //  }else{
    //     //     DB::table('film')->where("ID", $ID)->delete();
    //     //     return back()->with('success','Record deleted successfully!!');
    //     //  }
	// 	DB::table('comment')->ưhere("film")


    //     $film = DB::table('film')->where('ID', $ID)->first();
    //     File::delete($film->Image);
    //     DB::table('film')->where("ID", $ID)->delete();
    //     return response()->json([
    //      'success' => 'Record deleted successfully!'
    //  ]);


    // }
	public function DeleteFilm($ID){
		$isExitComment =  DB::table('comment')->where("Film_ID", $ID)->count();
    if($isExitComment >0){
      // return back()->with('error','You cannot delete it.Because The user account is related to the ticket list!!!');
			return response()->json([
				'error' => 'You cannot delete it.Because The user account is related to the ticket list!!!'
			]);
    }else{
      DB::table('film')->where("ID", $ID)->delete();
			return response()->json([
				'success' => 'Record deleted successfully!!'
			]);
      // return back()->with('success','Record deleted successfully!!');
    }

    // DB::table('comment')->where("film_id", $ID)->delete();
    // $film = DB::table('film')->where('ID', $ID)->first();
    // File::delete($film->Image);
    // DB::table('film')->where("ID", $ID)->delete();
    // return response()->json([
    //   'success' => 'Record deleted successfully!'
    // ]);
}

    public function ChangeStatus($ID){
    	$film = DB::table('film')->where('ID', $ID)->first();
    	$status = "";
    	if($film->Status == true)
    		$status = false;
    	else
    		$status = true;
    	DB::update('update film set Status = ? where ID = ?', [$status, $ID]);
    	return response()->json([
    		'success' => 'Record deleted successfully!'
    	]);
    }

}

function Str_Metatitle($str) {
    	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    	$str = preg_replace("/(đ)/", 'd', $str);

    	$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
    	$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    	$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
    	$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    	$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    	$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    	$str = preg_replace("/(Đ)/", 'd', $str);
    	$str = preg_replace("/(' ')/", '-', $str);
        $str = str_replace(" ","-",trim($str));
    	return $str;
    }

    //Get link 
        function GetLink($str)
        {
            $link = "";
            $dem = 1;
            for($i = count($str) - 1; $i >= 0; $i--)
            {
                if ($dem <= 11)
                {
                    $link += $str[$i];
                    $dem++;
                }
                else
                {
                    break;
                }
            }
            
            return strrev($link); 
        }
?>
