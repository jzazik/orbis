# Orbis

### Требования
* PHP 8
* Composer
* [Docker Desktop](https://www.docker.com/products/docker-desktop/)


### Запустить проект
* git clone https://github.com/jzazik/orbis.git
* cd orbis
* cp .env.example .env
* composer update
* ./vendor/bin/sail up
* ./vendor/bin/sail artisan migrate
* npm install