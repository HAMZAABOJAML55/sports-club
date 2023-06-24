<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subscribe extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable =['name'];
    protected $guarded = [''];
//    public function club()
//    {
//        return $this->belongsTo(Club::class, 'center_id');
//    }
    public function clubs()
    {
        return $this->hasMany(Club::class, 'subscribes_id');
    }
}
