<?php

require '../modelo/modelo.php'; //se añade la clase modelo para poder acceder a sus métodos

class controlador{

    private $modelo;
    private $mensajes;

    /**
     * Constructor de la clase Controlador, inicializa el objeto modelo y el array de mensajes
     */
    public function __construct(){

        
        $this->modelo = new modelo(); //creación de un objeto modelo
        $this->mensajes = []; //array que almacenará los mensajes que aparecerán según cada acción que se realice

    }

    public function index(){

        $parametros = ["titulo" => "Mis Tareas"];
        
        //se muestra la página login.php
        include_once '../vistas/login.php';
    }

    public function insertar(){

        $errores = array(); //array para almacenar los errores que se puedan generar

        //si se ha pulsado el botón del formulario y ha recibido datos
        if (isset($_POST) && !empty($_POST) && isset($_POST["boton"])){

            //se almacenan en las variables los valores que se obtengan de cada campo del formulario
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];
            $prioridad = $_POST["prioridad"];
            $imagen = NULL;


            //IMAGEN
            //si existe un archivo tipo imagen y no está vacío el campo
            if (isset($_FILES["imagen"]) and (!empty($_FILES["imagen"]["tmp_name"]))){

                if (!is_dir("fotos")){ //si no existe un directorio llamado 'fotos', lo creará

                    $carpeta = mkdir("fotos", 0777, true);

                } else {

                    $carpeta = true;
                }

                if ($carpeta){ //si está el directorio fotos, la imagen se moverá a dicho directorio

                    $nombreImagen= time()."-".$_FILES["imagen"]["name"];

                    $moverImagen = move_uploaded_file($_FILES["imagen"]["tmp_name"], "../fotos/".$nombreImagen);

                    $imagen = $nombreImagen;

                    if ($moverImagen){

                        $imgCargada = true;

                    } else {

                        $imgCargada = false;

                        $errores["imagen"] = "Error: La imagen no se cargó correctamente";
                    }

                }
            }


            //ZONA DE LLAMADA A LA FUNCIÓN INSERTAR DEL MODELO

            if (count($errores) == 0) { //si no hay errores

                //se llama al método insertar de la clase modelo
                $resultado = $this->modelo->insertar(['fecha' => $fecha,'hora' => $hora, 
                'titulo' => $titulo,"descripcion" => $descripcion,'lugar' => $lugar, 'prioridad' => $prioridad,
                'imagen' => $imagen]);

                if ($resultado["correcto"]){

                  $this->mensajes[] = ["tipo" => "success",
                  "mensaje" => "El usuario se registró correctamente"];

                } else {

                  $this->mensajes[] = [
                      "tipo" => "danger",
                      "mensaje" => "El usuario no pudo registrarse<br/>({$resultado["error"]})"
                  ];

                }

            } else {

                $this->mensajes[] = [
                    "tipo" => "danger",
                    "mensaje" => "Datos de registro de usuario erróneos"
                ];
                
            }
        }

        
        include_once '../vistas/insertar.php'; //se visualiza la vista que aparece al registrar un usuario

    }


    public function listar(){

        //se almacenan en este array los valores que se van a mostrar en la vista
        $parametros = ["tituloventana" => "Mi agenda","datos" => NULL, "pagina" => NULL, "num_paginas" => NULL,"mensajes" => []];

        //LLAMADA AL MÉTODO LISTAR DE LA CLASE MODELO
        $resultado = $this->modelo->listar();

        if ($resultado["correcto"]){ //si no hay errores en la operación listar

            //los datos obtenidos se transfieren al array parametros["datos"]
            $parametros["datos"] = $resultado["datos"];
            $parametros["pagina"] = $resultado["pagina"];
            $parametros["num_paginas"] = $resultado["num_paginas"]; 

            $this->mensajes[] = ["tipo" => "success",
            "mensaje" => "El listado se realizó correctamente <br/>"];

        } else {

            $this->mensajes[] = ["tipo" => "danger","mensaje" => 
            "No se pudieron listar las tareas correctamente <br/>"];
        }

        /**
         * se asigna al campo 'mensajes' del array parametros el valor del atributo mensaje mostrando 
         * lo que ocurrió al realizarse la operación
         */
        $parametros["mensajes"] = $this->mensajes; 

        include_once '../vistas/listar.php'; //se visualiza la vista en la que aparecerán los registros
    }

}

?>