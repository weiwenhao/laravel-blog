<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rules =  [
            'title' => 'required|min:3',
            'description' => 'required|min:9',
            'content' => 'required|min:20',
            'cat_id' => 'required',
            'key_id' => 'required',
            'publish_at' => 'required|date',
            //
        ];
        if(request()->isMethod('PUT') || request()->isMethod('PATCH')){

        }
        return $rules;
    }
    /**
     * 重写错误信息
     * @return array
     */
    public function messages()
    {
        return [
            'cat_id.required' => '请选择文章分类。',
            'key_id.required' => '请选择至少一项关键字。',
            'publish_at.required' => '发布时间不能为空。',
            'publish_at.date' => '时间格式错误。',

        ];
    }


}
