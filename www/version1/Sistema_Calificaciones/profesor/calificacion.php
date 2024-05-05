<?php
require_once "../backend/conexion.php";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['rol']=='ALUMNO') {
    session_unset();
    session_destroy();
    $conexion=null;
    header('Location: http://127.0.0.1/version1/Sistema_Calificaciones/index.php?status=3');
    exit;
}

if (!isset($_POST['alumno'])) {
    session_unset();
    session_destroy();
    $conexion=null;
    header('Location: http://127.0.0.1/version1/Sistema_Calificaciones/index.php?status=3');
    exit;
}

$_SESSION['alumno']=$_POST['alumno'];
$alumno=$_POST['alumno'];
$asignatura=$_SESSION['asignatura'];
$nombreAsignatura=$_SESSION['nombre_asignatura'];


$result = $conexion->query("SELECT nota FROM cursa WHERE asignatura_id = '$asignatura' AND alumno_id= '$alumno'");
 
$row = $result->fetch(PDO::FETCH_ASSOC);
$nota=$row["nota"];


$result = $conexion->query("SELECT nombre,apellido FROM alumno WHERE matricula= '$alumno'");
 

$row = $result->fetch(PDO::FETCH_ASSOC);
$nombre=$row["nombre"];
$apellido=$row["apellido"];

$result->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificación</title>
    <link rel="stylesheet" href="http://127.0.0.1/version1/Sistema_Calificaciones/styles/styleOthers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="loggedin">
    <div class="content2">
         <nav class="navtop">
            <a href="http://127.0.0.1/version1/Sistema_Calificaciones/backend/cerrar_sesion.php" class="logout" ><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav> 
     

        <?php if (empty($nota)) {
    // Si la variable $nota está vacía, mostrar un cuadro de texto para introducir la nota

    echo '<div class="info">
    <h2> Si desea calificar a '.$nombre .'  '. $apellido. ' en la asignatura '. $_SESSION['nombre_asignatura'].', puede hacerlo aquí:</h2>  
        </div>';
    echo ' <div class="formulario"> <form action="http://127.0.0.1/version1/Sistema_Calificaciones/backend/procesar_nota.php" method="post">
            <label for="nota">Introduce nota:</label>
            <input type="text" id="nota" name="nota">
            <input type="submit" value="Guardar">
          </form></div>';
} else {
    // Si la variable $nota tiene un valor numérico, mostrar un mensaje con la nota y un cuadro de texto para modificarla
    echo '<div class="info">
    <h2> El alumno '.$nombre .'  '. $apellido.' ya tiene una nota de '. $nota .' en la asignatura '.$_SESSION['nombre_asignatura'].'</h2><h2> Si desea modificarla, puede hacerlo aquí:</h2>  
        </div>';
    echo '<div class="formulario"><form action="http://127.0.0.1/version1/Sistema_Calificaciones/backend/procesar_nota.php" method="post">
            <label for="nota">Modificar nota:</label>
            <input type="text" id="nota" name="nota" value="' . $nota . '">
            <input type="submit" value="Guardar">
          </form></div>';
}
    $conexion=null;
?>

    

        <button class="boton-volver" onclick="window.location.href = 'matriculados.php'">
        <i class="fas fa-arrow-left"></i> Volver
    </button>
    </div>

    <div class=foto2 style="background-image: url('http://127.0.0.1/version1/Sistema_Calificaciones/images/2.png');">
        <img src="http://127.0.0.1/version1/Sistema_Calificaciones/images/LOGOTIPO.png" alt="logo universidad">
    </div>
</div>

</body>

</html>   
