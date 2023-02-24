<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorksRegisterRequest extends FormRequest
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
            'title' => 'required | max:50',
            'headline' => 'max:50',
            'body' => 'required | max:200000',
        ];
    }

    public function messages()
    {
        return [
            'title.required'  => '作品名は必須入力です。50文字以内でご入力ください。',
            'title.max'  => '作品名は必須入力です。10文字以内でご入力ください。',
            'headline.max'  => '見出しは50文字以内でご入力ください。',
            'body.required'  => '本文は必須入力です。200,000文字以内でご入力ください。',
            'body.max'  => '本文は必須入力です。200,000文字以内でご入力ください。',
        ];
    }

}
