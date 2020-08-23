# real-time

`docker-compose up`
`open index.html`

# Sync

`docker exec -i -t real-time.php-console bin/console real-time:publish-sync 'Hello sync world'`

# Async

`docker exec -i -t real-time.php-console bin/console real-time:publish-async 'Hello async world'`
`docker exec -i -t real-time.php-console bin/console messenger:consume`
`redis-cli`
`XLEN messages`
`XINFO messages`

# Mercure web server

`http://localhost:3000/`

# Other usefull docker commands

`docker exec -i -t CONTAINER_NAME sh`
`docker stop CONATINER_NAME`
`docker ps`
`docker ps -a`
`docker rm CONATINER_NAME`
`docker rm $(docker ps -a -q)`
`docker images`
`docker images -a`
`docker rmi IMAGE_NAME`
`docker rmi $(docker ps -a -q)`
