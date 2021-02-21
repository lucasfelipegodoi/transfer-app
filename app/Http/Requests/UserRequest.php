<?php

namespace App\Http\Requests;

use App\Models\UsersType;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($data)
    {
        $id = $data['id'] ?? null;

        $rules = [
            'id' => ['integer', 'nullable'],
            'name' => ['string', 'required'],
            'email' => ['email', 'required', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['string', 'required'],
            'document' => ['cpf_cnpj','required', Rule::unique('users', 'document')->ignore($id)],
            'users_type_id' => ['required', 'integer',Rule::in(UsersType::getTypes())]
        ];

        if($id) {
            $rules['id'] = [
                'integer', 'required', Rule::exists('users', 'id')
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'id.exists' => 'Este usuário não está cadastrado no sistema.'
        ];
    }
}
