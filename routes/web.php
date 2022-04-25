<?php

use Illuminate\Support\Facades\Route;

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

//インデックス表示
Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

//ログインページ表示
Route::get('/login', function () {
    return view('login');
});

//犬情報取得 → signupページ表示
Route::get('/signup','PetController@dog');

//ユーザのみアクセス許可
Route::group(['middleware' => ['auth']], function () {
  Route::get('/main','PetController@items')->name('main')->middleware(auth::class);
  Route::get('/mypage','PetController@mypage');
  Route::get('/user','PetController@userPage');
  Route::get('/users','PetController@users');
  Route::get('/view','PetController@itemView');
});

//オーナーのみアクセス許可
Route::group(['middleware' => ['loginUserCheck']], function () {
  Route::get('/owner_main','PetController@itemsOwner');
  Route::get('/item_register','PetController@itemCategory');

});

Route::post('/like_item','PetController@like_item');

Route::get('/review_edit', function () {
    return view('review_edit');
});

Route::get('/review_edit','PetController@review_edit');

Route::post('/review_confirm', function () {
    return view('review_confirm');
});

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/re_confirm','PetController@revieweditVaridate');

Route::post('/review_confirm','PetController@reviewVaridate');


// Route::get('/signup', function () {
//     return view('signup');
// });


//確認ページ表示
Route::get('/confirm', function () {
    return view('confirm');
});



Route::post('/view','PetController@reviewPost');

Route::post('/view_edit','PetController@revieweditPost');

Route::get('/review', function () {
    return view('review');
});

//Route::get('/', function () {
//    return view('item_edit');
//});

Route::get('/item_edit','PetController@itemEdit');
Route::post('/item_edit_confirm','PetController@itemEditVari');
Route::post('/itemedit','PetController@itemEditPost');
Route::get('/review','PetController@reView');

//Route::post('review_post','PetController@reviewPost');

Route::post('mypageEdit','PetController@mypageEdit');

//バリデーション処理
Route::post('/confirm','PetController@varidate');

//アイテム投稿バリデーション
Route::post('/r_confirm','PetController@itemPostvari');

Route::post('/itempost','PetController@itemPost');

Route::post('item_delete','PetController@itemDelete');

Route::post('user_delete','PetController@userDelete');


//新規登録処理→メインページ飛ぶ
Route::post('/main','PetController@signUp');



//Route::get('view/{$item->id}','PetController@itemView');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
