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
        if(request()->confirm_image == null){
            session()->forget('image');
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
                'file_image' => 'required_if:confirm_image,null',
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

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// file_imageのバリデーションルールについて


// 前提　input type="file" name="file_image"のvalueは保持できない。
// https://teratail.com/questions/115016


// 1回目
// file_image は必須
// file_image = required, 
// ↓
// 確認画面　→　もどるとアップロードした画像の表示される。

// 画像を表示させるため、画像パス「file_path_string('file_image')」を取得してimgタグに挿入。
// 画像パスを保持するinputタグを追加
// 「くinput type="hidden" name="confirm_image" value="file_path_string('file_image')">」


// 2回目
// 条件1（エラー無）
// パターン1
// そのまま確認画面すすむ　→　確認画面で先ほどの画面が表示する
// file_image = null
// confirm_image = required

// パターン2,3
// ファイル選択後、確認画面へ進む(削除ボタンはon or off)
// file_image = required,
// confirm_image = nullable

// 条件2（エラー有）
// 画像削除ボタンクリック(on)　→　ファイル選択せずに確認画面へ
// file_image = null,
// confirm_image = null
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// 結論
// file_image = required_if:confirm_image,null
// (訳::confirm_imageがnullの時、file_imageは必須項目requiredである。)

// confirm_imageがnullの場合とは
// 1回目はconfirm_image = null
// 2回目以降　→　画像削除ボタンclick時 $(.confirm_image).val('')
// index.blade.php220~224行目参照。