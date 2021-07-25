<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    public $timestamps = false;
    use HasFactory;
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
