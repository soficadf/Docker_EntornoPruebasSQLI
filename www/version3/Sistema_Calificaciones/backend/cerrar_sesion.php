<?php
require_once "conexion.php";
session_start();

session_unset();
session_destroy();
header('Location: http://127.0.0.1/version3/Sistema_Calificaciones/index.php');