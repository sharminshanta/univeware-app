<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer',
            'prefixname' => 'nullable|string',
            'suffixname' => 'nullable|string',
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'regex:/^\S*$/u', 'unique:'.User::class],
           // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user()->id, 'id')
            ],
            'password' => ['required', 'confirmed', Password::defaults()],
            'photo' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ];
    }
}
