include make-compose.mk

test:
	php artisan test

test-coverage:
	php artisan test --coverage-clover build/logs/clover.xml

setup: env-prepare sqlite-prepare install key migrate

docker-setup: docker-env install key compose-build

install:
	composer install
	npm install

start:
	heroku local -f Procfile.dev

env-prepare:
	cp -n .env.example .env || true

docker-env:
	cp .env.docker .env

sqlite-prepare:
	touch database/database.sqlite

key:
	php artisan key:generate

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

deploy:
	git push heroku

lint:
	composer exec --verbose phpcs

analyse:
	composer exec --verbose phpstan analyse

phpcs:
	composer exec --verbose phpcs

lint-fix:
	composer phpcbf

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n
