# Entorno de Pruebas SQL Injection

Este repositorio contiene un entorno Dockerizado para realizar pruebas de SQL Injection de forma segura.

## Pasos para usar el entorno:

1. **Clona el repositorio**:
   Clona este repositorio en tu máquina local utilizando el siguiente comando:

git clone 

2. **Instala Docker Desktop**:
Asegúrate de tener instalado Docker Desktop en tu sistema. Puedes descargarlo e instalarlo desde [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop).

3. **Inicia los contenedores Docker**:
Abre la consola y navega hasta la carpeta del repositorio clonado. Luego, ejecuta el siguiente comando para iniciar los contenedores Docker en segundo plano:

docker-compose up -d


4. **Espera unos minutos a que cargue la base de datos**:
La base de datos y la aplicación pueden tardar unos minutos en inicializarse completamente. Por favor, sé paciente y espera a que los contenedores se carguen por completo. Es posible que existan errores de conexión con la base de datos los primeros minutos.

5. **Accede a la aplicación**:
Una vez que los contenedores estén en funcionamiento, abre tu navegador web e ingresa la siguiente URL en la barra de direcciones:

http://127.0.0.1/EntornoPruebasSQLI/index.php


Esto te llevará a la aplicación donde podrás realizar pruebas de SQL Injection de forma segura.

¡Listo! Ahora estás listo para comenzar a utilizar el entorno de pruebas de SQL Injection. Si tienes alguna pregunta o encuentras algún problema, no dudes en abrir un issue en este repositorio.

