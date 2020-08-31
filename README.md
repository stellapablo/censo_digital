#  <img src="/src/ciudad-digital-blanco.png" width="150">
![](/src/ciudad-digital-blanco.png)

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

[![Build Status](https://img.shields.io/travis/aschmelyun/cleaver/master.svg?style=flat-square)](https://travis-ci.org/aschmelyun/cleaver)


# CENSO DIGITAL

Laravel APP.


## Docker compose

El proyecto incluye un `docker-compose.yml` para que pueda correr el entorno.


### Pré-Requisitos:

Para correr el proyecyo es necesario tener instalado lo siguiente:

- [Docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-20-04)
- [Docker Compose](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04)

Opcional, mas recomendado:

- PHP-cli
- [Composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)

Meu setup usa uma máquina local Ubuntu 18.04 rodando Docker e Docker Compose, mas também com um ambiente básico PHP na linha de comando para rodar comandos do (PHP) Composer.

### Instalacion:

Primero, clonar el proyecto con:

```bash
git clone https://github.com/stellapablo/censo_digital
```

Modifique el archivo enviroment de ejemplo

```bash
cp .env.example .env
```

Para correr el proyecto

```bash
docker-compose up -d
```

Una vez que el ambientes se encuentra instalado, podra usar este comando para correr las dependencias
directamento con composer en el contenedor. No es necesario composer en su maquina.

```bash
docker-compose exec app composer install
```

Finalmente, generar key app

```bash
docker-compose exec app php artisan key:generate
```

Para acceder ingresar el browser `localhost:8000`.

