<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function datetime_converted_text($attribute_array)
    {
        $replace_array = [" ","/",":"]; 
        $attribute_array = str_replace($replace_array,'',$attribute_array);
        $attribute_array = date('Y-m-d H:i',$attribute_array);
        return $attribute_array;
    }
    
}
