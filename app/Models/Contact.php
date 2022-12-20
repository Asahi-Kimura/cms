<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    //並び替え関数
    public function sort_authority(){
        {
            $q = DB::table('users')
                ->select('users.*')
                ->join('contacts','contacts.user_id','=','users.id')
                ->orderBy('users.name','asc')->get();
            return $q;
        }
    }
    //並び替え機能
    public function sort($request,$query)
    {
        $sort_pattern = $request->sort;
        $sort_inc_name = $request->sort_name;
        if(!empty($sort_pattern)){
            if($sort_pattern == 'asc'){
                if($sort_inc_name == 'sort_status'){
                    $query->orderBy('status','asc');
                }
                if($sort_inc_name == 'sort_authority'){
                    $query->select('contacts.*')
                        ->join('users','contacts.user_id','=','users.id')
                        ->orderBy('users.name','asc')->get();
                    }
                if($sort_inc_name == 'sort_company'){
                    $query->orderBy('company_name','asc');
                }
                if($sort_inc_name == 'sort_name'){
                    $query->orderBy('user_name','asc');
                }
            }
            if($sort_pattern == 'desc'){
                
                if($sort_inc_name == 'sort_status'){
                    $query->orderBy('status','desc');
                }
                if($sort_inc_name == 'sort_authority'){
                    $query->select('contacts.*')
                            ->join('users','contacts.user_id','=','users.id')
                            ->orderBy('users.name','desc')->get();
                }
                if($sort_inc_name == 'sort_company'){
                    $query->orderBy('company_name','desc');
                }
                if($sort_inc_name == 'sort_name'){
                    $query->orderBy('user_name','desc');
                }
            }
        }
    return $query;
    }
}