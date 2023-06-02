<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function player()
    {
        $this->belongsTo(Player::class,'player_id','id');
    }
    public function location()
    {
        $this->belongsTo(Location::class,'location_id','id');
    }
    public function subscripe()
    {
        $this->belongsTo(Subscripe::class,'subscripe_id','id');
    }
    public function nationality()
    {
        $this->belongsTo(Nationality::class,'nationality_id','id');
    }

}
