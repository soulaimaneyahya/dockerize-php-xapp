<div align="center">

# dockerize-php-xapp

[![CI-CD](https://github.com/soulaimaneyahya/dockerize-php-xapp/actions/workflows/ci-cd.yml/badge.svg)](https://github.com/soulaimaneyahya/dockerize-php-xapp/actions/workflows/ci-cd.yml)

</div>

- [x] simple project dockerize php-nginx-mysql
- [x] simple php-code
- [x] redis-database
- [ ] deploy k8s
- [ ] using haproxy as load balancer

folder structure

```sh
├── docker-compose.yaml
├── infra/
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
