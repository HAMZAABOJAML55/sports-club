<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChampionshipResult extends Model
{
    use HasFactory;
    protected $guarded=[''];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}
