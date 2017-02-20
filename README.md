# Docker for Devs Sample Application

This is a sample application to show to deploy an application to a Docker Swarm Mode cluster, using Docker Compose.

## Setup

1. Clone this repository locally
2. Start the application: `docker-compose up -d`
3. Install dependencies: `docker-compose run --entrypoint composer composer install`
4. Run the database migrations:
    1. Initialize config: `docker-compose run --entrypoint php -w /var/www phpserver vendor/bin/phinx init`
    2. Edit the development section of the `phinx.yml` file:
        * Change `host` to `mysqlserver`
        * Change `database` to `dockerfordevs`
        * Change `password` to `docker`
    3. Run migration: `docker-compose run --entrypoint php -w /var/www phpserver vendor/bin/phinx migrate`