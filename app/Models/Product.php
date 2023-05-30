<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [''];

    
    public function player()
    {
        $this->belongsTo(Player::class,'player_id','id');
    }

    public function image()
    {
        $this->belongsTo(Image::class,'image_id','id');
    }
}
