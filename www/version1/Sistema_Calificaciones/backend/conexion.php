<?php
// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'db';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'secret';
$DATABASE_NAME = 'tfg';
$dsn = 'mysql:dbname=tfg;host=db;';

// Opciones de conexión a la base de datos
$opciones = array(PDO::MYSQL_ATTR_MULTI_STATEMENTS => true);

// Conexión a la base de datos
try {
    $conexion = new PDO($dsn, $DATABASE_USER, $DATABASE_PASS, $opciones);
} catch (PDOException $e) {
    echo "Error al conectar: " . $e->getMessage();
    exit; // Exit script on connection failure
}
