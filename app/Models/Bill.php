<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    public $timestamps = true;
    use HasFactory;
    
    public function users()
    {
      return $this->belongsTo(User::class);
    }
}
