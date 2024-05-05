<?php
// Verificar si se ha enviado el formulario
require_once "conexion.php";
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['rol']=='ALUMNO') {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version3/Sistema_Calificaciones/index.php?status=3');
    exit;
}

if (!isset($_POST['nota'])) {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version3/Sistema_Calificaciones/index.php?status=3');
    exit;
}

if (!empty($_POST['nota']) ) {
       
        $nota = filter_var($_POST['nota'], FILTER_VALIDATE_INT);

        if ($nota && $nota >= 0 && $nota <= 10) {
            $user=$_SESSION['alumno'];
            $asignatura=$_SESSION['asignatura'];
            $sql = "UPDATE cursa
                SET nota = $nota WHERE alumno_id = $user AND asignatura_id = $asignatura";

            $result = mysqli_query($conexion, $sql);
            $conexion->close();
            header('Location: http://127.0.0.1/version3/Sistema_Calificaciones/profesor/matriculados.php');
    }
    else{
        echo "Por favor, introduce una nota válida."; 
    }
} else {
        echo "Por favor, introduce una nota válida.";
    }

?>