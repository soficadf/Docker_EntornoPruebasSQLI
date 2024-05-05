<?php
// Verificar si se ha enviado el formulario
require_once "conexion.php";
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['rol']=='ALUMNO') {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=3');
    exit;
}

if (!isset($_POST['nota'])) {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=3');
    exit;
}

if (!empty($_POST['nota'])) {
       
  
    $nota = filter_var($_POST['nota'], FILTER_VALIDATE_INT);

    if ($nota && $nota >= 0 && $nota <= 10) {
        try{
        $sql = "UPDATE cursa
        SET nota = ?
        WHERE alumno_id = ? AND asignatura_id = ?";

        // Preparar la sentencia SQL
        $stmt = $conexion->prepare($sql);
        // Vincular los parámetros
        $stmt->bind_param("iii",  $_POST['nota'], $_SESSION['alumno'], $_SESSION['asignatura']);
        $stmt->execute();
        $stmt->close();
    }catch(Exception $e) {}

        $conexion->close();
        header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/profesor/matriculados.php');
    } else {
        echo "Por favor, introduce una nota válida.";
    }
}
else{
        echo "Por favor, introduce una nota válida.";
    }

?>