<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{


    public function toArray($request)
    {
        // Get all attributes of the model
        $attributes = $this->getAttributes();

        // List of attributes to exclude
        $excludedAttributes = ['created_at', 'updated_at'];

        // Remove excluded attributes from the array
        foreach ($excludedAttributes as $attribute) {
            unset($attributes[$attribute]);
        }
        // Merge related data
        $relatedData = [
            'productType' => $this->productType,
            'images'=>ImagesProductResource::collection($this->images)
        ];

        // Merge attributes and related data
        return array_merge($attributes, $relatedData);
    }
}
