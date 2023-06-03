<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Coach extends Authenticatable
{
    use HasTranslations;
    public $translatable =['name'];
    use HasFactory;
    protected $guarded = [''];
    protected $table='coachs';

    protected $casts= [
        'phone'=>'array',
        'email'=>'array',
    ];

    public function player()
    {
        $this->belongsTo(Player::class,'player_id','id');
    }

    public function location()
    {
        $this->belongsTo(Location::class,'location_id','id');
    }

    public function nationality()
    {
        $this->belongsTo(Natinality::class,'nationality_id','id');
    }

    public function team()
    {
        return $this->belongsToMany(Team::class, 'player_has_team', 'coach_id', 'team_id');
    }
    public function tournament()
    {
        return $this->belongsToMany(Tournament::class, 'player_has_tournament', 'coach_id', 'tournament_id');
    }
}

