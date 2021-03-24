<h1 align="center">Agenda Shipsmart</h1>

Bem vindo ao sistema de Contatos da Shipsmart.

## Requisitos
* 1 - PHP >= 7.4.
* 2 - NODE >= 14.15

## Instalação
### Configuração - Backend

``` bash
# Instalar dependências do projeto
composer install

# Atualizar lista de classes
composer dump-autoload

# Configurar variáveis de ambiente
cp .env.example .env
php artisan key:generate

# Gerar banco de dados com os estados  do Brasil
php artisan migrate:fresh --seed
```
## Tecnologias
[x] Laravel 8xx
[x] VueJs
[x] Bootstrap
[x] MongoDB