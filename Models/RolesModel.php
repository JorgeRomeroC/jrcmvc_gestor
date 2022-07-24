<?php

class RolesModel extends DbQueries
{
    public $id_rol;
    public $nombre_rol;
    public $estado_rol;


    public function __construct()
    {
        /*--------------------------------*/
        /* LLAMO AL CONSTRUCTOR DE DbQueries y hacer uso de todos sus metodos */
        /*--------------------------------*/
        parent::__construct();
    }

    public function listRoles()
    {
        $sql = "SELECT * FROM roles WHERE estado_rol != 0";
        $resp = $this->selectAll($sql);
        return $resp;
    }

}