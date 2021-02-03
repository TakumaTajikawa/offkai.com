<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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

    private const GUEST_USER_EMAIL = 'guestuser@example.com';

    private const GUEST_USER_ID = 1;
    
    public function rules()
    {
        if(Auth::id() == self::GUEST_USER_ID) {
            return [
                'introduction' => 'max:255',
                'profile_img' => 'file|image|mimes:jpg,jpeg,png|max:2048',
            ];
        } else {
            return [
                'name' => 'required|min:1|max:15' . Rule::unique('users')->ignore(Auth::id()),
                'email' => 'required|max:255|' . Rule::unique('users')->ignore(Auth::id()),
                'gender' => 'required',
                'profile_img' => 'file|image|mimes:jpg,jpeg,png|max:2048',
                'introduction' => 'max:255',
            ];
        }
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'profile_img' => 'プロフィール画像',
            'introduction' => '紹介文',
        ];
    }
}
