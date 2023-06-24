<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable =['name'];
    protected $guarded = [''];


    public function productType()
    {
        return $this->belongsTo(ProductType::class,'product_types_id','id');
    }

    public function image()
    {
        $this->belongsTo(Image::class,'image_id','id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'center_id');
    }
}
