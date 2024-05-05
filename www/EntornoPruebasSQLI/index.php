
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="styles\styleMenu.css">
    <link rel="stylesheet" href="styles\styleLogInMove.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  

    <div class="izquierda">
        <div class="titulo">
            <img src="images/logo7.png" alt="">
            <h1>ENTORNO DE PRUEBAS</br>ATAQUES SQL INJECTION</h1>
        </div>
        <footer>
    <p>&copy; 2024 Sofía Alejandra Cadenas Fernández. Todos los derechos reservados.</p>
</footer>
</div>
    <div class="derecha">
   
        <div class="opciones">
        <h3> ¡Descubre nuestro entorno de pruebas para ataques SQLi! </h3>

            <div class="text">Es un sistema de calificaciones de la universidad, pero con alguna brecha de seguridad <b>¿Podrás encontrarla? </b>
            </div>

            <div class= opizq>
            <div class="lineaicono">
                <div class="cuadro">
                    <img class="icono" src="images/icono.png" alt="">
                    <p class="textocuadro"> Sin medidas de seguridad</p>
                </div>
                <form action="http://127.0.0.1/version1/Sistema_Calificaciones/index.php" method="post">
                    <input type="submit" value="BAJO">
                </form>
            </div>
            <div class="lineaicono">
                <div class="cuadro">
                    <img class="icono" src="images/icono.png" alt="">
                    <p class="textocuadro">Conexión con MySQLi <br> Profesor: p.hernandez <br>contraseña: H230407</p>
                </div>
                <form action="http://127.0.0.1/version2/Sistema_Calificaciones/index.php" method="post">
                    <input type="submit" value="MEDIO">
                </form>
            </div>
            <div class="lineaicono">
                <div class="cuadro">
                    <img class="icono" src="images/icono.png" alt="">
                    <p class="textocuadro"> Escape de comillas y control de errores <br> Alumno: s.cadenas <br>contraseña: s.cadenas2002</p>
                </div>
                <form action="http://127.0.0.1/version3/Sistema_Calificaciones/index.php" method="post">
                    <input type="submit" value="ALTO">
                </form>
            </div>
            <div class="lineaicono">
                <div class="cuadro">
                    <img class="icono" src="images/icono.png" alt="">
                    <p class="textocuadro"> Declaraciones preparadas</p>
                </div>
                <form action="http://127.0.0.1/version4/Sistema_Calificaciones/index.php" method="post">
                    <input type="submit" value="IMPOSIBLE">
                </form>
            </div>
            </div>

            <div class="opder">
                    <h3> ¡Hay varios niveles de dificultad para desafiarte!</h3>
                    <div class="text">El sistema consta de dos tipos de usuario, profesor y alumno, si necesitas una pista extra, consulta nuestro icono de información.
             </div>
            </div>
        </div>
    </div>
    
    
</body>

</html>