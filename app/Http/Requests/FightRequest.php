<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FightRequest extends FormRequest
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
            'fight_no' => 'required|numeric',
            'arena_id' => 'required|numeric|exists:arenas,id',
            'meron' => 'required',
            'wala' => 'required',
            'schedule' => 'date'
        ];
    }
}
