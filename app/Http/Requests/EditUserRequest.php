<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'surname' => 'nullable',
            'lastname' => 'nullable',
            'email' => 'required|email',
            "role_id" => "required|integer",
            'password' => "sometimes",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Вы не заполнили поля имя',
            'email.required' => 'Вы не заполнили поле email',
            'email.email' => 'Вы ввели не валидный email',
            'email.unique' => 'Пользователь с таким email уже зарегестрирован',
        ];
    }
}
