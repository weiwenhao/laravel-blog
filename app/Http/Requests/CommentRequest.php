<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //权限认证
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
//            'captcha' => 'required|captcha',
            'username' => 'required|between:3,20',
            'content' => 'required|min:3',
            //
        ];

        return $rules;
    }

    /**
     * 重写错误信息
     * @return array
     */
    public function messages()
    {
        return [
            'content.required' => '评论内容不能为空。',
            'content.min' => '评论内容不能少于3个字。',
//            'display_name.required' => '权限名称必须填写',
//            'display_name.unique' => '权限名称已经存在',
        ];
    }
}
