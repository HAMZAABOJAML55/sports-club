<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    use HasFactory;

    protected $guarded = [''];

    protected $players= [
        'phone'=>'array',
        'email'=>'array',
    ];
    public function time()
    {
        $this->belongsTo(Time::class,'time_id','id');
    }
    public function gender()
    {
        $this->belongsTo(Gender::class,'gender_id','id');
    }
    public function location()
    {
        $this->belongsTo(Location::class,'location_id','id');
    }
    public function nationality()
    {
        $this->belongsTo(Nationality::class,'nationality_id','id');
    }
    public function coach()
    {
        $this->belongsTo(Coach::class,'coach_id','id');
    }

    public function team()
    {
        return $this->belongsToMany(Team::class, 'player_has_team', 'player_id', 'team_id');
    }
    public function tournament()
    {
        return $this->belongsToMany(Tournament::class, 'player_has_tournament', 'player_id', 'tournament_id');
    }

}


