init: docker-down-clear \
 	  docker-pull \
 	  docker-build \
 	  docker-up
up: docker-up
down: docker-down
restart: down up

#################
######################     API         ###############################
#################

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