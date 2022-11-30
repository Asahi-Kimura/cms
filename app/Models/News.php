<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory,SoftDeletes;
    // protected $guarderd = ['id'];
    protected $fillable = [
        '_token',
        'user_id',
        'title',
        'content',
        'start_show',
        'end_show',
        'file_image',     
    ];
}
