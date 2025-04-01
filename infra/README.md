## K8S

Apply conf
```sh
kubectl apply -f k8s/deployments/dockerize_xapp_mysql.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_nginx.yaml
kubectl apply -f k8s/deployments/dockerize_xapp_php.yaml
```

deployment status
```sh
kubectl get pods
```
