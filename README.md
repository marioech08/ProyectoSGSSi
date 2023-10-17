# Web: Portal de Asignaturas

## Integrantes:

- Pablo Martinez Diez
- Pablo Leclerc
- Mario Echavarri
- Eneko Uresandi

## Como abrir el proyecto

Situar la terminal dentro de la carpeta donde esta el proyecto

Asegúrate de tener Docker instalado. Si no lo tienes, puedes instalarlo con el siguiente comando:
```bash
$ apt-get install docker
```

Crea la imagen llamada "web" ejecutando el siguiente:
```bash
$ docker-build -t="web" .
```

Inicia los contenedores con el siguiente comando:
```bash
$ docker-compose up -d
```
Para comprobar que se te ha iniciado puedes ejecutar este comando:
```bash
$ docker ps
```

Abre tu navegador web y visita http://localhost:8890/.

Inicia sesión con las siguientes credenciales:
    Usuario: admin
    Contraseña: test

Haz clic en database y luego selecciona importar. Después, elige el archivo database.sql situado en la carpeta del proyecto.

Accede a http://localhost:81/ en tu navegador.

Si deseas detener el proyecto, abre otra terminal y ejecuta el siguiente comando:
```bash
$ docker-compose down
```
