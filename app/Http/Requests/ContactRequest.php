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
        // input type=file入力有り
        if(isset(request()->image_path)){
            // image_pathはファイル形式か判定
            if(request()->hasFile('image_path')){
                // 正の場合→ユーザーのファイル情報を保存（文字列）
                session()->forget('image');
                $image_name = request()->file('image_path')->getClientOriginalName();
                request()->file('image_path')->storeAs('public/save/image', $image_name);
                $image = 'storage/save/image/'. $image_name; 
                session()->put('image',$image);
            } else {
            //負の場合、既にsession('image')に保存されているため、記述不要。
            }
        //入力無し
        } else {
            // confirm_imageに入力値がある場合の削除判定
            // value無（削除ボタンクリックおよび初期値）
            if(request()->confirm_image == null){
                session()->forget('image');
            } else {
            //value有（上記以外）
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

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// image_pathのバリデーションルールについて


// 前提　input type="file" name="image_path"のvalueは保持できない。
// https://teratail.com/questions/115016


// 1回目
// image_path は必須
// image_path = required, 
// ↓
// 確認画面　→　もどるとアップロードした画像の表示される。

// 画像を表示させるため、画像パス「file_path_string('image_path')」を取得してimgタグに挿入。
// 画像パスを保持するinputタグを追加
// 「くinput type="hidden" name="confirm_image" value="file_path_string('image_path')">」

// 2回目
// 条件1（エラー無）
// パターン1
// そのまま確認画面すすむ　→　確認画面で先ほどの画面が表示する
// image_path = null
// confirm_image = required

// パターン2,3
// ファイル選択後、確認画面へ進む(削除ボタンはon or off)
// image_path = required,
// confirm_image = nullable

// 条件2（エラー有）
// 画像削除ボタンクリック(on)　→　ファイル選択せずに確認画面へ
// image_path = null,
// confirm_image = null
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// 結論
// image_path = required_if:confirm_image,null
// (訳::confirm_imageがnullの時、image_pathは必須項目requiredである。)

// confirm_imageがnullの場合とは
// 1回目はconfirm_image = null
// 2回目以降　→　画像削除ボタンclick時 $(.confirm_image).val('')
// index.blade.php220~224行目参照。