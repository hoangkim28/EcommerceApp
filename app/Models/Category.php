<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $translatable = ['slug', 'name'];

    protected $table = 'categories';

    protected $fillable = ['slug', 'name'];

    public function products()
    {
        return $this->hasMany(Voyager::modelClass('Product'))
            ->where('status', "=" , 0)
            ->orderBy('created_at', 'DESC');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
    
    public function subproducts()
    {
        return $this->hasManyThrough(Product::class, self::class, 'parent_id', 'category_id');
    }
}