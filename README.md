# Proyecto: Aplicación Web en PHP con API de Clima + Docker + Kubernetes

## Requisitos
- Windows 10/11
- Docker Desktop con Kubernetes habilitado
- PowerShell o Terminal
- Git instalado

## Cómo clonar el proyecto
git clone https://github.com/Sebastian09192/php-clima-k8s.git

cd php-clima-k8s


## Construcción de imagen Docker


docker build -t php-clima-api:v1 .


## Probar localmente en Docker


docker run -d -p 8080:80 --name php-clima-test php-clima-api:v1

Abrir: http://localhost:8080

## Despliegue en Kubernetes


kubectl apply -f k8s-deployment.yaml


## Verificar estado


kubectl get pods
kubectl get service php-clima-service


## Abrir en navegador
http://localhost:30080