<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function section()
    {
        $this->belongsTo(Section::class,'section_id','id');
    }
    public function nationality_()
    {
        $this->belongsTo(Nationality_::class,'nationality_id','id');
    }

}
