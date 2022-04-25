<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $fillable = ['id','user_id','item_id','updated_at', 'created_at'];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

}
