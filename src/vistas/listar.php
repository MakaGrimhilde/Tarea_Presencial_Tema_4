<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require '../includes/head.php';?>
    </head>
    <body>
        <?php require '../includes/header.php';?>
        <br/><br/>
        <div class="row justify-content-center">
            <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
                <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php endforeach; ?>
        </div>
        <br/>
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <table class="table table-striped text-center">
                    <tr>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Prioridad</th>
                        <th>Lugar</th>
                        <th>Operaciones</th>
                    </tr>
                    <!--bucle foreach que recorre toda la tabla y recoge los elementos que se encuentren en nick, nombre, 
                    apellidos, email e imagen-->
                    <?php foreach($parametros["datos"] as $re){ { ?> 

                    <tr>
                        <td><?=$re["titulo"]?></td>
                        <td><?=$re["fecha"]?></td>
                        <td><?=$re["hora"]?></td>
                        
                        <td>
                            <?php
                                if ($re["imagen"] != null){

                                    echo '<img src="../fotos/'.$re["imagen"].'" width="50"/>';

                                }
                            ?>
                        </td>
                        <td><?=$re["descripcion"]?></td>
                        <td><?=$re["prioridad"]?></td>
                        <td><?=$re["lugar"]?></td>
                        <td><a href="../vistas/index.php?accion=actualizar&id=<?= $re['id'] ?>">Editar</a>&nbsp;&nbsp;
                        <a href="../vistas/index.php?accion=eliminar&id=<?= $re['id'] ?>">Eliminar</a>&nbsp;&nbsp;
                        <a href="../vistas/index.php?accion=listarUsuario&id=<?=$re["id"]?>">Detalle</a>
                        </td>
                    </tr>

                    <?php } } ?>
                </table>
                <br/>
                <?php include '../includes/paginacion.php';?>
            </div>
        </div>
    </body>
</html>