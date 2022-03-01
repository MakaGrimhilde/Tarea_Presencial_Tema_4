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

    public function listar(){

        
    }

}

?>