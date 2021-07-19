<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use File;
class FoodDrinkController extends Controller
{
    //
    public function Index(){
    	$query = DB::table('food_drink')
                        ->orderBy('Name', 'desc')
            			->paginate(10);
        
        return view('admin.food_drink.index')->with([
    										'query'=> $query
    									]);
    }


    public function AddFoodDrink(Request $request){
    	$Name = $request->get("Name");
    	$Price = $request->get("Price");
    	$Description = $request->get("Description");
    	
    	$hinhanh = "";
    	if ($request->hasFile('Image')){
                $img_hinhanh = $request->file("Image");

                // Thư mục upload
                $uploadPath = public_path('assets/images/cinema/'); // Thư mục upload
            
                // Bắt đầu chuyển file vào thư mục
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();
            }

    	DB::insert('insert into food_drink 
    		(Name, Image, Price, Description) 
    		values (?, ?, ?, ?)', 
    		[$Name, $hinhanh, $Price, $Description]);


    	Session::flash('message', 'Add corn and water successfully.');
    	return redirect('/Admin/FoodDrink');
    	
    }

    public function GetFoodDrinkByID($ID)
    {
    	# code...
    	$food_drink = DB::table('food_drink')->where('ID', $ID)->first();
        return response()->json([
    		'food_drink' => $food_drink
    	]);
    }

    public function EditFoodDrink(Request $request){
    	$ID = $request->get("ID");
    	$Name = $request->get("Name");
    	$Price = $request->get("Price");
    	$Description = $request->get("Description");

    	$hinhanh = "";
    	if ($request->hasFile('Image')){
    		$img_hinhanh = $request->file("Image");

                // Thư mục upload
                $uploadPath = public_path('assets/images/cinema/'); // Thư mục upload

                // Bắt đầu chuyển file vào thư mục
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();

                $img = DB::table('food_drink')->where('ID', $ID)->first();
                if($img->Image != $hinhanh){//Nếu có sửa file ảnh, thì tiến hành xóa ảnh cũ và thêm ảnh mới
                	File::delete($img->Image);
                    // $img_hinhanh->move($uploadPath, $hinhanh->getClientOriginalName());
                	DB::update('update food_drink set Image = ? where ID = ?', [$hinhanh, $ID]);
                }
            }

    	DB::update('update food_drink set Name = ?, Price = ?, Description = ?  where ID = ?', 
                [$Name, $Price, $Description, $ID]);


    	Session::flash('message', 'Repair corn and water successfully.');
    	return redirect('/Admin/FoodDrink');
    }

    public function DeleteFoodDrink($ID){
        $food_drink = DB::table('food_drink')->where('ID', $ID)->first();
        File::delete($food_drink->Image);

        DB::table('book_fd')->where("FoodDrink_ID", $ID)->delete();
        DB::table('food_drink')->where("ID", $ID)->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }
}
