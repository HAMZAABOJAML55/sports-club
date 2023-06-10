<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Coach extends Authenticatable implements JWTSubject
{
    use HasTranslations;
    public $translatable =['name'];
    use HasFactory;
    protected $table='coachs';
    protected $guarded = [''];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
    }

    public function employment_type()
    {
        return $this->belongsTo(Employment_type::class, 'employment_type_id', 'id');
    }

    public function profs_degree()
    {
        return $this->belongsTo(Prof::class, 'profs_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function sub_location()
    {
        return $this->belongsTo(Sub_Location::class, 'sub_location_id', 'id');
    }

    public function nationality()
    {
        return $this->belongsTo(Natinality::class, 'nationality_id', 'id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'genders_id', 'id');
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

