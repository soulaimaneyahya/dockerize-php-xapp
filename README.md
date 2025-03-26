# dockerize-php-xapp

[![CI-CD](https://github.com/soulaimaneyahyax/dockerize-php-xapp/actions/workflows/ci-cd.yml/badge.svg)](https://github.com/soulaimaneyahyax/dockerize-php-xapp/actions/workflows/ci-cd.yml)

- [x] simple project dockerize php-nginx-mysql
- [x] simple php-code
- [ ] PHP posts APIs
- [ ] frontend js fetch backend APIs
- [ ] deploy k8s
- [ ] using haproxy as load balancer

docker hub images;

- https://hub.docker.com/r/soulaimaneyhcodpartner/dockerize_php
- https://hub.docker.com/r/soulaimaneyhcodpartner/dockerize_nginx
- https://hub.docker.com/r/soulaimaneyhcodpartner/dockerize_mysql

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

folder structure

```sh
├── docker-compose.yaml
├── infra/
│   ├── database/
│   │   ├── mysql/
│   │   │   ├── Dockerfile
│   │   │   ├── .env
│   └── web/
│       ├── nginx/
│       │   ├── Dockerfile
│       │   ├── nginx.conf
│       │   └── .env
│       └── php/
│           ├── composer.json
│           ├── config/
│           ├── Dockerfile
│           ├── .env
│           ├── public/
│           │   └── index.php
│           ├── src/
```

**resources**;
- [Managing Linode cloud K8s infra using Terraform - GitHub repo](https://github.com/soulaimaneyahyax/terraform-linode-k8s)
