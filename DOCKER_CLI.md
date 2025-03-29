docker hub images;

- https://hub.docker.com/r/soulaimaneyhcodpartner/dockerize_xapp_php_image
- https://hub.docker.com/r/soulaimaneyhcodpartner/dockerize_xapp_nginx_image
- https://hub.docker.com/r/soulaimaneyhcodpartner/dockerize_xapp_mysql_image

docker-compose cli
```sh
docker-compose down --rmi all -v
docker-compose up -d
```

docker cli
```sh
docker logs dockerize_xapp_nginx_container
docker logs dockerize_xapp_php_container

# subnet mask 255.255.255.0
docker network create --subnet=10.10.0.0/24 --gateway=10.10.0.1 app_network
docker network inspect app_network

docker exec -it dockerize_xapp_nginx_container /bin/sh
docker exec -it dockerize_xapp_php_container /bin/sh

docker exec -it dockerize_xapp_mysql_container /bin/sh
docker exec -it dockerize_xapp_mysql_container mysql -u user -p
```
