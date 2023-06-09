<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Accounting extends Model
{
    use HasTranslations;
    public $translatable =['name'];
    use HasFactory;
    protected $table='accountings';

    protected $guarded = [''];


    public function player()
    {
        return $this->belongsTo(Player::class,'player_id','id');
    }
    public function coach()
    {
        return $this->belongsTo(Coach::class,'coach_id','id');
    }
    public function Payments_trainees()
    {
        return $this->belongsTo(Paymentstrainee::class,'Payment_trainee_id','id');
    }
    public function subtype()
    {
        return $this->belongsTo(Subtype::class,'subtype_id','id');
    }
}
