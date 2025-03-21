# dockerize-php-xapp

Docker build context is the project root, Docker will reference paths relative to the root

run docker-compose:

```sh
docker-compose down --rmi all -v
docker-compose up -d
```

logs
```sh
docker logs dockerize_nginx_container
docker logs dockerize_php_container

docker network inspect app_network

docker exec -it dockerize_nginx_container /bin/sh
```

```sh
Service php // built
Service nginx // built
Network dockerize-php-xapp_app_network // created
Container dockerize_php_container // Started
Container dockerize_nginx_container // Started
```
