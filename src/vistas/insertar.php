<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require '../includes/head.php';?>
    </head>
    <body>
        <?php require '../includes/header.php';?>
        <br/><br/>
        <?php require '../includes/abrirsesion.php'; ?>
        <div class="row justify-content-center">
            <h2>Nuevo Evento</h2>
        </div>
        <br/><br/>
        <div class="row justify-content-center">
            <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
            <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
            <?php endforeach; ?>
        </div>
        <br/>
        <div class="row justify-content-center">
                    <!--Comienzo de la estructura del formulario-->    
                    <form class="form-horizontal" method="POST" action="../vistas/index.php?accion=insertar" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm">
                                <!--cuadro de texto para recoger el nombre-->
                                <label for="fecha">Fecha</label>
                                <input type="text" class="form-control" id="fecha" name="fecha"
                                    required value="<?= $parametros["datos"]["fecha"] ?>"/>  
                            </div>
                            <div class="col-sm">
                                <!--cuadro de texto para recoger la contraseña-->
                                <label for="hora">Hora</label>
                                <input type="text" class="form-control" id="hora" name="hora"
                                    required value="<?= $parametros["datos"]["hora"] ?>"/>  
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm">
                                <!--cuadro de texto para recoger el nombre-->
                                <label for="nombre">titulo</label>
                                <input type="text" class="form-control" id="titulo" name="titulo"titulo
                                    required value="<?= $parametros["datos"]["titulo"] ?>"
                                />  
                            </div>
                            <div class="col-sm">
                                <!--cuadro de texto para recoger la contraseña-->
                                <label for="descripcion">descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion"
                                    required value="<?= $parametros["datos"]["descripcion"] ?>"  
                                />  
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm">
                                <!--cuadro de texto para recoger el nombre-->
                                <label for="prioridad">prioridad</label>
                                <input type="text" class="form-control" id="prioridad" name="prioridad"
                                    required value="<?= $parametros["datos"]["prioridad"] ?>"
                                />  
                            </div>
                            <div class="col-sm">
                                <!--cuadro de texto para recoger el nombre-->
                                <label for="lugar">lugar</label>
                                <input type="text" class="form-control" id="lugar" name="lugar"
                                    required value="<?= $parametros["datos"]["lugar"] ?>"
                                />  
                            </div>
                            <div class="col-sm">
                                <!--cuadro de texto para recoger la contraseña-->
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control-file" id="imagen" name="imagen"
                                    required value="<?= $parametros["datos"]["imagen"] ?>"  
                                />  
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <!--botones para enviar los datos recogidos en el formulario y para limpiar los campos-->
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary" name="boton">Enviar</button>
                            <button type="reset" class="btn btn-primary">Limpiar</button>
                        </div>
                    </form> <!--Fin del formulario-->
        </div>
    </body>
</html>