<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function player()
    {
        return $this->belongsToMany(Player::class, 'player_has_team', 'team_id', 'player_id');
    }
    public function coach()
    {
        return $this->belongsToMany(Coach::class, 'coach_has_team', 'team_id', 'coach_id');
    }
}
