<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Food extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable =['name'];
    protected $table ='food';

    protected $guarded = [''];

    public function foodsystem()
    {
      return  $this->belongsTo(Foodsystem::class,'foodsystem_id','id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}
