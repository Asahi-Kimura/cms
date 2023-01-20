<?php

namespace App\Http\Requests;

use App\Rules\FileImageRule;
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
                'file_image' => 'required_if:confirm_image,',
                // 'confirm_image' => 'required_if:file_image,null',
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


// 初回はfile_image は必須
// required_
// 確認画面にもどると入力された画像の表示　hiddenで入力された画像のパスを保持
//  confirm_image

// そのまま確認画面すすむとさっきの画像が表示される　
// →　file_image = null confrim_image = ~~~~~~

// 入力画面にもどり画像を消す　　

// 確認画面に進むとバリエーションをかける













