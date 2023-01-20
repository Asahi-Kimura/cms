<?php

namespace App\Models;

use DateTime;
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

    public function text_convert_datetime($string)
    {
        $replace_array = [" ","/",":"]; 

        $string = str_replace($replace_array,'',$string);
        $date_time_object = new DateTime($string);
        return $date_time_object;
    }
}
