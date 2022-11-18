<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use App\Rules\PhoneNumberRule;
use App\Rules\PostcodeRule;
use App\Rules\PasswordRule;

class UserRequest extends FormRequest
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
        // 正規表現
        $phone_regex = '/^[0-9]{2,4}-[0-9]{1,4}-[0-9]{3,4}$/';
        $post_code_regex = '/^[0-9]{3}-[0-9]{4}$/';
        // バリデーションルール
        return [
            'prefecture_id' => 'required',
            'authority' => 'required',
            'name' => 'required|string|max:30',
            'kana' => 'required|max:30|regex:/^[\t\sァ-ヾ]+$/u',
            'email' => ['required','string','email',Rule::unique('users')->ignore($this->id)],
            'password' => ['required_if:id,null','nullable','string','min:8'],
            // 電話番号独自ルール
            'phone_number' => new PhoneNumberRule($phone_regex),
            // 郵便番号独自ルールphone_regex
            'post_code' => new PostcodeRule($post_code_regex),
            // 'prefecture' => 'required',
            'city' => 'required|max:30',
            'address' => 'required|max:50',
            'remark' => 'max:500'
        ];
    }

    protected function passedValidation()
    {
        $data = [];
        $data['phone_number'] = implode('-',(array)$this->phone_number);
        $data['post_code'] = implode('-',(array)$this->post_code);
        $this->merge($data);
    }
    public function attributes()
    {
        return [
            'authority' => '権限'
    //       'prefecture' => '都道府県'
        ];
    }
    public function messages()
    {

        return [
            'required_if' => 'パスワードは必須入力です。'
        ];
    }
}
