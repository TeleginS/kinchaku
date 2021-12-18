init: docker-down-clear \
 	  api-clear \
 	  docker-pull \
 	  docker-build \
 	  docker-up \
 	  api-init \
 	  frontend-init
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

frontend-init: frontend-npm-install frontend-ready

frontend-npm-install:
	docker-compose run --rm frontend-node-cli npm install

frontend-ready:
	docker run --rm -v ${PWD}/frontend:/app -w /app alpine touch .ready

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
api-check: api-psalm api-lint tests

api-psalm:
	docker-compose run --rm api-php-cli composer psalm --no-cache

api-lint:
	docker-compose run --rm api-php-cli composer lint

tests:
	docker-compose run --rm api-php-cli php artisan test

api-prettier:
	docker-compose run --rm frontend-node-cli npm run prettier -- /php/app --write

frontend-prettier:
	docker-compose run --rm frontend-node-cli npm run prettier
