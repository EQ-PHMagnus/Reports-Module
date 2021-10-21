<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgentRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'facebook' => 'required',
                'address' => 'required',
                'password' => 'sometimes|required|min:4|confirmed',
                'mobile_number' => 'digits:11',
                'agent_code' => 'required',
                'agent_id' => 'required',
                'identification' => 'required',
                'recent_photo' => 'required',
                'dob' => 'required|date|before_or_equal:' . \Carbon\Carbon::now()->subYears('21')->format('Y-m-d'),
                'level' => 'required'
            ];
        }
        if ($this->isMethod('put')) {
            return [
                'name' => 'required',
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($this->route('agent'),'id')
                ],
                'facebook' => 'required',
                'address' => 'required',
                'password' => 'sometimes|required|min:4|confirmed',
                'mobile_number' => 'digits:11',
                'agent_code' => 'required',
                'agent_id' => 'required',
                'dob' => 'required|date|before_or_equal:' . \Carbon\Carbon::now()->subYears('21')->format('Y-m-d'),
                'level' => 'required'
            ];
        }
        
    }
}
