<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Prefecture;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function user_sort($query,$sort_inc_name,$sort_pattern)
    {
        if(!empty($sort_pattern)){
            if($sort_pattern == 'asc'){
                if($sort_inc_name == 'sort_name'){
                    $query->orderBy('name','asc');
                } 
                if($sort_inc_name == 'sort_email') {
                    $query->orderBy('email','asc');
                }
            }
            if($sort_pattern == 'desc'){
                if($sort_inc_name == 'sort_name'){
                    $query->orderBy('name','desc');
                } 
                if($sort_inc_name == 'sort_email') {
                    $query->orderBy('email','desc');
                }
            }
        }
        return $query;
    }
}
