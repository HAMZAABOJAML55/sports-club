<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Sub_Location extends Model
{
    use HasTranslations;
    public $translatable =['name'];
    use HasFactory;
    protected $table='sub_locations';
    protected $guarded = [''];
}
