<?php

return [
    'custom' => [
        'name' => [
            'required' => 'O nome é obrigatório.',
            'string' => 'O nome deve ser uma string.',
            'max' => 'O nome não pode ter mais de 255 caracteres.',
            'update_failed' => 'Falha ao atualizar o nome do usuário.',
            'updated_successfully' => 'Nome do usuário atualizado com sucesso!',
        ],
        'email' => [
            'required' => 'O e-mail é obrigatório.',
            'email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'lowercase' => 'O e-mail deve estar em minúsculas.',
            'unique' => 'Este e-mail já está em uso.',
            'max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'success_updated' => 'O e-mail foi atualizado com sucesso!',
            'not_found' => 'Este e-mail não se encontra no nosso sistema!'
        ],
        'password' => [
            'required' => 'A senha é obrigatória.',
            'confirmed' => 'A confirmação da senha não corresponde.',
            'updated_successfully' => 'Senha atualizada com sucesso!',
        ],
        'current_password' => [
            'required' => 'A senha atual é obrigatória.',
            'incorrect' => 'A senha atual está incorreta.',
        ],
        'new_password' => [
            'required' => 'A nova senha é obrigatória.',
            'string' => 'A nova senha deve ser uma string.',
            'min' => 'A nova senha deve ter pelo menos 8 caracteres.',
            'confirmed' => 'A confirmação da nova senha não corresponde.',
        ],
        'description' => [
            'required' => 'A descrição é obrigatória.',
            'string' => 'A descrição deve ser uma string.',
            'max' => 'A descrição não pode ter mais de 255 caracteres.',
        ],
        'coordinates' => [
            'required' => 'As coordenadas são obrigatórias.',
            'string' => 'As coordenadas devem ser uma string.',
            'max' => 'As coordenadas não podem ter mais de 255 caracteres.',
        ],
        'type' => [
            'required' => 'O tipo é obrigatório.',
            'string' => 'O tipo deve ser uma string.',
        ],
        'districts_id' => [
            'required' => 'O distrito é obrigatório.',
            'exists' => 'O distrito selecionado é inválido.',
        ],
        'regions_id' => [
            'required' => 'A região é obrigatória.',
            'exists' => 'A região selecionada é inválida.',
        ],
        'attributes' => [
            'array' => 'Os atributos devem ser um array.',
        ],
        'attributes.*' => [
            'integer' => 'Cada atributo deve ser um número inteiro.',
            'exists' => 'Um ou mais atributos selecionados são inválidos.',
        ],
        'media' => [
            'file' => 'O arquivo deve ser um arquivo.',
            'mimes' => 'O arquivo deve ser um dos seguintes tipos: jpeg, png, jpg, gif, svg.',
            'max' => 'O arquivo não pode ter mais de 2048 KB.',
            'image' => 'O arquivo deve ser uma imagem.',
        ],
        'auth' => [
            'auth' => 'Falha na verificação de autenticação.'
        ],
    ],
    'validation' => [
        'uploaded' => 'Falha ao carregar o arquivo.',
    ],
];
