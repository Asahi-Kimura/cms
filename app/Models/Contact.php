<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inpuiry_type_checked($attributes)
    {
        $inquiry_type = config('const.inquiry_type');
        $inquiry_type_array = array_intersect($inquiry_type,$attributes['inquiry_type']);
        foreach($inquiry_type_array as $key => $value){
            $inquiry_type_array[$key] = 'checked';
        }
        $attributes = array_merge($attributes,$inquiry_type_array);
        return $attributes;    
    }
}
