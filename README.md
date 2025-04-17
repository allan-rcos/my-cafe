# MyCafé

O **MyCafé**, é um **website completo para cafeteria.** Ele salva: `Pedido`, `Reservas`, `Produtos`, `Usuários`, entre outros.

Esse é mais um de meus projetos de treinamento, como tal não está pronto para o ambiente de produção. Tentei menter o Design o mais agradável possível, completamente em dark mode, possui algumas partes com design menos trabalhado para aguardar a implementação de JQuery. No mais, foi utilizado o máximo de conhecimento em Code Igniter possível, para dominar o framework. 


## Demonstração

![Demonstração do uso do projeto.](https://raw.githubusercontent.com/allan-rcos/my-cafe/refs/heads/master/mycafe.gif)

## Tecnologias
### 1. Básico ao Avançado de PHP;
   
### 2. Views em PHP Puro + CI Helpers:
- Layouts; 
- Partial Files;
- CSS;
- Bootstrap v5.3;
- IonIcons;
- Form e HTML helpers.
  
### 3. POO:
- Interfaces;
- Traits;
- Enums;
- Classes Abstratas e outros.
  
### 4. CodeIgniter Framework:
- Controllers;
- Spark;
- Shield;
- Forms;
- QueryBuilder, Models, Entities, Seeders e Migrations;
- Libraries;
- Services;
- Events;
- UploadedFiles;
- Helpers;
- Testes;
- Custom Validators;
- Paginação.

## Instalação

### 1. Crie uma pasta e extraia o código fonte:

Exemplo pelo git:

```bash
gh repo clone allan-rcos/my-cafe
```

### 2. Configure o Banco de Dados:

Foi utilizado para desenvolvimento o banco [MariaDB v10](https://mariadb.org/download/). Suas variáveis de ambiente seguem esse modelo:

```env
database.default.hostname = localhost
database.default.database = mycafe
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
database.default.DBPrefix =
# database.default.port = 3306
```

### 3. Composer:

Instale o [Composer](https://getcomposer.org/download/) no seu computador e inicie o projeto:

```bash
composer install
```

### 4 Suba o banco de dados:

Crie a tabela, caso ela ainda não exista:

```bash
php spark db:create
```

Rode as migrações:

```bash
php spark migrate --all
```

Caso deseje já começar com dados fictícios é só rodar os Seeders, lembrando que todos estão no `AppSeeder`:
```bash
php spark db:seed AppSeeder
```
Alem disso é necessário carregar as imagens fictícias, elas estão nesse caminho: `public/assets/images/uploads_default`, renomeie a pasta para `uploads` para utilizá-las.

## Uso

### 1. Iniciando o servidor:

Rode na pasta raiz do projeto:

```bash
php spark serve
```

Então é só abrir o link https://localhost:8080, ele aparecerá no log do comando acima.

*Obs*: Lembrando que pode ser iniciado pelo servidor próprio do php

### 2. Registrando um usuário:

Caso tenha rodado os Seeders, vai possuir um email com privilégios de desenvolvedor`developer@mycafe.local` com senha `admin`.  Caso não, é só registrar um novo via Shield Commands no Spark:

```bash
# Não se esqueça de substituir os valores.
php spark shield:user create -n USERNAME -e EMAIL
php spark shield:user activate -n USERNAME
php spark shield:user addgroup -n USERNAME -g superadmin
```

## Roteiro

- [ ] JavaScript JQuery e suas principais bibliotecas;
- [ ] Formulário de Reserve (Aguardando a implementação acima para inputs de date time);
- [ ] Barra de pesquisa, ordenação de campos e limite por página;
- [ ] Toasts de mensagem;
- [ ] Migração de Actions para abordagem Cliente (JQuery Requests) - Servidor (CI API);
- [ ] Ativação, Contato e Troca de Senha por Email.

## Status do Projeto

No momento estarei focando em outros frameworks para expandir meu conhecimento na linguagem PHP, porém aindá há tarefas incompletas nesse projeto que poderão ser atualizadas futuramente e inclusive estão no roteiro.

## Contribuir

Esse é um projeto de treinamento, portanto fique a vontade para cloná-lo.

## Licença

[MIT](https://choosealicense.com/licenses/mit/)