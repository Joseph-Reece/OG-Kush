<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'place_id',
        'category_id',
        'price',
        'image',
    ];

   public function productCategories()
   {
       return $this->hasOne(ProductCategory::class, 'id', 'category_id');
   }

   public function place()
   {
       return $this->hasOne(Place::class, 'id', 'place_id');
   }

   
}
