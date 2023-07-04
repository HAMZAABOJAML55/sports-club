<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Team extends Model
{
    use HasTranslations;
    public $translatable =['name'];
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
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}
