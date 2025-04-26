## K8S

Apply all
```sh
kubectl apply -R -f ./k8s
```

Apply deployments conf
```sh
kubectl apply -f k8s/deployments/dockerize_xapp_mysql.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_redis.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_nginx.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_php.yaml
```

Scale deployment
```sh
kubectl scale deployment dockerize-xapp-mysql-service --replicas=3
kubectl scale deployment dockerize-xapp-redis-service --replicas=3
kubectl scale deployment dockerize-xapp-nginx-service --replicas=3
kubectl scale deployment dockerize-xapp-php-service --replicas=3
```

Apply services conf
```sh
kubectl apply -f k8s/services/dockerize_xapp_mysql_service.yaml
kubectl apply -f k8s/services/dockerize_xapp_redis_service.yaml
kubectl apply -f k8s/services/dockerize_xapp_nginx_service.yaml
kubectl apply -f k8s/services/dockerize_xapp_php_service.yaml
```

HPA
```sh
kubectl apply -f k8s/hpa/dockerize_xapp_nginx_hpa.yaml
```

HPA CLI
```sh
kubectl autoscale deployment dockerize-xapp-nginx-service --cpu-percent=50 --min=1 --max=10
```

vpa
```sh
kubectl apply -f k8s/vpa/dockerize_xapp_mysql_vpa.yaml
kubectl apply -f k8s/vpa/dockerize_xapp_redis_vpa.yaml
```

Apply secrets conf
```sh
kubectl apply -f k8s/secrets/dockerize_xapp_mysql_secrets.yaml
```

Apply pvc conf
```sh
kubectl apply -f k8s/pvc/dockerize_xapp_mysql_pv.yaml
kubectl apply -f k8s/pvc/dockerize_xapp_mysql_pvc.yaml
```

deployment status
```sh
// kubectl get all
kubectl get pods
kubectl get services
kubectl get pvc
kubectl get pv
kubectl get secrets
kubectl get hpa
```

kubectl
```sh
kubectl exec -it x-pod -- /bin/sh
```
