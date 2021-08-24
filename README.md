# API para la administración de facturas

Este proyecto contiene el microservicio de facturas para la adminsitracion de facturas

## Comenzando 

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._


### Pre-requisitos 📋

```
Para configurar el proyecto necesitas:

Docker
```

### Instalación 🔧
Ir a la raiz del proyecto

* Configurar las variables de entorno

```
IVA_PERCENT = Porcentaje de iva para el calculo de impuestos)
APP_KEY= Key de la app (debe coincidir con el key del proyecto bill-gateway-api)

Configurar las variables y credenciales para la conexion a base de datos, correo electronico y RabbitMQ

Puede tomar el archivo .env.example y complementarlo
```

* Asegurarnos que existe la red "bill-network" si no existe correr el siguiente comando
```
> docker network create bill-network
```

* Ejecutar el siguiente comando para levantar el contenedor de lumen
```
>docker-compose up
```

## Construido con 🛠️

* [Lumen](https://lumen.laravel.com/docs/8.x) - El framework web usado
* [Composer](https://getcomposer.org/doc/) - Manejador de dependencias
* [RabbitMQ](https://www.rabbitmq.com/documentation.html) - Manejo de colas

## Autor ✒️

* **Andrés Duque** - [andres-duque](https://github.com/andresmanuelduque)
