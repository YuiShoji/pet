<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Review;


class Item extends Model{
  use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
	'other',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('item_id', $this->id)->first() !==null;
    }

}

