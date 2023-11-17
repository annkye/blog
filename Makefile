up: docker-up
init: docker-down-clear docker-pull docker-build docker-up composer-inst
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
	docker-compose run --rm php-cli composer install

manager-test:
	docker-compose run --rm php-cli php bin/phpunit