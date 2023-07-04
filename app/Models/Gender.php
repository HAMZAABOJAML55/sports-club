<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory; 
    use HasTranslations;
    protected $guarded = [''];
   


    public $translatable =['name'];
    
    



}
