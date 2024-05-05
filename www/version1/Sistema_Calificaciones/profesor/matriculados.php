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

if (!isset($_POST['asignatura']) && !isset($_SESSION['asignatura'])) {
    session_unset();
    session_destroy();
    $conexion=null;
    header('Location: http://127.0.0.1/version1/Sistema_Calificaciones/index.php?status=3');
    exit;
}

if (!isset($_POST['asignatura']))$_POST['asignatura']=$_SESSION['asignatura'];


$_SESSION['asignatura']=$_POST['asignatura'];
$asignatura=$_POST['asignatura'];
$user=$_SESSION['usuario'];


$result = $conexion->query("SELECT nombre FROM asignatura WHERE id = '$asignatura'");
$row = $result->fetch(PDO::FETCH_ASSOC);
$nombreAsignatura=$row["nombre"];

$_SESSION['nombre_asignatura']=$nombreAsignatura;

$result->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <link rel="stylesheet" href="http://127.0.0.1/version1/Sistema_Calificaciones/styles/styleOthers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="loggedin">
    
    <div class=foto style="background-image: url('http://127.0.0.1/version1/Sistema_Calificaciones/images/2.png');">
        <img src="http://127.0.0.1/version1/Sistema_Calificaciones/images/LOGOTIPO.png" alt="Logo de la universidad">
    </div>

    <div class="content">
         <nav class="navtop">
            <a href="http://127.0.0.1/version1/Sistema_Calificaciones/backend/cerrar_sesion.php" class="logout" ><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav> 
        <div class="info">
            <h2> Aquí se muestra una lista de los alumnos matriculados en <?php echo $nombreAsignatura ?> </h2>  
        </div>

        <div class=formulario style="margin-bottom:5%;">
         <p>Seleccione un alumno para calificarlo o visualizar su calificación.</p>

        <form method="post" action="calificacion.php">
            <label for="alumno">Alumno</label>
            <select name="alumno">
            <?php
            
           
            $sql = "SELECT alumno.matricula, alumno.nombre, alumno.apellido
            FROM alumno
            INNER JOIN cursa ON alumno.matricula = cursa.alumno_id
            WHERE cursa.asignatura_id = '$asignatura'
            ;";
            
            $result = $conexion->query($sql);
           
           
            if ($result->rowCount()> 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $row["matricula"] . ">" . $row["nombre"] . " " . $row["apellido"] . "</option>";
                }
                echo " </select>
                       <input type='submit' value='Buscar'>";
            } else {
                echo "<option value=/"/">No hay alumnos disponibles</option></select>";
            }
            $result->closeCursor();
            $conexion=null;
            ?>
            
        </form>
    </div>
    <button class="boton-volver" onclick="window.location.href = 'inicio.php'">
        <i class="fas fa-arrow-left"></i> Volver
    </button>
</div>

</body>

</html>