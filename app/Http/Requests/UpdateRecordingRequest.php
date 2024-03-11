<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecordingRequest extends FormRequest
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
            'pseudo' => 'required|string|unique:users,pseudo,'. $this->id,
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'country' => 'required|string',
            'transaction_password' => 'required|string|min:8|confirmed',
        ];
    }
}
