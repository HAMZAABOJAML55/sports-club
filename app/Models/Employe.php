<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Employe extends Authenticatable
{
    use HasTranslations;
    public $translatable =['name'];
    use HasFactory;
    protected $table='employes';

    protected $guarded = [''];


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

}
