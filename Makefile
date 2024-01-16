up: docker-up
init: docker-down-clear docker-pull docker-build docker-up composer-install wait-db docker-migrate
restart: docker-down docker-up
migrate: docker-migrate
test: docker-test
assets: docker-assets-dev

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

composer-install:
	docker-compose run --rm php-cli composer install --prefer-dist

wait-db:
	until docker-compose exec -T postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done

docker-migrate:
	docker-compose run --rm php-cli php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

docker-test:
	docker-compose run --rm php-cli php bin/phpunit

docker-yarn-install:
	docker-compose run --rm node yarn install

docker-assets-dev:
	docker-compose run --rm node npm run dev

clear:
	docker-compose run --rm php-cli php bin/console cache:clear








