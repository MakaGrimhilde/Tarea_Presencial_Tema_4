<?php

class modelo{

    private $conexion;
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "bdmsgs";

    /**
     * constructor de la clase modelo. Ejecuta directamente el método conectar con la base de datos
     */
    public function __construct(){

        $this->conectar();

    }


    //ZONA DE MÉTODOS

    /**
     * método que conecta a la base de datos bdmsgs mediante PDO
     *
     * @return void
     */
    public function conectar(){


        try{

            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $ex) {

            return $ex->getMessage();

        }
            
    }

    public function listar(){

        
    }
}

?>