<?php
require_once "../backend/conexion.php";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['rol']=='PROFESOR') {

    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version2/Sistema_Calificaciones/index.php?status=3');
    exit;
}
$user=$_SESSION['usuario'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="http://127.0.0.1/version2/Sistema_Calificaciones/styles/styleOthers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="loggedin">
    
    <div class=foto>
        <img src="http://127.0.0.1/version2/Sistema_Calificaciones/images/LOGOTIPO.png" alt="logo universidad">
    </div>

    <div class="content">
         <nav class="navtop">
            <a href="http://127.0.0.1/version2/Sistema_Calificaciones/backend/cerrar_sesion.php" class="logout" ><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav> 
        <div class="info">
            <h1>Bienvenido a nuestra plataforma de calificaciones</h1>
            <h2> Aquí podrá ver sus calificaciones por asignatura </h2>  
        </div>

        <div class=formulario>
         <p>En la lista desplegable se encuentran las materias que cursa este trimestre. Seleccione la que desea ver y pulse en 'Buscar' para obtener su nota.</p>

        <form method="post" action="calificacion.php">
            <label for="asignatura">Asignatura</label>
            <select name="asignatura">
            <?php
            // Consulta para obtener las asignaturas de la base de datos
           
            $sql = "SELECT asignatura.nombre,asignatura.id
            FROM asignatura
            JOIN cursa ON asignatura.id = cursa.asignatura_id
            JOIN alumno ON cursa.alumno_id = alumno.matricula
            JOIN usuario ON alumno.usuario_id = usuario.usuario
            WHERE usuario.usuario = '$user';";
            

            $result = mysqli_query($conexion, $sql);
       
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=".$row["id"].">". $row["nombre"]."</option>";
                }

                echo "</select>
                <input type='submit' value='Buscar'>";
            } else {
                echo "<option value=\"\">No hay asignaturas disponibles</option></select>";
            }
            $conexion->close();
            ?>
             
        </form>
    </div></div>

</body>

</html>