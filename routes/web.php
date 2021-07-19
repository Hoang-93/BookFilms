<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

View::composer('layouts._layout', function ($view) {

	$category = DB::table('category')->get();
    $view->with('category', $category);
});


Route::get('/', 'HomeController@index');
Route::get('/phim-dang-chieu.html', 'HomeController@MoviePlay');
Route::get('/phim-sap-chieu.html', 'HomeController@ComingMovie');
Route::get('/the-loai/{Link}/{ID}', 'HomeController@GetFilmByCate');

Route::get('/dang-nhap.html', 'LoginController@Login');
Route::get('/dang-ky.html', 'LoginController@Register');
Route::get('/forgot', 'LoginController@Fotpassword');
Route::get('/doi-mat-khau.html', 'LoginController@ChangePass');
Route::get('/cap-nhat-thong-tin.html', 'LoginController@UpdateUser');

Route::post('/login', 'LoginController@FormLogin');
Route::post('/register', 'LoginController@FormRegister');
Route::post('/forgot', 'LoginController@Fotpassword');
Route::post('/changepass', 'LoginController@FormChangePass');
Route::post('/update', 'LoginController@Update');
Route::get('/lich-su-dat-ve.html', 'LoginController@HistoryTicket');
Route::get('/chi-tiet-ve/{BookTicket_ID}', 'LoginController@DetailTicket');

Route::get('/logout', 'LoginController@logout');

//phim
Route::group(['prefix' => 'phim'], function() {
    //
    Route::get('/{Metatitle}/{ID}', 'FilmController@Detail');

	Route::get('/add-comment/{user_id}/{film_id}/{content}/{rate}', 'FilmController@addComment');
	Route::post('/reply', 'FilmController@addReply');
	Route::get('/{query}', 'FilmController@ListName');
	Route::post('/tim-kiem', 'FilmController@Search');
});

//phim
Route::group(['prefix' => 'book'], function() {
    //
    Route::get('/date-&-time/{ID}', 'BookTicketController@BookDateTime');
    Route::post('/sit', 'BookTicketController@BookSit');
    Route::post('/checkout', 'BookTicketController@BookFoodDrink');
    Route::post('/payment', 'BookTicketController@Payment');
});

//Admin- home
Route::group(['prefix' => '/Admin/Home','namespace' => 'Admin'], function() {
    //
    Route::get('/', 'HomeController@Index');
});


//Admin- film
Route::group(['prefix' => '/Admin/Film','namespace' => 'Admin'], function() {
    //
    Route::get('/MoviePlay', 'FilmController@MoviePlay');
    Route::get('/ComingMovie', 'FilmController@ComingMovie');
    Route::get('/Add', 'FilmController@Add');
    Route::get('/Edit/{ID}', 'FilmController@Edit');
    Route::post('/AddFilm', 'FilmController@AddFilm');
    Route::post('/EditFilm', 'FilmController@EditFilm');
    Route::get('/Delete/{ID}', 'FilmController@DeleteFilm');
    Route::get('/GetCategoryFilmByID/{Film_ID}', 'FilmController@GetCategoryFilmByID');
    Route::get('/DeleteCate/{ID}', 'FilmController@DeleteCate');
    Route::get('/AddCate/{Film_ID}/{Category_ID}', 'FilmController@AddCate');

    Route::get('/changeStatus/{ID}', 'FilmController@ChangeStatus');
});

//Admin- user
Route::group(['prefix' => '/Admin/User','namespace' => 'Admin'], function() {
    //
    Route::get('/', 'UserController@Index');

    Route::get('/changeStatus/{ID}', 'UserController@ChangeStatus');
    Route::get('/Delete/{ID}', 'UserController@DeleteUser');

});

//Admin- ticket
Route::group(['prefix' => '/Admin/Ticket','namespace' => 'Admin'], function() {
    //
    Route::get('/', 'TicketController@Index');

    Route::get('/changeStatus/{ID}', 'TicketController@ChangeStatus');
    Route::get('/Delete/{ID}', 'TicketController@DeleteTicket');
    Route::get('/Detail/{BookTicket_ID}', 'TicketController@Detail');

});

//Admin- feedback
Route::group(['prefix' => '/Admin/Feedback','namespace' => 'Admin'], function() {
    //
    Route::get('/', 'FeedbackController@Index');

    Route::get('/changeStatus/{ID}', 'FeedbackController@ChangeStatus');
    Route::get('/Detail/{Comment_ID}', 'FeedbackController@Detail');

});

//Admin- food_drink
Route::group(['prefix' => '/Admin/FoodDrink','namespace' => 'Admin'], function() {
    //
    Route::get('/', 'FoodDrinkController@Index');
    Route::post('/AddFoodDrink', 'FoodDrinkController@AddFoodDrink');
    Route::post('/EditFoodDrink', 'FoodDrinkController@EditFoodDrink');
    Route::get('/Delete/{ID}', 'FoodDrinkController@DeleteFoodDrink');
    Route::get('/GetFoodDrinkByID/{ID}', 'FoodDrinkController@GetFoodDrinkByID');

});

//Admin- room
Route::group(['prefix' => '/Admin/Room','namespace' => 'Admin'], function() {
    //
    Route::get('/', 'RoomController@Index');
    Route::post('/Edit', 'RoomController@EditRoomDetail');
    Route::post('/Update', 'RoomController@UpdateTicketPrice');
    Route::get('/GetRoomDetailByID/{ID}', 'RoomController@GetRoomDetailByID');
    Route::get('/GetPriceTicket', 'RoomController@GetPriceTicket');

});

//Admin- Admin
Route::group(['prefix' => '/Admin','namespace' => 'Admin'], function() {
    //
    Route::get('/ChangePass', 'AdminController@ChangePass');
    Route::post('/FormChangePass', 'AdminController@FormChangePass');

});
