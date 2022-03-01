<html lang="es">
    <head>
        <?php require '../includes/head.php';?>
    </head>
    <body>
        <?php require '../includes/header.php';?>
        <br/><br/>
        <div class="row justify-content-center">
            <h2>Mi Agenda</h2>
            <?php

                session_start();

                //si se intenta acceder a esta página sin haberse logeado ni con la sesión abierta se redirige a login
                if (!isset($_SESSION["login"]) and !isset($_COOKIE["mantener"])){

                    Header('Location:../login.php?error=fuera');

                }

            ?>
        </div>
        <br/>
        <div class="row justify-content-center">
           
        </div>
    </body>
</html>