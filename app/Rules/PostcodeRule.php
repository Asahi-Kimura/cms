<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PostcodeRule implements Rule
{
    private $str;
    private $message;
    CONST LIMIT_COUNT = [3,4];
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
    public function passes($attribute, $code_array)
    {
        // in_array — 配列に値があるかチェックする
        if(in_array(NULL,$code_array,true)){
            // 電話番号にnullがあったら
            $this->message = '郵便番号は必須項目です。';
            return false;
        }

        for($i = 0; $i<2; $i++){
            if( mb_strlen($code_array[$i]) != self::LIMIT_COUNT[$i]){
                // 入力欄ごとの文字数バリデーション
                $num = $i+1;
                $limit_count = self::LIMIT_COUNT[$i];
                $this->message = $num.'番目の入力欄は'.$limit_count.'文字で入力してください。';
                return false;
            }
        }
        // implode --配列要素を文字列により連結する
        $code_array = implode('-',$code_array);
        if( ! preg_match($this->str,$code_array)){
            // 正規表現バリデーション
            $this->message = '半角数字でを正しく入力してください。';
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
