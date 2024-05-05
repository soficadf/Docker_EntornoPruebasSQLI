<?php


require_once "../backend/conexion.php";
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['rol']=='ALUMNO') {

    session_unset();
    session_destroy();
    $conexion->close();
    header('Location: http://127.0.0.1/version4/Sistema_Calificaciones/index.php?status=3');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
 
    <link rel="stylesheet" href="http://127.0.0.1/version4/Sistema_Calificaciones/styles/styleOthers.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="loggedin">
    
    <div class=foto style="background-image: url('http://127.0.0.1/version4/Sistema_Calificaciones/images/2.png');">
        <img src="http://127.0.0.1/version4/Sistema_Calificaciones/images/LOGOTIPO.png" alt="Logo de la universidad">
    </div>

    <div class="content">
         <nav class="navtop">
            <a href="http://127.0.0.1/version4/Sistema_Calificaciones/backend/cerrar_sesion.php" class="logout" ><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </nav> 
        <div class="info">
            <h1>Bienvenido a nuestra plataforma de calificaciones</h1>
            <h2> Aquí podrá acceder a las asignaturas que imparte y calificar a sus alumnos </h2>  
        </div>

        <div class=formulario style="margin-bottom:5%;">
         <p>En la lista desplegable se encuentran las materias que imparte este trimestre. Seleccione la que desea ver y pulse en 'Buscar' para obtener los alumnos matriculados.</p>

        <form method="post" action="matriculados.php">
            <label for="asignatura">Asignatura</label>
            <select name="asignatura">
            <?php
            // Consulta para obtener las asignaturas de la base de datos
            try{
            $sql = "SELECT asignatura.nombre,asignatura.id
            FROM asignatura
            JOIN imparte ON asignatura.id = imparte.asignatura_id
            JOIN profesor ON imparte.profesor_id = profesor.id
            JOIN usuario ON profesor.usuario_id = usuario.usuario
            WHERE usuario.usuario = ?;";
            

            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $_SESSION['usuario']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row["id"] . ">" . $row["nombre"] . "</option>
                    ";
                }
                echo "</select>
                <input type='submit' value='Buscar'>";
            } else {
                echo "<option value=\"\">No hay asignaturas disponibles</option></select>";
            }
            $stmt->close();}
            catch(Exception $e){}
            $conexion->close();
            ?>
             
        </form>
    </div></div>

</body>

</html>