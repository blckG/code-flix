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


### Construção da API e Testes Automizados
#### Primeira parte:
Você deverá implementar toda autenticação com JWT mostrada há 2 capítulos, incluindo logout e o auto-refresh token. 

Disponibilize um endpoint para mostrar o usuário autenticado (/api/user), este endpoint deverá ser protegido, ou seja, somente usuários autenticados poderão acessa-los.

Além disto, você deverá criar outro endpoint para listar todas as categorias de vídeo (/api/categories).

#### Segunda parte:
Você deverá implementar testes para:

**Testes HTTP:**

* Verificar a autenticação JWT
* Verificar o logout (use o status code da resposta para averiguar se o token foi invalidado)
* Verificar o refresh token
* Verificar a resposta do endpoint (/api/categories)

**Testes no Browser**

* Testar as 4 operações do CRUD de categorias: Create, Retrieve (show), Update e Delete.

### Autenticação no aplicativo
Nesta fase você deverá criar a autenticação no aplicativo Ionic. Implemente todos conceitos vistos nos últimos capítulos.

* Mostre o nome do usuário
* Termine o redirecionamento para o login após o logout
* Implemente uma área de alteração de senha

Lembre-se de proteger a área interna do aplicativo com o decorator de autenticação