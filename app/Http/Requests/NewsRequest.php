<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        
        return [
            'id' => 'nullable',
            'user_id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required|max:255',
            'start_show' => 'required',
            'end_show' => 'nullable',
            'file_image' => ['required_if:id,null','nullable','image']   
        ];
    }
    public function attributes()
    {
        return [
            'status' => 'ステータス',
            'title' => 'タイトル',
            'content' => '本文',
            'start_show' => '公開開始',
            'end_show' => '公開終了',
            'file_image' => '画像'   
        ];
    }
    public function messages()
    {
        return [
            'required_if' => '画像を選択してください。',
            'image' => '画像ファイルはjpg,png,svg拡張子を選択してください。'
        ];
    }


}
