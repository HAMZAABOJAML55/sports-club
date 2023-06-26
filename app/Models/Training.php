<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Training extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable =['name'];
    protected $guarded = [''];
    protected $table='trainees';

    public function TrainingGroup()
    {
       return $this->belongsTo(TrainingGroup::class,'training_group_id','id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}

