<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class XuzuRequest extends FormRequest
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
            'realname'=>' required ',
            'cardId'=>[
                ' required ',
                'regex:/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx])|([1−9]\d5\d2((0[1−9])|(10|11|12))(([0−2][1−9])|10|20|30|31)\d2[0−9Xx])/'
            ],
            'phone'=>[
                ' required ',
                // ' size:11',
                'between:7,11'
                // 'regex:/((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}/'
            ],
            'address'=>'required',
            'village'=>'required'
        ];
    }

    public function messages(){

        return [
            'phone.required'=>'手机号 不能为空',
            'phone.between'=>'手机号长度不对',

            'realname.required'=>'姓名 不能为空',

            'cardId.required'=>'身份证 不能为空',
            'cardId.regex'=>'请输入正确的身份证',

            'address.required'=>'住址 不能为空',

            'village.required'=>'小区 不能为空'
        ];
    }
}
