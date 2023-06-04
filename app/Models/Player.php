<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Player extends Authenticatable
{
    use HasTranslations;
    public $translatable =['name'];
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

    public function employment_type()
    {
        return  $this->belongsTo(Employment_type::class,'employment_type_id','id');
    }

    public function profs_degree()
    {
        return   $this->belongsTo(Prof::class,'profs_id','id');
    }

    public function location()
    {
        return  $this->belongsTo(Location::class,'location_id','id');
    }
    public function sub_location()
    {
        return $this->belongsTo(Sub_Location::class,'sub_location_id','id');
    }

    public function nationality()
    {
        return  $this->belongsTo(Natinality::class,'nationality_id','id');
    }
    public function gender()
   {
    return $this->belongsTo(Gender::class,'genders_id','id');
   }

    public function coach()
    {
        return  $this->belongsTo(Coach::class,'coach_id','id');
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


