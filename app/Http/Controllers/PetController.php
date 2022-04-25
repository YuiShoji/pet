<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Dog;
use App\Models\User;
use App\Models\Item;
use App\Models\Review;
use App\Models\Like;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class PetController {
  public function dog() {
    $dogs = Dog::all();
    return view('signup',compact('dogs'));
  }

  public function varidate(Request $request) {
    $rules = [
        'name' => 'required|max:10|unique:users,name',
        'email' => 'required|email:rfc,dns|unique:users,email',
        'password' => 'required|min:8|max:16|regex:/^(?=.*?[a-z])(?=.*?\d)[a-z\d]+$/i',
        'password_confirm' => 'required|same:password',
    ];

    $error_message = [
      'name.required' => 'Nameは必須入力です。10文字以内でご入力ください。',
      'name.max' => '10文字以内でご入力ください。',
      'name.unique' => 'このNameはすでに使われています。',
      'email.required' => 'メールアドレスは必須入力です。',
      'email.email' => 'メールアドレスは正しくご入力ください。',
      'email.unique'=> 'このメールアドレスはすでに登録されています。',
      'password.required' => 'パスワードは必須入力です。',
      'password.max' => 'パスワードは8文字以上16文字以内でご入力ください。',
      'password.min' => 'パスワードは8文字以上16文字以内でご入力ください。',
      'password.regex' => 'パスワードは英数字混合で設定してください。記号は使用できません。',
      'password_confirm.required' => '再度パスワードをご入力ください。',
      'password_confirm.same' => 'パスワードが一致しません。',
    ];

    $validator = Validator::make($request->all(), $rules, $error_message);

    if($validator->fails()){
      return redirect('signup')
        ->withErrors($validator)
        ->withInput();
    }
    //ドッグIDを取得
    $dog_id = $request->get('pet_id');
    //ドッグIDから犬種を取得
    $dogs = Dog::find($dog_id);
    //確認画面へ移動
    return view('confirm',compact('dogs'))->with($validator->validate());
  }

//会員登録
  public function signUp(Request $request){
    $save = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'image' => false,
      'dog_id' => $request->dog_id,
      'remember_token'=>false,
      'owner'=>false
    ]);
	return redirect('/login')->with('flash_message', '登録が完了しました。ログインしてください。');
  }

//アイテム情報取得
  public function items(Request $request) {
    if(empty($request->search_category_id) or $request->search_category_id == 0){

      $reviews = Review::query()
        ->select(DB::raw('count(item_id) as r_count'),'item_id')
        ->groupBy('item_id')
        ->toSql();

      $likes = Like::query()
        ->select(DB::raw("count(likes.item_id) as l_count"),'item_id')
        ->groupBy('item_id')
        ->toSql();

      $items = Item::query()
        ->orderBy('items.id','desc')
        ->leftjoin(DB::raw('('.$reviews.') AS r'), 'r.item_id','=','items.id')
        ->leftjoin(DB::raw('('.$likes.') AS l'), 'l.item_id','=','items.id')
        ->select('items.id','items.name','items.price','r_count','l_count',)
        ->where('items.del_flg','=','0')
        ->paginate(12);

//    $items = Item::orderBy('items.id','desc')
//      ->select('items.id','items.name','items.price',DB::raw("count(likes.item_id) as count, count(reviews.item_id) as review_count"))
//      ->leftjoin('categories','categories.id','=','items.category_id')
//      ->leftjoin('likes','likes.item_id','=','items.id')
//      ->leftjoin('reviews','reviews.item_id','=','items.id')
//      ->where('items.del_flg','=','0')
//      ->groupBy('items.id','items.name','items.price')
//      ->paginate(12);

      $categories = Category::all();
      $count = Item::where('items.del_flg','=','0')
              ->count();
      $cate_id = $request->search_category_id;
      return view('main',compact('items','categories','cate_id','count'));
    }

    //カテゴリ絞込結果
    $reviews = Review::query()
      ->select(DB::raw('count(item_id) as r_count'),'item_id')
      ->groupBy('item_id')
      ->toSql();

    $likes = Like::query()
      ->select(DB::raw("count(likes.item_id) as l_count"),'item_id')
      ->groupBy('item_id')
      ->toSql();

    $items = Item::query()
      ->orderBy('items.id','desc')
      ->leftjoin(DB::raw('('.$reviews.') AS r'), 'r.item_id','=','items.id')
      ->leftjoin(DB::raw('('.$likes.') AS l'), 'l.item_id','=','items.id')
      ->select('items.id','items.name','items.price','r_count','l_count')
      ->where('items.category_id','=', $request->search_category_id)
      ->where('items.del_flg','=','0')
      ->paginate(12);

//    $items = Item::orderBy('items.id','desc')
//      ->select('items.id','items.name','items.price',DB::raw("count(likes.item_id) as count"))
//      ->leftjoin('categories','categories.id','=','items.category_id')
//      ->leftjoin('likes','likes.item_id','=','items.id')
//      ->where('items.category_id','=', $request->search_category_id)
//      ->where('items.del_flg','=','0')
//      ->groupBy('items.id','items.name','items.price')
//      ->paginate(12);
    $categories = Category::all();
    $cate_id = $request->search_category_id;
    $count = $items->count();
    return view('main',compact('items','categories','cate_id','count'))->with('message', '');
  }

//ownerページアイテム情報取得
  public function itemsOwner(Request $request) {
    if(empty($request->search_category_id) or $request->search_category_id == 0){
      $reviews = Review::query()
        ->select(DB::raw('count(item_id) as r_count'),'item_id')
        ->groupBy('item_id')
        ->toSql();

      $likes = Like::query()
        ->select(DB::raw("count(likes.item_id) as l_count"),'item_id')
        ->groupBy('item_id')
        ->toSql();

      $items = Item::query()
        ->orderBy('items.id','desc')
        ->leftjoin(DB::raw('('.$reviews.') AS r'), 'r.item_id','=','items.id')
        ->leftjoin(DB::raw('('.$likes.') AS l'), 'l.item_id','=','items.id')
        ->select('items.id','items.name','items.price','r_count','l_count')
        ->where('items.del_flg','=','0')
        ->paginate(12);

      $count = Item::where('items.del_flg','=','0')
                ->count();
      $categories = Category::all();
      $cate_id = $request->search_category_id;
      return view('owner_main',compact('items','categories','cate_id','count'));
    }

    //カテゴリ絞込結果
    $reviews = Review::query()
      ->select(DB::raw('count(item_id) as r_count'),'item_id')
      ->groupBy('item_id')
      ->toSql();

    $likes = Like::query()
      ->select(DB::raw("count(likes.item_id) as l_count"),'item_id')
      ->groupBy('item_id')
      ->toSql();

    $items = Item::query()
      ->orderBy('items.id','desc')
      ->leftjoin(DB::raw('('.$reviews.') AS r'), 'r.item_id','=','items.id')
      ->leftjoin(DB::raw('('.$likes.') AS l'), 'l.item_id','=','items.id')
      ->select('items.id','items.name','items.price','r_count','l_count')
      ->where('items.category_id','=', $request->search_category_id)
      ->where('items.del_flg','=','0')
      ->paginate(12);

    $count = $items->count();
    $categories = Category::all();
    $cate_id = $request->search_category_id;
    return view('owner_main',compact('items','categories','cate_id','count'));
  }

//詳細ページ用
  public function itemView(Request $request) {
    $reviews = Review::where('item_id','=', $request->item_id)
      ->join('users','user_id','=','users.id')
      ->join('dogs','users.dog_id','=','dogs.id')
      ->select('reviews.id as review_id','review','star','users.name','users.id as user_id','dogs.name as dog_name')
      ->where('users.del_flg','=','0')
      ->orderBy('reviews.updated_at','desc')
      ->get();
    $itemView = Item::find($request->item_id);
    $c_name = Item::select('categories.name as c_name')
      ->leftjoin('categories','categories.id','=','items.category_id')
      ->where('items.id','=',$request->item_id)
      ->get();
    $itemlikes = Item::withCount('likes')->orderBy('id', 'desc')->find($request->item_id);
    $alreadylike = Like::where('user_id',Auth::id())->where('item_id', '=', $request->item_id)->get();
    $count = $reviews->count();
    //get(id)->where('user_id','=',Auth::id())->where('item_id', '=', $request->item_id);
    return view('view',compact('itemView','reviews','c_name','itemlikes','alreadylike','count'));
  }

//レビュー投稿ページに表示する用
  public function reView(Request $request){
    $itemView = Item::find($request);
    $c_name = Item::select('categories.name as c_name')
      ->leftjoin('categories','categories.id','=','items.category_id')
      ->where('items.id','=',$request->item_id)
      ->get();
    return view('review',compact('itemView','c_name'));
  }

  //レビュー編集ページに表示する用
  public function review_edit(Request $request){

    $review = Review::find($request->review_id);
    $itemView = Item::find($request->item_id);
    if(Auth::id() == $review->user_id){
    return view('review_edit',compact('itemView','review'));
  }
  return back();
  }

  //レビュー投稿のバリデーション・確認画面遷移
  public function reviewVaridate(Request $request) {
    $rules = [
        'review' => 'required|min:10|max:250|',
        'rate' => 'required'
    ];

    $error_message = [
      'review.required' => 'コメントは必須入力です。',
      'review.max' => 'コメントは250字以内でご入力ください。',
      'review.min' => 'コメントは10字以上ご入力ください。',
    ];

    $validator = Validator::make($request->all(), $rules, $error_message);
    $item_id = $request->item_id;
    $c_name = $request->c_name;
    $user_id = Auth::id();
    return view('review_confirm',compact('item_id','user_id','c_name'))->with($validator->validate())
            ->withInput($request);
  }

  //レビュー編集のバリデーション・確認画面遷移
  public function revieweditVaridate(Request $request) {
    $rules = [
        'review' => 'required|min:10|max:250|',
        'rate' => 'required'
    ];

    $error_message = [
      'review.required' => 'コメントは必須入力です。',
      'review.max' => 'コメントは250字以内でご入力ください。',
      'review.min' => 'コメントは10字以上ご入力ください。',
    ];

    $validator = Validator::make($request->all(), $rules, $error_message);
    $item_id = $request->item_id;
    $c_name = $request->c_name;
    $review_id = $request->review_id;
    $user_id = Auth::id();
    return view('re_confirm',compact('item_id','user_id','c_name','review_id'))->with($validator->validate())
            ->withInput($request);
  }

  //編集
  public function revieweditPost(Request $request) {
    $reviewPost = Review::where('id','=',$request->review_id)
    ->update([
      'star' => $request->star,
      'review' => $request->review,
    ]);

    return redirect()->action('PetController@itemView', ['item_id' => $request->item_id,'c_name' => $request->c_name]);
  }

  //投稿
  public function reviewPost(Request $request) {
    $reviewPost = Review::create([
      'user_id' => Auth::id(),
      'item_id' => $request->item_id,
      'star' => $request->star,
      'review' => $request->review,
    ]);
    return redirect()->action('PetController@itemView', ['item_id' => $request->item_id,'c_name' => $request->c_name]);
  }

  public function users(Request $request){
    if(empty($request->search_pet_id) or $request->search_pet_id == 0){
      $users = User::join('dogs','dog_id','=','dogs.id')
        ->select('users.name','users.id','dogs.name as d_name','users.email')
        ->where('users.del_flg','=','0')
        ->where('users.owner','=','0')
        ->paginate(8);
      $dogs = Dog::all();
      $pet_id = $request->search_pet_id;
      $count = User::where('users.del_flg','=','0')
                    ->where('users.owner','=',"0")
                    ->count();

      return view('users',compact('users','dogs','pet_id','count'));
    }
    //犬種での絞込用
    $users = User::join('dogs','dog_id','=','dogs.id')
      ->select('users.name','users.id','dogs.name as d_name')
      ->where('dog_id','=', $request->search_pet_id)
      ->paginate(8);
    $dogs = Dog::all();
    $pet_id = $request->search_pet_id;
    $count = $users->count();

    return view('users',compact('users','dogs','pet_id','count'));

  }

//マイページ表示
  public function mypage(){
      $user= Auth::user();
      $mypage = User::join('dogs','dog_id','=','dogs.id')
        ->select('users.name','dogs.name as d_name')
        ->get();
      $mypagedogs = Dog::all();
      $review_item = Review::join('items','item_id','=','items.id')
        ->where('user_id','=',$user->id)
        ->where('items.del_flg','=','0')
        ->select('item_id','items.name as item_name','star','reviews.updated_at','review')
        ->get();
      $likes_item = Like::leftjoin('items','item_id','=','items.id')
        ->where('user_id','=',$user->id)
        ->where('items.del_flg','=','0')
        ->get();
      return view('mypage',compact('mypage','user','mypagedogs','review_item','likes_item'));
  }

  public function mypageEdit(Request $request){
    //ログインしているユーザーの情報を取得
    $user = Auth::user();
    // バリデーション
     $request->validate([
        'pic' => 'file|image|mimes:jpeg,png,jpg|max:2048',  //画像ファイルのバリデーション
        'name' => 'required|string|max:10|unique:users,name,'.$user->id.',id',
        'email' => 'required|string|max:255|email|unique:users,email,'.$user->id.',id'
     ],
     [
       'name.required' => 'Nameは必須入力です。',
       'name.unique' => 'このNameはすでに使用されています。',
       'name.max' => 'Nameは10文字以内でご入力ください。',
       'email.required' => 'Emailは必須入力です。'
     ]);

     //画像ファイル保存
     if(!empty($request->pic)){
       $img_url = $request->pic->storeAs('public/users', Auth::id() . '.jpg');
      }
     //DB更新処理
      $user->name = $request->name;
      $user->email = $request->email;
      $user->dog_id = $request->pet_id;
      //$user->pic = str_replace('public/', 'user/', $img_url);
      $user->update();

      // マイページへリダイレクト
      return redirect('/mypage')->with('flash_message', '変更が完了しました');
  }

//ユーザ情報
  public function userPage(Request $request){
    //アクセス先が自分のページだったらマイページにリダイレクト
      if(Auth::id() == $request->id){
        return redirect('/mypage');
      }
      $userpage = User::join('dogs','dog_id','=','dogs.id')
        ->select('users.id','users.name','dogs.name as dog_name','created_at')
        ->where('users.id','=',$request->id)
        ->first();
      //$mypagedogs = Dog::all();
      $review_item = Review::join('items','item_id','=','items.id')
        ->where('user_id','=',$request->id)
        ->where('items.del_flg','=','0')
        ->select('items.id as item_id','items.name as item_name','star','review','reviews.updated_at')
        ->get();
        $likes_item = Like::leftjoin('items','item_id','=','items.id')
          ->where('user_id','=',$request->id)
          ->where('items.del_flg','=','0')
          ->get();

      return view('user',compact('userpage','review_item','likes_item'));
  }

//いいね機能
  public function like_item(Request $request)
    {
        //ステータスが0のとき[いいね未]はデータベースに情報を保存
         if ( $request->input('like_item') == 0) {
             Like::create([
                 'item_id' => $request->input('item_id'),
                  'user_id' => auth()->user()->id,
             ]);
          //ステータスが1のとき[いいね済]はデータベースの情報を削除
         } elseif ( $request->input('like_item')  == 1 ) {
             Like::where('item_id', "=", $request->input('item_id'))
                ->where('user_id', "=", auth()->user()->id)
                ->delete();
         }
        //いいねカウント
        //likes_countはwithCountメソッドとセットの関係にあります。
        $item_likes_count = Item::withCount('likes')->findOrFail($request->input('item_id'))->likes_count;
         return response()->json(['item_likes_count' => $item_likes_count,'like_item'=> $request->input('like_item')]);
    }

  //アイテム登録ページ
  public function itemCategory(){
    $itemcategory = Category::all();
    return view('item_register',compact('itemcategory'));
  }

  public function itemPostvari(Request $request){
    // バリデーション
     $request->validate([
        'pic' => 'file|image|mimes:jpeg,png,jpg|max:2048',  //画像ファイルのバリデーション
        'item_name' => 'required|string|max:20|',
        'price' => 'required|numeric|',
        'item_other' => '|max:200|',
     ],
     [
       'item_name.required' => '品名は必須入力です。',
       'item_name.max' => '品名は20文字以内で入力してください。',
       'price.required' => '価格は必須入力です。',
       'price.numeric' => '価格は半角数字でご入力ください。',
       'item_other.max' => 'その他情報は200文字以内でご記入ください。'

     ]);

     //カテゴリIDからカテゴリ名を取得
     $item_cate = Category::find($request->category_id);
     $post_data = $request;

     //画像ファイル保存
     $item_id = Item::count();
     $item_id_toroku = $item_id+1;
     $img_url = '';
     if(!empty($request->pic)){
       $request->pic->storeAs('public/items/tmp', $item_id_toroku . '.jpg');
       $img_url = $item_id_toroku . '.jpg';
      }
     //確認画面へ移動
     return view('r_confirm',compact('item_cate','post_data','img_url'));
  }

  public function itemPost(Request $request){
       //DB更新処理
      if(!empty($request->img_url)){
        rename("storage/items/tmp/" . $request->img_url, "storage/items/" . $request->img_url );
       \File::cleanDirectory(public_path() . "public/items/tmp");
     }

       $itemPost = Item::create([
         'name' => $request->item_name,
         'price' => $request->price,
         'category_id' => $request->category_id,
         'other' => $request->item_other,
       ]);
       return redirect('/owner_main');
     }

   public function itemEdit(Request $request){
     $item = Item::find($request->item_id);
     $category = Category::all();
     return view('item_edit',compact('item','category'));
   }

   public function itemEditvari(Request $request){
     // バリデーション
      $request->validate([
         'pic' => 'file|image|mimes:jpeg,png,jpg|max:2048',  //画像ファイルのバリデーション
         'item_name' => 'required|string|max:20|',
         'price' => 'required|numeric|',
         'item_other' => 'max:200|',
      ],
      [
        'item_name.required' => '品名は必須入力です。',
        'item_name.max' => '品名は20文字以内で入力してください。',
        'price.required' => '価格は必須入力です。',
        'price.numeric' => '価格は半角数字でご入力ください。',
        'item_other.max' => 'その他情報は200文字以内でご記入ください。'
      ]);

      //カテゴリIDからカテゴリ名を取得
      $item_cate = Category::find($request->category_id);
      $post_data = $request;

      //画像ファイル保存
      $img_url = '';
      if(!empty($request->pic)){
        $request->pic->storeAs('public/items/tmp', $request->item_id . '.jpg');
        $img_url = $request->item_id . '.jpg';
       }
      //確認画面へ移動
      return view('item_edit_confirm',compact('item_cate','post_data','img_url'));
   }

   public function itemEditPost(Request $request){
        //DB更新処理
       if(!empty($request->img_url)){
         rename("storage/items/tmp/" . $request->img_url, "storage/items/" . $request->img_url );
        \File::cleanDirectory(public_path() . "public/items/tmp");
        }

        Item::where('id','=',$request->item_id)
        ->update([
          'name' => $request->item_name,
          'price' => $request->price,
          'category_id' => $request->category_id,
          'other' => $request->item_other,
        ]);
        return redirect('/owner_main');
      }

    //アイテム削除
    public function itemDelete(Request $request){
      Item::where('id','=',$request->item_id)
        ->update([
          'del_flg' => "1"
        ]);
      return redirect('/owner_main');
    }

//ユーザ削除
    public function userDelete(Request $request){
      User::where('id','=',$request->user_id)
      ->update([
        'del_flg' => "1"
    ]);
      Review::where('user_id','=',$request->user_id)
        ->delete();
      Like::where('user_id','=',$request->user_id)
          ->delete();


      return redirect('/users');

    }

}
?>
