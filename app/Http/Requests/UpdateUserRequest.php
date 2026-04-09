<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'name' => ['required', 'string', 'max:255', 'min:2'],

            'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($user->id)
                ],

                'password' => [
                    'nullable',
                    'min:6',
                    'confirmed'
                ],

                'is_admin' => ['nullable', 'boolean'],
                'expires_at' => ['nullable', 'date'],
            ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O nome deve ter no máximo 255 caracteres.',
            'name.min' => 'O nome deve ter no mínimo 2 caracteres.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço válido.',
            'email.unique' => 'O e-mail já está em uso.',

            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed' => 'As senhas não correspondem.',
        ];
    }

}
