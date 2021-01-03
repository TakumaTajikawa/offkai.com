<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'title' => 'required|max:50',
            'body' => 'required|max:500',
            'cities' => 'required|max:20',
            'genre' => 'required|max:20',
            'meeting_date_time' => 'required|max:20',
            'image' => 'required|max:20',
            'age' => 'required|max:20',
            'venue' => 'required|max:20',
            'membership_fee' => 'required|max:20',
        ];
    }

    public function attributes()
    {
        return[
            'title' => 'タイトル',
            'body' => '本文',
            'citis' => '区市町村',
            'genre' => 'ジャンル',
            'meeting_date_time' => '開催日時',
            'image' => '画像',
            'age' => '年齢',
            'venue' => '会場',
            'membership_fee' => '会費'
        ];
    }
}
