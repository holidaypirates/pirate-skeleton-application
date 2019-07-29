# Pirate Skeleton Application
[![Quality Score][ico-scrutinizer]][link-scrutinizer]
[![Build Status][ico-travis]][link-travis]
![PHP from Travis config](https://img.shields.io/travis/php-v/holidaypirates/pirate-skeleton-application?style=flat-square)
## About
Ahoy pirate ! This is an simple PHP skeleton application (based on Zend Expressive) that is ready to sail in AWS Lightsail !  
It comes with the features working out of the box to make it easier for you to spin your new webservice:

- PSR-7 Response caching layer
- CLI Command application
- Integration and Unit tests already configured
- One line command spins up the whole application
- Logger (Monolog) and (Bugsnag)
- Integration test to test your Swagger/OpenApi file against the response

## Skeleton Start list
In order to start your project there is a checklist of items that you must replace to before start coding:
- Search for all instances of `pirate-application` and replace with your application name in lower case.
- Search for all instances of `pirate-app` and replace with your application name in lower case as in to be used by a url.
- Search for all instances of `PirateApplication` and replace with your application name in camel case.
- Rename the `src/PirateApplication`, `test/PirateApplicationIntegrationTest` and `test/PirateApplicationUnitTest` to the namespace corresponding to your project.

Now you can follow the `Installation section to setup your`

## Installation
- Install Docker on your computer (https://www.docker.com/get-started)
- Add the PirateApplication entry on your `/etc/hosts` file:
- Optional : Install Composer on your computer to make it easier
```
127.0.0.1	pirate-app.local
```
1 - Copy the `.env.example` file:
```bash
$ cp .env.example .env
```
2 - Run composer install:
```bash
$ composer install
```
> Alternatively you can run composer inside a docker machine:
```bash
$ docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install
```
3 - Run docker-compose up:
```bash
$ docker-compose up
```
> Alternatively you can run `composer up` if you have composer installed locally.

You can then browse to http://pirate-app.local/api/v1/ping . You should be able to see JSON ack response.

4 - Run Migrations and Seeds:
```bash
$ composer commander migrations:migrate
```

## Composer scripts:
- `composer up` : Serves the application (equals to `docker-composer up -d`)
- `composer ps` : Shows Docker images currently running.
- `composer stop`: Stops the application serving (equals to `docker-compose stop`)
- `composer check` : Runs PHPCS, PHPUNIT and PHPSTAN
- `composer coverage-html`: Generates HTML coverage and opens it on your browser.

## Application Development Mode Tool

This Application comes with [zf-development-mode](https://github.com/zfcampus/zf-development-mode). 
It provides a composer script to allow you to enable and disable development mode.

### To enable development mode

**Note:** Do NOT run development mode on your production server!

Local composer:
```bash
$ composer development-enable
```

**Note:** Enabling development mode will also clear your configuration cache, to 
allow safely updating dependencies and ensuring any new configuration is picked 
up by your application.

### To disable development mode

```bash
$ composer development-disable
```

### Development mode status

```bash
$ composer development-status
```

## Configuration caching

By default, the skeleton will create a configuration cache in
`data/config-cache.php`. When in development mode, the configuration cache is
disabled, and switching in and out of development mode will remove the
configuration cache.

You may need to clear the configuration cache in production when deploying if
you deploy to the same directory. You may do so using the following:

```bash
$ composer clear-config-cache
```

You may also change the location of the configuration cache itself by editing
the `config/config.php` file and changing the `config_cache_path` entry of the
local `$cacheConfig` variable.

## Testing
```bash
$ composer check
```

## CLI Tool
```bash
$ composer commander
```
or if you don't have composer locally:
```bash
$ docker-compose run php php /code/bin/commander.php
```

## Running the CLI (Commander) in Production:
Go to AWS lightsail's instance and SSH into it:
```bash
cd pirate-app
docker-compose -f docker-compose-production.yml run php php /code/bin/commander.php
```

## Redis CLI
In order to connect to the Redis CLI run :
```bash
docker-compose run redis redis-cli -h redis
```

> The documentation of Redis can be seem in https://redis.io/commands

## Profiling and Profiling monitor
Update your `docker-compose.yml` to enable XDebug profiling then go to http://pirate-app.local:8081 and you should be able to view your xdebug profiler logs.

[ico-travis]: https://img.shields.io/travis/holidaypirates/pirate-skeleton-application/master.svg?style=flat-square
[ico-scrutinizer]: https://scrutinizer-ci.com/g/holidaypirates/pirate-skeleton-application/badges/quality-score.png?b=master
[link-travis]: https://travis-ci.org/holidaypirates/pirate-skeleton-application
[link-scrutinizer]: https://scrutinizer-ci.com/g/holidaypirates/pirate-skeleton-application/code-structure
