<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
    // function subcategory()
    // {
    //     return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    // }
}
