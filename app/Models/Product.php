<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Product extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['slug', 'name'];
    protected $fillable = ['slug', 'name'];
    protected $table = 'products';
    public $timestamps = true;    

    public function product_skus()
    {
        return $this->hasMany(ProductSku::class,'product_id')->orderBy('color_id', 'desc')->orderBy('size_id', 'asc');
    }

    public function category()
    {
      return $this->belongsTo(Category::class,'category_id');
    }
}
