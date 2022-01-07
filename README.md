TUI Weather APP
==========================

### Pilade Franceschi

This APP permits to update Weather Forecast for Musement Cities, using Weatherapi.
It's built on Symfony and implements "Backend tech homework" in this way:

1. Step 1, using Symfony Command
2. Step 2, using a Yaml file and a Controller to show file easily

Coding Standards are realized with PHP CS Fixer and PHPStan.

## Documentation

### Installation

Clone the repository and build a Docker image:

```console
$ git clone cd [PROJECT_DIR]
$ cd [PROJECT_DIR]
$ docker build -t tui:weather-app .
$ docker run -p 8000:8000 tui:weather-app
```

### Usage

For using Weather Update Command (Step 1):

```console
$ docker exec -it [CONTAINER ID] php bin/console tui:update-weather
```
For seeing API Design (Step 2):

```
Open a browser on http://localhost:8000
```

For running Tests:

```console
docker exec -it [CONTAINER ID] php ./vendor/bin/phpunit
```

For checking Coding Standards:

```console
docker exec -it [CONTAINER ID] vendor/bin/php-cs-fixer fix -v
docker exec -it [CONTAINER ID] vendor/bin/phpstan analyse -l 9 src
```

## Improvements / TODO List

- use Swagger Client Generator instead of Symfony Http Client
- UpdateWeatherCommand.execute returns always 1. Manage possible errors.
- add tests for API calls
- add tests for UpdateWeatherCommand