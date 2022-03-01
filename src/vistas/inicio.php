<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require '../includes/head.php';?>
    </head>
    <body>
        <?php require '../includes/header.php';?>
        <?php require '../includes/abrirsesion.php';?>
        <br/><br/>
        <div class="row justify-content-center">
            <h2>Mi Agenda</h2>
        </div>
        <br/>
        <div class="row justify-content-center">
            <button type="button" class="btn btn-primary" onclick="location.href='../vistas/index.php?accion=listar'">Mostrar Eventos</button>
            <button type="button" class="btn btn-primary" onclick="location.href='../vistas/index.php?accion=insertar'">Nuevo evento</button>
        </div>
    </body>
</html>