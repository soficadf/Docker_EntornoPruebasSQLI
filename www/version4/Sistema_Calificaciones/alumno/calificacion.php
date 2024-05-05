<?php
session_start();
require_once "../backend/conexion.php";


if (!isset($_SESSION['loggedin']) || $_SESSION['rol']=='PROFESOR') {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=3');
    exit;
}

if (!isset($_POST['asignatura'])) {
    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=3');
    exit;
}



$_SESSION['asignatura']=$_POST['asignatura'];

try{
$stmt = $conexion->prepare('SELECT nota FROM cursa WHERE asignatura_id = ? AND alumno_id= (SELECT matricula
FROM alumno
WHERE usuario_id = ?)');

$stmt->bind_param('is', $_SESSION['asignatura'], $_SESSION['usuario']);
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($nota);
$stmt->fetch();
}catch(Exception $e){}

try{
$stmt = $conexion->prepare('SELECT nombre FROM asignatura WHERE id = ?');

$stmt->bind_param('i', $_SESSION['asignatura']);
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($nombreAsignatura);
$stmt->fetch();
}catch (Exception $e){}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <link rel="stylesheet" href="http://127.0.0.1/version4/Sistema_Calificaciones/styles/styleOthers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="loggedin">
    <div class="content2">
         <nav class="navtop">
            <a href="http://127.0.0.1/version4/Sistema_Calificaciones/backend/cerrar_sesion.php" class="logout" ><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav> 
        <div class="info">
            <h2> Aquí podrá ver su calificación </h2>  
        </div>

        <?php if (empty($nota)) {
    // Si la variable $nota está vacía, mostrar un cuadro de texto para introducir la nota
    echo '
        <div class="result">
          <h2 >Lo sentimos, aun no ha sido calificado en la asignatura '.$nombreAsignatura.'</h2>
        </div> ';
        }else{
            echo '
        <div class="result">
          <h2 >Ha obtenido una calificación de '. $nota. ' en la asignatura '.$nombreAsignatura.' </h2>
        </div> ';

        } 
        $conexion->close();
        $stmt->close();?>

        <button class="boton-volver" onclick="window.location.href = 'inicio.php'">
        <i class="fas fa-arrow-left"></i> Volver
    </button>
    </div>

    <div class=foto2>
        <img src="http://127.0.0.1/version4/Sistema_Calificaciones/images/LOGOTIPO.png" alt="logo universidad">
    </div>
</div>

</body>

</html>   
