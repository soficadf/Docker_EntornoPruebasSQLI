<?php
session_start();

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['loggedin'])) {
    // Si el usuario ya ha iniciado sesión, cerrar la sesión y redireccionar a la página de inicio
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header('Location: index.php');
    exit;
}

$mensaje=NULL;
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case '1':
            $mensaje = 'Contraseña incorrecta!';
            break;
        case '3':
            $mensaje = 'Error! Vuelva a iniciar sesión';
            break;
        default:
            $mensaje = 'Usuario incorrecto!';
     
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles\styleLogIn.css">
    <link rel="stylesheet" href="styles\styleLogInMove.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   
    <img class="logo" src="images\LOGOTIPO.png" alt="Logo universidad">
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
   

    <div class="login">
       
        <h1>Sistema de Calificaciones</h1>
        <h3 style="text-align: center; color: #5b6574;"> Inicie sesión para acceder a sus calificaciones</h3>

     
        <form action="http://127.0.0.1/version2/Sistema_Calificaciones\backend\verificar_usuario.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username"
            placeholder="Usuario" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password"
            placeholder="Contraseña" id="password" required>
            <?php 
            if (!empty($mensaje)) echo '<div class="error">' . $mensaje . '</div>';
            ?>
            <input type="submit" value="Acceder">
        </form>
        
    </div>

    <div class="volverversiones">
        <a href="http://127.0.0.1/EntornoPruebasSQLI/index.php" class="logout"><i
                class="fas fa-sign-out-alt"></i> Volver a las versiones</a>
    </div>
  
</body>
</html>