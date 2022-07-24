<?php

class DbQueries extends Conexion
{
    private $conexion;
    private $query;
    private $values;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }
    /*--------------------------------*/
    /* SELECCIONAR TODOS LOS REGISTROS */
    /*--------------------------------*/
    public function selectAll(string $query)
    {
        $this->query = $query;
        $result = $this->conexion->prepare($this->query);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}