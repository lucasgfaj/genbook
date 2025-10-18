## Genbook

"Genbook" is the ultimate solution for libraries looking to optimize the management of their collection, enhance user service, and ensure an efficient process of organization and problem resolution.

### Dependências

- Docker
- Docker Compose

### To run

#### Clone Repository

```
 git clone git@github.com:lucasgfaj/genbook.git
```

```
 cd genbook
```

#### Define the env variables

```
 cp .env.example .env
```

#### Install the dependencies

```
 ./run composer install
```

#### Up the containers

```
 docker compose up -d
```

ou

```
 ./run up -d
```

#### Create database and tables

```
 ./run db:reset
```

#### Populate database

```
 ./run db:populate
```

#### Fixed uploads folder permission
```
sudo chown www-data:www-data public/assets/uploads
```


#### Run the tests

```
 docker compose run --rm php ./vendor/bin/phpunit tests --color
```

ou

```
 ./run test
```

#### Run the linters

[PHPCS](https://github.com/PHPCSStandards/PHP_CodeSniffer/)

```
 ./run phpcs
```

[PHPStan](https://phpstan.org/)

```
 ./run phpstan
```

Access [localhost](http://localhost)

### Teste de API

#### Rota não autenticada

```shell
curl -H "Accept: application/json" localhost/genbook
```

#### Rota autenticada

Neste caso precisa alterar o valor do PHPSESSID de acordo com a o id da sua sessão.

```shell
curl -H "Accept: application/json" -b "PHPSESSID=5f55f364a48d87fb7ef9f18425a8ae88" localhost/genbook
```
