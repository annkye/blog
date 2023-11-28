up: docker-up
init: docker-down-clear docker-pull docker-build docker-up composer-inst
restart: docker-down docker-up
migrate: docker-migrations
test: manager-test

docker-up:
	docker-compose up -d

docker-down-clear:
	docker-compose down -v --remove-orphans

manager-clear:
	docker run --rm -v ${PWD}/app:/app --workdir=/app alpine rm -f .ready

docker-down:
	docker-compose down --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

composer-inst:
	docker-compose run --rm php-cli composer install --prefer-dist

manager-test:
	docker-compose run --rm php-cli php bin/phpunit

docker-migrations:
	docker-compose run --rm php-cli php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
