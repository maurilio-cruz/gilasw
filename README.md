# gilasw
Sistema de control de inventario de automóviles en el cual únicamente se podrá mostrar y agregar vehículos al sistema. 


El documento guia-gilasw.pdf muestra de manera muy breve el alcance general del proyecto.

# instalación de proyecto

    1. Clonar el proyecto

    git clone https://github.com/maurilio-cruz/gilasw.git

    2. En BD local aplicar los siguientes scripts


        CREATE DATABASE `gilasw`;

        USE `gilasw`;

        CREATE TABLE `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `data` blob NOT NULL,
        PRIMARY KEY (`id`),
        KEY `ci_sessions_timestamp` (`timestamp`)
        );

        CREATE TABLE `gilasw_vehiculos` (
        `vehiculo_k` int unsigned NOT NULL AUTO_INCREMENT,
        `tipo_vehiculo` enum('SEDAN','MOTOCICLETA') DEFAULT NULL,
        `numero_llantas` int unsigned DEFAULT '0',
        `potencia_motor` int DEFAULT '0',
        `activo` tinyint(1) NOT NULL DEFAULT '1',
        `usuario_creacion` int NOT NULL,
        `fecha_hora_creacion` datetime DEFAULT NULL,
        `usuario_modificacion` int DEFAULT NULL,
        `fecha_hora_modificacion` datetime DEFAULT NULL,
        `usuario_eliminacion` int DEFAULT NULL,
        `fecha_hora_eliminacion` datetime DEFAULT NULL,
        PRIMARY KEY (`vehiculo_k`)
        );

    3. Editar el Archivo gilasw/backend/.env  con las configuraciones adecuadas a tu entorno local

        database.default.hostname = localhost
        database.default.database = gilasw
        database.default.username = <<Colocar aqui nombre de usuario de local>
        database.default.password = <<Colocar aqui contraseña de BD de local>
        database.default.DBDriver = MySQLi
        database.default.DBPrefix =

# Backend

    1. Abrir una nueva terminal y acceder a la ruta gilasw/backend

    2. Ejecutar comando siguiente para instalar dependencias

            composer install

    3. Arrancar servicio con el comando

            php spark serve

    4. Despues de este paso el servicio se activa en http://localhost:8080

            CodeIgniter development server started on http://localhost:8080
            Press Control-C to stop.
            [Fri Jan 28 03:03:09 2022] PHP 7.4.3 Development Server (http://localhost:8080) started

    
# Front end

    1. Abrir una nueva terminal y acceder a la ruta gilasw/frontend

    2. Ejecutar comando siguiente para instalar dependencias

        npm install

    3. Arrancar el frontend con el comando

        ember server

    4. Despues de este paso el servicio se activa en http://localhost:4200/

        Build successful (19492ms) – Serving on http://localhost:4200/


# Acceder 

    Una vez que el backend y frontend esten funcionando, acceder desde navegador a la url

        http://localhost:4200/login


    las credenciales son:

        username:   administrador
        contraseña: gilasw


    Para este paso ya es posible acceder a la aplicación desde el navegador.

# Api publica


    Teniendo estos servicio arrancando las URL para listar y agregar datos son las siguientes:

        http://localhost:8080/index.php/gilasw/publicAPI/listarvehiculos


        http://localhost:8080/index.php/gilasw/publicAPI/agregarvehiculo


    Ambos utilizan el tipo de autenticacion:


        Basic Auth

    
    las credenciales son:

            username:   administrador
            contraseña: gilasw


    Para el servicio de agregar vehiculo se utilizan dos variables en POST:

        * tipo_vehiculo

                tipo vehiculo acepta uno de los dos siguientes valores:

                    MOTOCICLETA

                    SEDAN

        * potencia_motor

                potencia motor acepta valores numericos.


