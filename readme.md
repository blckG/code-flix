# CodeFlix

## 1. Passos para começar

### Instalando as Dependências

`composer install`

`npm install`

### Rodando as migrações e seeds

`php artisan migrate`

`php artisan db:seed`

### Inicializando o Servidor

`php artisan serve`

## Desafios

### Usuários e Categorias

Nesta primeira fase, você deverá implementar:

* A autenticação administrativa dos usuários com verificação da conta.
* A administração de usuários.
* Uma área em que o usuário possa alterar sua senha. Cria duas rotas, uma para mostrar o formulário de alteração de senha e outra para realizar o processo. Quando o usuário validar a conta, deve ser redirecionado para a área de alteração de senha.
* A administração de categorias. Cada categoria terá id e name.

Faça todas as implementações usando repositórios e acrescente a barra de menus com os links necessários.