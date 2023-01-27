<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(isset(request()->image_path)){
            if(request()->hasFile('image_path')){
                session()->forget('image');
                $image_name = request()->file('image_path')->getClientOriginalName();
                request()->file('image_path')->storeAs('public/save/image', $image_name);
                $image = 'storage/save/image/'. $image_name; 
                session()->put('image',$image);
            }
        } else {
            if(request()->confirm_image == null){
                session()->forget('image');
            }
        }
        
        if(request('id') != null){
            return [
                'status' => 'required',
                'remark' => 'max:500',
                'user_id' => 'required'
            ];
        }
        else {
            // バリデーションルール
            return [
                'inquiry_type' => 'required' ,
                'company_name' => 'required|max:20',
                'user_name' => 'required|max:20',
                'tele_num'  => 'required|regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',
                'email'  => 'required|email',
                'birthday' => 'required|before:today',
                'sex' => 'required',
                'job'=> 'required',
                'content'  => 'required|max:255',
                'status' => 'required',
                'image_path' => 'required_if:confirm_image,null',
                'back' => 'nullable'
            ];
        }
    }

    public function attributes()
    {
        return [
            'image_path' => '証明写真'
        ];
    }
    public function messages()
    {
        return [
            'image' => '画像ファイルはjpg,png拡張子を選択してください。'
        ];
    }
}