## K8S

Apply conf
```sh
kubectl apply -f dockerize_xapp_mysql_service/deployment.yml
kubectl apply -f dockerize_xapp_php_service/deployment.yml
kubectl apply -f dockerize_xapp_nginx_service/deployment.yml
```

deployment status
```sh
kubectl get pods
```
