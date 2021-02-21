<?php

namespace App\Http\Requests;

use App\Models\TransactionTypes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionRequest extends Request
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
            'wallet_id' => ['integer', 'required', Rule::exists('wallet', 'id')],
            'transaction_type_id' => ['integer', 'required',   Rule::exists('transaction_types', 'id')],
            'value' => ['required'],
        ];

        if(isset($data["transaction_type_id"]) && $data["transaction_type_id"] == TransactionTypes::TRANSFER){
            
            if(isset($data["value"]) && $data["value"] > 0){
                $rules["wallet_id_payer"] = ['integer', 'required', Rule::exists('wallet', 'id'),'payer_validation'];
            }

            if(isset($data["value"]) && $data["value"] <= 0){
                $rules["wallet_id_payee"] = ['integer', 'required', Rule::exists('wallet', 'id')];
            }
        }

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
