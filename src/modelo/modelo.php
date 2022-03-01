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

    public function insertar($datos){

        $resultado = ["correcto" => FALSE, "error" => NULL];

        try {

            $this->conexion->beginTransaction(); //se inicia la transacción

            //instrucción SQL de insertar
            $sql = "INSERT into tareas VALUES(NULL, :fecha, :hora, :titulo, :imagen, :descripcion, :prioridad, :lugar, NULL);";

            $query = $this->conexion->prepare($sql); //se prepara la consulta

            //se ejecuta la consulta
            $query->execute(['fecha' => $datos["fecha"], 'hora' => $datos["hora"], 'titulo' => $datos["titulo"],
            'imagen' => $datos["imagen"], 'descripcion' => $datos["descripcion"], 'prioridad' => $datos["prioridad"], 
            'lugar' => $datos["lugar"]]);

            if ($query){ //si se realiza la operación correctamente

                $this->conexion->commit(); //se confirman los cambios realizados

                $resultado["correcto"] = TRUE;
            }                


        } catch(PDOException $ex){

            $this->conexion->rollback();

            $resultado["error"] = $ex->getMessage();
        }

        return $resultado;

    }

    public function listar(){

        $resultado = ["correcto" => FALSE, "datos" => NULL, "pagina" => NULL, "num_paginas" => NULL, "error" => NULL];

        try {

            $pagina = isset($_GET["pagina"]) ? (int) $_GET["pagina"] : 1;
            $resultado["pagina"] = $pagina;
            $filaporpag = 3;
            $inicio = ($pagina > 1) ? ($pagina * $filaporpag - $filaporpag) : 0;

            //sentencia sql para listar las filas existentes en la tabla y el número de filas por pág que mostrará
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM tareas LIMIT $inicio, $filaporpag;";

            //preparación y ejecución de la sentencia sql previamente definida
            $query = $this->conexion->query($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC); 
            $resultFilas = $query->fetchAll();

            if ($query){ //si no ocurren errores en la operación

                $resultado["correcto"] = TRUE;
                $resultado["datos"] = $resultFilas;
            }

            //variable que recoge el número total de elementos de la tabla tareas
            $totalFilas = $this->conexion->query('SELECT FOUND_ROWS() as total;');
            $totalFilas = $totalFilas->fetch()['total'];

            //variable para el número de páginas según el nº de elementos de la tabla y el número de filas por página
            $numPagina = ceil($totalFilas / $filaporpag);
            $resultado["num_paginas"] = $numPagina;


        } catch(PDOException $ex){

            $resultado["error"] = $ex->getMessage();
        }

        return $resultado;
    }
}

?>