<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tournament extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable =['name'];
    protected $guarded = [''];


    public function player()
    {
        return $this->belongsToMany(Player::class, 'player_has_tournament', 'tournament_id', 'player_id');
    }
    public function coach()
    {
        return $this->belongsToMany(Coach::class, 'coach_has_tournament', 'tournament_id', 'coach_id');
    }
    public function tournamentType()
    {
       return $this->belongsTo(TournamentType::class,'tournament_type_id','id');
    }
    public function Prize()
    {
        return $this->belongsTo(Prize::class,'prize_type_id','id');
    }
    public function ChampionshipLevel()
    {
        return $this->belongsTo(ChampionshipLevel::class,'championship_levels_id','id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}
