<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    // use HasFactory;
    protected $table = 'products';

    public function images()
  {
    return $this->hasMany(ProductsImages::class, 'product_id','id');
  }

   public function category()
  {
    return $this->belongsTo(ProductCategories::class);
  }
}
