<?php

require_once "conexion.php";
session_start();

if (!isset($_POST['username'], $_POST['password'])) {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=3');
    exit;
}

try {
    $stmt = $conexion->prepare('SELECT contraseña,rol FROM usuario WHERE usuario = ?');
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($password, $rol);
        $stmt->fetch();

        if (password_verify($_POST['password'], $password)) {


            // la conexion sería exitosa, se crea la sesión
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['rol'] = $rol;
            $_SESSION['usuario'] = $_POST['username'];
            $stmt->close();
    
            if( $_SESSION['rol']=='ALUMNO'){
                  $conexion->close();
                  header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/alumno/inicio.php');
                  exit;
            }else{
                  $conexion->close();
                  header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/profesor/inicio.php');
                  exit;
            }
     
        }else{
            //contraseña incorrecta
            session_unset();
            session_destroy();
            $stmt->close();
            $conexion->close();
            header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=1');
            exit;
        }
    } else {
        // usuario incorrecto
        session_unset();
        session_destroy();
        $stmt->close();
        $conexion->close();
        header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=2');
        exit;
    }

} catch (Exception $e) {
    $conexion->close();
    header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=3');
    exit;
}



