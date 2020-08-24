# PHP sync and async html real-time messages

The project send push updates using php commands to a html page.

The pushes are sent using the [mercure protocol](https://mercure.rocks/).

The php commands are implemented using the [symfony/console dependency](https://symfony.com/doc/current/console.html) and use the [symfony/mercure-bundle](https://symfony.com/doc/current/mercure.html) to send the push updates.

The `SYNC commands` send the push update directly to the `index.html` which is an update's subscriber.

The `ASYNC commands` send the push update first to a `redis` which acts as a queue manager using the [symfony/messenger](https://symfony.com/doc/current/messenger.html). Then a handler needs to be executed to consume the queue and send the push update to the `index.html`.
There is the option to register as a subscriber using the [mercure local web interface](http://localhost:3000/).

- Tech stack
  - Docker
  - Php cli
  - Redis
  - Mercure

## Project setup

- Create file `.env` based on `.env.dist`

- Change the `JWT_KEY` with the secret use to generate the token and the `MERCURE_JWT_TOKEN` with the token itself. To generate the token visit [JWT token generator](https://jwt.io/#debugger-io?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InB1Ymxpc2giOlsiKiJdfX0.iHLdpAEjX4BqCsHJEegxRmO-Y6sMxXwNATrQyRNt3GY)

- Run the docker containers

  `docker-compose up`

- Install the dependencies

  `docker exec -i -t real-time.php-console composer install`

- Access to the mercure local web interface

  `open http://localhost:3000/`

- Open the index.html file

  `open public/index.html`

## Sync push updates

- To send one push update use the `real-time:publish-sync` command with the message content as an argument.

  `docker exec -i -t real-time.php-console bin/console real-time:publish-sync 'Hello sync world'`

- Observe that in the `index.html` the update has been displayed.

## Async push updates

- To send one push update use the `real-time:publish-async` with the message content as an argument.

  `docker exec -i -t real-time.php-console bin/console real-time:publish-async 'Hello async world'`

- Consume the redis queue

  `docker exec -i -t real-time.php-console bin/console messenger:consume`

- Observe that in the `index.html` the update has been displayed.

## Extra commands

### Redis

- To access to the redis

  `redis-cli`

- To see the length of messages in the redis queue

  `redis-cli`

  `XLEN messages`

- To see the information related to the redis queue

  `redis-cli`

  `XINFO messages`

### Mercure web server

- Click on [mercure local web server interface](`http://localhost:3000/`)

- Change the token for the one has been created previously

- Subscribe to the updates

### Other usefull docker commands

- Acces to a one container via shell

  `docker exec -i -t CONTAINER_NAME sh`

- Stop one container

  `docker stop CONATINER_NAME`

- Stop all the containers

  `docker stop $(docker ps -a -q)`

- List the current running containers

  `docker ps`

- List all the containers

  `docker ps -a`

- Remove one container

  `docker rm CONATINER_NAME`

- Remove all the containers

  `docker rm $(docker ps -a -q)`

- List the main docker images

  `docker images`

- List all the docker images

  `docker images -a`

- Remove one docker image

  `docker rmi IMAGE_NAME`

- Remove all the docker images

  `docker rmi $(docker ps -a -q)`
