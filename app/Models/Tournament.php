<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [''];


    public function player()
    {
        return $this->belongsToMany(Player::class, 'player_has_tournament', 'tournament_id', 'regions_id');
    }
    public function coach()
    {
        return $this->belongsToMany(Coach::class, 'coach_has_tournament', 'tournament_id', 'regions_id');
    }

}
