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
        return [
            'last_name'   => 'required|string|max:50',
            'first_name'  => 'required|string|max:50',
            'gender'      => 'required',
            'email'       => 'required|email',
            'tel1'        => 'required|digits_between:2,5',
            'tel2'        => 'required|digits_between:2,5',
            'tel3'        => 'required|digits_between:2,5',
            'address'     => 'required|string|max:100',
            'building'    => 'nullable|string|max:100',
            'category_id' => 'required|integer|exists:categories,id',
            'message'     => 'required|string|max:120',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tel1 = $this->input('tel1');
            $tel2 = $this->input('tel2');
            $tel3 = $this->input('tel3');

            $tel = $tel1 . '-' . $tel2 . '-' . $tel3;

            if (!preg_match('/^\d{2,5}-\d{2,5}-\d{2,5}$/', $tel)) {
                $validator->errors()->add('tel', '電話番号を入力してください');
            }
        });
    }

    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'message.required'     => 'お問い合わせ内容を入力してください',
            'message.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
