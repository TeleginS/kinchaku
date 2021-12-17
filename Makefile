init: docker-down-clear \
	  api-clear \
 	  docker-pull \
 	  docker-build \
 	  docker-up \
 	  api-init
up: docker-up
down: docker-down
restart: down up

#################
######################     API         ###############################
#################
api-clear:
	docker run --rm -v ${PWD}/api:/app -w /app alpine sh -c 'rm -rf storage/logs/* storage/framework/cache/* storage/framework/sessions/* storage/framework/views/*'

api-init: api-composer-install api-wait-db api-migrations

api-composer-install:
	docker-compose run --rm api-php-cli composer install

api-wait-db:
	docker-compose run --rm api-php-cli wait-for-it api-postgres:5432 -t 30

api-migrations:
	docker-compose run --rm api-php-cli php artisan migrate

#################
######################     FRONT         ###############################
#################

#################
######################     DOCKER         ###############################
#################
docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

#################
######################     CODE STYLE CHECKS         ###############################
#################
api-psalm:
	docker-compose run --rm api-php-cli composer psalm --no-cache

api-lint:
	docker-compose run --rm api-php-cli composer lint