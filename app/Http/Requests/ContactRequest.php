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

        if(session()->has('image')){
            $temp_image = session()->get('image');
        } else {
            $temp_image = null;
        }
        // idがnullでない場合、データー更新
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
                'tele_num'  => 'required|regex:/^[0-9-]+$/',
                'email'  => 'required|email',
                'birthday' => 'required|before:today',
                'sex' => 'required',
                'job'=> 'required',
                'content'  => 'required|max:255',
                'status' => 'required',
                'file_image' => "required_if:'{$temp_image},null'",
                'file_image_delete' => 'nullable',
                'back' => 'nullable'
            ];
        }
    }

    public function attributes()
    {
        return [
            'file_image' => '証明写真'
        ];
    }
    public function messages()
    {
        return [
            'image' => '画像ファイルはjpg,png拡張子を選択してください。'
        ];
    }
}