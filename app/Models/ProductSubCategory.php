<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    //
    protected $table = 'product_subcategories';

    protected $fillable = [
        'name',
        'product_category_id',
        'thumb'
    ];

    //Relationships

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id', 'id');
    }
}
