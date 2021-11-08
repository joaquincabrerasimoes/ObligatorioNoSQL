# NoSQL

Proyecto para NoSQL 

Utilizamos PHP para hacer este proyecto, nos decantamos por usar codeigniter 4 como framework.

Una vez descargado el proyecto hay que correr 

```
composer install
```

asegurarnos que el php tenga los drivers de mongodb

luego para configurar el proyecto hay que editar e siguiente archivo 
```
app/Config/MongoConfig.php
```
una vez configurado
hay que correr en la consola desde la raiz del sitio
``` 
php spark serve
```

eso levanta un servidor web interno de php
al crear un usuario mongodb automaticamente crea la bd y la coleccion

una vez el servidor levantado es solo empezar a correr los endpoints
la coleccion de postman esta en la raiz del proyecto en un archivo llamado

```
nosql.postman_collection.json
```