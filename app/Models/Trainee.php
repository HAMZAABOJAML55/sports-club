<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Trainee extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable =['name'];
    protected $guarded = [''];

    public function TrainingGroup()
    {
       return $this->belongsTo(TrainingGroup::class,'training_group_id','id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}

