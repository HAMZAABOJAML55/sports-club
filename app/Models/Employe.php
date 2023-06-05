<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Employe extends Authenticatable
{
    use HasTranslations;
    public $translatable =['name'];
    use HasFactory;
    protected $table='employes';

    protected $guarded = [''];



}
