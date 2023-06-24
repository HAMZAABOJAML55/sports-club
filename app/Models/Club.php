<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Club extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[''];

    public function users()
    {
        return $this->belongsTo(User::class, 'club_id', 'id');
    }
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

    public function admins()
    {
        return $this->hasMany(User::class, 'club_id');
    }

    public function accountings()
    {
        return $this->hasMany(Accounting::class, 'club_id');
    }

    public function coachs()
    {
        return $this->hasMany(Coach::class, 'club_id');
    }

    public function employees()
    {
        return $this->hasMany(Employe::class, 'club_id');
    }

    public function foods()
    {
        return $this->hasMany(Food::class, 'club_id');
    }


    public function players()
    {
        return $this->hasMany(Player::class, 'club_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'club_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'club_id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'club_id');
    }

    public function tournaments()
    {
        return $this->hasMany(Tournament::class, 'club_id');
    }
    public function championshipResult()
    {
        return $this->hasMany(ChampionshipResult::class, 'club_id');
    }

    public function Training()
    {
        return $this->hasMany(Trainee::class, 'club_id');
    }

    public function subscribes()
    {
        return $this->belongsTo(Subscribe::class, 'subscribes_id');
    }
}
