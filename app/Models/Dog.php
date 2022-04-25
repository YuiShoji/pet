<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model{
  use HasFactory;
  protected $fillable = ['id','name'];

      public function getLists()
    {
        $dogs = Dog::pluck('name', 'id');

        return $dogs;
    }
    //「犬種(dog)はたくさんのユーザ(user)をもつ」というリレーション関係を定義する
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

//class User extends Model{
//  use HasFactory;
//  protected $fillable = ['name','email','password','image','dog_id'];
//}

class Item extends Model{
  use HasFactory;
  protected $fillable = ['id','name','category_id','price','other','image','del_flg'];
}
