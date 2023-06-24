<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Player extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable ,HasTranslations;
    public $translatable =['name'];
//    protected $table='players';
    protected $guarded = [''];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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


    public function employment_type()
    {
        return  $this->belongsTo(Employment_type::class,'employment_type_id','id');
    }

    public function profs_degree()
    {
        return   $this->belongsTo(Prof::class,'profs_id','id');
    }
    public function subtype()
    {
        return  $this->belongsTo(Subtype::class,'subtype_id','id');
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
        return  $this->belongsTo(Coach::class,'coachs_id','id');
    }

    public function team()
    {
        return $this->belongsToMany(Team::class, 'player_has_team', 'player_id', 'team_id');
    }

    public function tournament()
    {
        return $this->belongsToMany(Tournament::class, 'player_has_tournament', 'player_id', 'tournament_id');
    }
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}


