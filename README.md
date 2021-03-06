[![Maintainability](https://api.codeclimate.com/v1/badges/73d137ffbcc2d556b0e9/maintainability)](https://codeclimate.com/github/ava239/crud-test/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/73d137ffbcc2d556b0e9/test_coverage)](https://codeclimate.com/github/ava239/crud-test/test_coverage)

# Demo
https://crud-test-ah.herokuapp.com/

# Setup
Server will be available at http://localhost:8000/ (same if you choose to run it in Docker)
### Local SQLite
``` sh
$ make setup
$ make start
```
### Local PostgreSQL/MySQL
- Create database
- Follow steps to install local SQLite version
- Edit **.env**: add your database host, database name, username and password
- Change DB_CONNECTION in **.env** to: *pgsql / mysql* (depending on your choice)
- Run migrations and seeds
``` sh
$ php artisan migrate
$ php artisan db:seed
```

### Docker with PostgreSQL
``` sh
# alternate version of setup, configured for docker
$ make docker-setup

# start docker containers and wait until they are up. Postgres may take some time on first run.
$ make compose-up

# run migrations
$ make compose-migrate
```
There are few commands in Makefile to help you with this setup later.

# Test data
To seed database with test data (needed for local authorization) run seed command if you haven't already
``` sh
$ php artisan db:seed
```

# Requirements
- PHP 7.4
- Extensions:
    * sqlite3
    * zip
    * pgsql
    * dom
    * fileinfo
    * filter
    * iconv
    * json
    * libxml
    * mbstring
    * openssl
    * pcre
    * PDO
    * Phar
    * SimpleXML
    * tokenizer
    * xml
    * xmlwriter
- Composer
