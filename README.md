# dockerize-php-xapp

- [x] simple project dockerize php-nginx-mysql
- [] deploy k8s
- [] using haproxy as load balancer

docker-compose cli
```sh
docker-compose down --rmi all -v
docker-compose up -d
```

docker cli
```sh
docker logs dockerize_nginx_container
docker logs dockerize_php_container

docker network inspect app_network

docker exec -it dockerize_nginx_container /bin/sh
docker exec -it dockerize_php_container /bin/sh
docker exec -it dockerize_mysql_container /bin/sh
```

**resources**;
- [Managing Linode cloud K8s infra using Terraform - GitHub repo](https://github.com/soulaimaneyahyax/terraform-linode-k8s)
