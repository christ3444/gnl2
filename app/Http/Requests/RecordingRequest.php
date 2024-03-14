<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordingRequest extends FormRequest
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
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'pseudo' => 'required|string|unique:users',
            'email' => 'required|string|email',
            'country' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            // 'godfather_pseudo' => 'required|string',
            // 'transaction_password' => 'required|string|min:8|confirmed',
            // 'payer_pseudo' => 'required|string',
            // 'payer_transaction_password' => 'required|string',
        ];
    }
}
