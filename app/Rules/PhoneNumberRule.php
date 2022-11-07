<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumberRule implements Rule
{
    public $str;
    private $message;
    CONST LIMIT_MIN = [2,1,3];
    CONST LIMIT_MAX = 4;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($regex)
    {
        $this->str = $regex;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $phoneNum_array)
    {
        // in_array — 配列に値があるかチェックする
        if(in_array(null,$phoneNum_array,true)){
            // 電話番号にnullがあったら
            $this->message = '電話番号は必須項目です。';
            return false;
        }
        for($i = 0; $i<3; $i++){
            if( mb_strlen($phoneNum_array[$i]) < self::LIMIT_MIN[$i] || mb_strlen($phoneNum_array[$i]) > self::LIMIT_MAX){
                // 入力欄ごとの文字数バリデーション
                $num = $i+1;
                $limit_min = self::LIMIT_MIN[$i];
                $this->message = $num.'番目の入力欄は'.$limit_min.'文字以上4文字以下で入力してください。';
                return false;
            }
        }
        // implode --配列要素を文字列により連結する
        $phone_number = implode('-',$phoneNum_array);
        if( ! preg_match($this->str, $phone_number) ){
            // 正規表現バリデーション
            $this->message = '半角数字で正しく入力してください。';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
