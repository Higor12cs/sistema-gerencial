<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'legal_name' => ['nullable'],
            'date_of_birth' => ['nullable', 'date'],
            'cpf' => ['nullable'],
            'rg' => ['nullable'],
            'email' => ['nullable'],
            'phone1' => ['nullable'],
            'phone2' => ['nullable'],
            'zip_code' => ['nullable'],
            'address' => ['nullable'],
            'number' => ['nullable'],
            'complement' => ['nullable'],
            'district' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'active' => ['nullable'],
            'observation' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'date' => 'O campo :attribute deve ser uma data válida.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'legal_name' => 'razão social',
            'date_of_birth' => 'data de nascimento',
            'cpf' => 'cpf',
            'rg' => 'rg',
            'email' => 'email',
            'phone1' => 'telefone',
            'phone2' => 'telefone',
            'zip_code' => 'cep',
            'address' => 'endereço',
            'number' => 'número',
            'complement' => 'complemento',
            'district' => 'bairro',
            'city' => 'cidade',
            'state' => 'estado',
            'active' => 'ativo',
            'observation' => 'observação',
        ];
    }
}
