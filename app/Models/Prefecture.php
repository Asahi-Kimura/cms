<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    protected $guarderd = ['id'];
    
    public function user()
{
    return $this->belongsTo(User::class);
}
}
