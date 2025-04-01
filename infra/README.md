## K8S

Apply deployments conf
```sh
kubectl apply -f k8s/deployments/dockerize_xapp_mysql.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_redis.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_nginx.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_php.yaml
```

Apply services conf
```sh
kubectl apply -f k8s/services/dockerize_xapp_mysql_service.yaml
kubectl apply -f k8s/services/dockerize_xapp_redis_service.yaml
kubectl apply -f k8s/services/dockerize_xapp_nginx_service.yaml
kubectl apply -f k8s/services/dockerize_xapp_php_service.yaml
```

Apply pvc conf
```sh
kubectl apply -f k8s/pvc/dockerize_xapp_mysql_pv.yaml
kubectl apply -f k8s/pvc/dockerize_xapp_mysql_pvc.yaml
```

deployment status
```sh
kubectl get pods
kubectl get services
kubectl get pvc
kubectl get pv
```
