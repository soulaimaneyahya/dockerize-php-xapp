# dockerize-php-xapp

run docker-compose:

```sh
docker-compose up -d
```

down:

```sh
docker-compose down --rmi all -v
```

logs
```sh
docker logs dockerize_nginx_container
docker logs dockerize_php_container

docker exec -it dockerize_nginx_container /bin/sh
```
