# Transfer APP

## Características
Projeto desenvolvido usando [Lumem](https://lumen.laravel.com/) e banco de dados MySQL.
A intenção do projeto é exemplificar o cenário de transação financeira entre duas contas.

## Instruções para execução
Após realizado o `git clone` do projeto, é necessário executar os seguintes comandos na raiz do projeto:

`composer install` 

`php artisan key:generate`

Após geração chave do projeto, é necessário copiar o arquivo _.env.example_ renomeando para _.env_ e incluindo as informações de acesso ao banco de dados . Tendo configurado as credenciais de banco de dados, executar:

`php artisan migrate`

`php artisan passport:install` - a credencial de ID 2 deve ser guardada para ser utilizada no processo de [Autenticação](https://github.com/lucasfelipegodoi/transfer-app/wiki/Autentica%C3%A7%C3%A3o)

`php artisan db:seed` - passo opcional, será criado alguns usuários do tipo "Comum" e "Lojista" para testes do projeto

Para que a aplicação fique disponível, é possível ou configurar um servidor local ou utilizar o comando `php artisan serve`, que irá iniciar o projeto no endereço _http://127.0.0.1:8000_

## Documentação 

Os métodos disponíveis na API são os seguintes:

[Cadastro de usuário](https://github.com/lucasfelipegodoi/transfer-app/wiki/Cadastro-de-usu%C3%A1rio)

[Autenticação](https://github.com/lucasfelipegodoi/transfer-app/wiki/Autentica%C3%A7%C3%A3o)

[Retorna informações do usuário](https://github.com/lucasfelipegodoi/transfer-app/wiki/Retorna-informa%C3%A7%C3%B5es-do-usu%C3%A1rio)

[Depositar valor a uma carteira (conta)](https://github.com/lucasfelipegodoi/transfer-app/wiki/Depositar-valor-a-uma-carteira-(conta))

[Transferência entre contas](https://github.com/lucasfelipegodoi/transfer-app/wiki/Transfer%C3%AAncia-entre-contas)

## Postman
[Download](https://github.com/lucasfelipegodoi/transfer-app/tree/master/docs)
