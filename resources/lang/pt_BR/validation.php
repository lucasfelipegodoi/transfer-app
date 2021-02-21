<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'captcha'              => 'Insira o código corretamente',
    'accepted'             => 'O campo deve ser aceito.',
    'active_url'           => 'O campo não é uma URL válida.',
    'after'                => 'O campo deve ser uma data após :date.',
    'alpha'                => 'O campo pode conter somente carácteres.',
    'alpha_dash'           => 'O campo só podem conter carácteres, números e traços.',
    'alpha_num'            => 'O campo só pode conter carácteres e números.',
    'array'                => 'O campo deve ser uma array.',
    'before'               => 'O campo deve ser uma data antes de :date.',
    'between'              => [
        'numeric' => 'O valor deve estar entre :min e :max.',
        'file'    => 'O arquivo deve ter :min e :max kilobytes.',
        'string'  => 'O campo deve ter :min e :max carácteres.',
        'array'   => 'O array deve ter :min e :max itens.',
    ],
    'boolean'              => 'O campo deve ser verdadeiro ou falso.',
    'confirmed'            => 'O campo de confirmação não corresponde.',
    'date'                 => 'O campo deve ser uma data válida.',
    'date_format'          => 'A data deve ser no formato :format.',
    'different'            => 'O campo deve ser diferente de :other.',
    'digits'               => 'O campo deve ter :digits digitos.',
    'digits_between'       => 'O campo deve ter :min e :max digitos.',
    'email'                => 'O campo não é um e-mail válido.',
    'filled'               => 'O campo é obrigatório.',
    'exists'               => 'O campo selecionado é inválido.',
    'image'                => 'O arquivo deve ser uma imagem.',
    'in'                   => 'O campo selecionado é inválido.',
    'integer'              => 'O campo deve ser um número inteiro',
    'ip'                   => 'O campo não é um endereço IP válido',
    'max'                  => [
        'numeric' => 'O valor não pode ser maior que :max.',
        'file'    => 'O arquivo não pode ter mais que :max kilobytes.',
        'string'  => 'O campo não pode ter mais de :max carácteres.',
        'array'   => 'O array não pode ter mais de :max itens.',
    ],
    'mimes'                => 'O arquivo deve ser do tipo: :values.',
    'min'                  => [
        'numeric' => 'O valor não pode ser menor que :min.',
        'file'    => 'O arquivo deve ter pelo menos :min kilobytes.',
        'string'  => 'O valor deve ter pelo menos :min carácteres.',
        'array'   => 'O array deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'O campo selecionado não é válido.',
    'numeric'              => 'O campo deve ser numérico.',
    'regex'                => 'O campo está em um formato inválido.',
    'required'             => 'O campo é obrigatório e não pode ficar vazio.',
    'required_if'          => 'O campo é obrigatório, pois :other é :value.',
    'required_with'        => 'O campo é obrigatório, se :values foi selecionado.',
    'required_with_all'    => 'O campo é obrigatório, se :values foram selecionados.',
    'required_without'     => 'O campo é obrigatório, se :values não foi selecionado.',
    'required_without_all' => 'O campo é obrigatório, se nenhum :values foram selecionados.',
    'same'                 => 'O dado campo deve coincidir com o campo sob validação..',
    'size'                 => [
        'numeric' => 'O valor deve ser :size.',
        'file'    => 'O arquivo deve ter :size kilobytes.',
        'string'  => 'O campo deve ter :size carácteres.',
        'array'   => 'O array deve ter :size itens.',
    ],
    'string'               => 'O campo deve ser uma palavra.',
    'timezone'             => 'O campo deve pertencer aum timezone válida.',
    'unique'               => 'O valor já está cadastrado no sistema.',
    'uploaded'             => 'Houve um erro no upload.',
    'url'                  => 'O campo é uma URL inválida.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
