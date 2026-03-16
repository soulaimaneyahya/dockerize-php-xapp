<div align="center">

# dockerize-php-xapp

[![CI-CD](https://github.com/soulaimaneyahya/dockerize-php-xapp/actions/workflows/ci-cd.yaml/badge.svg)](https://github.com/soulaimaneyahya/dockerize-php-xapp/actions/workflows/ci-cd.yaml)

</div>

<img src="./imgs/x.png" alt="php mysql mysql redis nginx docker k8s" />

- [x] simple project dockerize php-nginx-mysql
- [x] simple php-code
- [x] redis-database
- [x] deploy k8s

project folder structure

```sh
├── docker-compose.yaml
├── services/
│   ├── database/
│   │   ├── mysql/
│   │   │   ├── Dockerfile
│   │   │   ├── .env
│   │   ├── redis/
│   │   │   ├── Dockerfile
│   │   │   ├── .env
│   └── web/
│       ├── nginx/
│       │   ├── Dockerfile
│       │   ├── nginx.conf
│       │   ├── fastcgi_params
│       │   └── .env
│       └── php/
│           ├── public/
│           │   └── index.php
│           ├── src/
│           ├── composer.json
│           ├── Dockerfile
│           ├── .env
├── infra/
│   ├── k8s/
│       ├── deployments/
│       └── services/
```

**resources**;
- [Managing Linode cloud K8s infra using Terraform - GitHub repo](https://github.com/soulaimaneyahyax/terraform-linode-k8s)
