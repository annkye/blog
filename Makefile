up: docker-up
init: docker-down-clear docker-pull docker-build docker-up composer-inst wait-db docker-migrations
restart: docker-down docker-up
migrate: docker-migrations
test: manager-test

docker-up:
	docker-compose up -d

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-down:
	docker-compose down --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

composer-inst:
	docker-compose run --rm php-cli composer install --prefer-dist

wait-db:
	until docker-compose exec -T postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done

docker-migrations:
	docker-compose run --rm php-cli php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

manager-test:
	docker-compose run --rm php-cli php bin/phpunit


