# CakePHP App Template

Visando diminuir o bootstrap de um projeto inicial, especialmente feito para api,
baseado em ``tokens`` de serviços para consumo, um projeto poderá ser facilmente
implantado e já iniciado com algumas configurações básicas, aproveite! 

## Instalação

Lembre-se de já estar com o composer instalado e configurado no seu ambiente.

```bash
git clone https://github.com/lpj145/cakephp_template.git nome_do_projeto
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
cd nome_do_projeto
composer install
bin/cake install //Isso irá instalar qualquer coisa que a aplicação precise, incluindo, rodar migrations.
```

Para rodar uma prévia do que é o template, execute:

```bash
bin/cake server -p 8000
```

Deve esta disponivel em: `http://localhost:8000`

## Comandos

````bash
install
````
Esse comando é um facilitador, coloque dentro dele
qualquer coisa relacionada ao deploy de sua aplicação
isso facilitará num deploy não precisar configurar muitas coisas,
ou até mesmo inserir dados manualmente, tenha sempre em mente, que se,
alguma parte do programa necessite executar algo aqui sempre comece o nome da função,
ou o arquivo do contexto com o nome ``install`` isso o ajudará a se lembrar onde isso é executado/lido/tratado.

````bash
create_user %name %last_name %username %password ?role
````

Comando para criação de usuários, tente adicionar um, e depois
faça um post para ``/token``, caso ocorra tudo bem, você deverá receber um token
e mais alguns dados com detalhes.

## Recursos

``/token - Endpoint``
````json
{
  "username": "email@example.com",
  "password": "youpwdhere"
}
````

``/companies - Endpoint``
````json
{
  "name": "NomedaCompanhiaAqui"
}
````

## Detalhes

[Veja Mais](Detalhes.md)

Deve se notar um middleware chamado ``PersistenceOrmFailedMiddleware`` ele
será sempre o responsável por tratar dados entrante na api, como caso de,
criação e atualização de um recurso, ele tenta executar o contexto da requisição
pedida, e caso "execute" ``PersistenceException`` ou `ValidationException` ele retornará
uma estrutra de errors do recurso.

## Configuração
Sempre que você quiser editar as configurações, tenha em mente, que no seu
ambiente de desenvolvimento, o arquivo correto para edição é `config/app_local.php`,
você deve sempre se lembrar de ativar e configurar o banco de dados, com a chave `'Datasource'`
toda a configuração de uma aplicação pode ficar em ambientes de variaveis, ou simplesmente,
defina um arquivo .env na pasta raiz da aplicação.
Toda configuração agnostica ao ambiente, deve ficar em `config/app.php`
