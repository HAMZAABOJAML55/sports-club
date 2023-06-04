<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Employment_type extends Model
{
    use HasTranslations;
    public $translatable =['name'];
    use HasFactory;
    protected $table='employmenttypes';
}
