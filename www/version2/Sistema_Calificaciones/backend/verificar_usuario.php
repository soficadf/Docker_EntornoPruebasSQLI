<?php

require_once "conexion.php";
session_start();

if (!isset($_POST['username'], $_POST['password'])) {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version2/Sistema_Calificaciones/index.php?status=3');
    exit;
}

$user=$_POST['username'];
$sql = "SELECT contraseña, rol FROM usuario WHERE usuario = '$user'";

$result = mysqli_query($conexion, $sql);
// Verificar si la consulta devuelve resultados
if ($result === false) {
    die("Error en la consulta: (" . mysqli_errno($conexion) . ") " . mysqli_error($conexion));
}
if ( mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    $password = $row["contraseña"];
    $rol = $row["rol"];
   
    if (password_verify($_POST['password'], $password)) {


        // la conexion sería exitosa, se crea la sesión
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['rol'] = $rol;
        $_SESSION['usuario'] = $_POST['username'];
       

        if( $_SESSION['rol']=='ALUMNO'){
             
             $conexion->close();
              header('Location: http://127.0.0.1/version2/Sistema_Calificaciones/alumno/inicio.php');
              exit;
        }else{
             
             $conexion->close();
              header('Location: http://127.0.0.1/version2/Sistema_Calificaciones/profesor/inicio.php');
              exit;
        }

    }else{
        //contraseña incorrecta
        session_unset();
        session_destroy();
        
        $conexion->close();
        header('Location: http://127.0.0.1/version2/Sistema_Calificaciones/index.php?status=1');
        exit;
    }
} else {

    // usuario incorrecto
    session_unset();
    session_destroy();
   
    $conexion->close();
    header('Location: http://127.0.0.1/version2/Sistema_Calificaciones/index.php?status=2');
    exit;
}


