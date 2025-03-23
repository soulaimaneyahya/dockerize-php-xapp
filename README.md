# dockerize-php-xapp

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
