<?php

class Controllers
{
    public function __construct()
    {
        $this->views = new Views();
        $this->cargarModel();
    }
    public function cargarModel()
    {
        /*este metodo obtendra la clase/modelo */
        $model = get_class($this).'Model';
        /*esa clase la buscaremos dentro de esta ruta*/
        $ruta = 'Models/'.$model.'.php';

        /*comprobamos la existencia del archivo en esa ruta*/
        if(file_exists($ruta))
        {
            require_once $ruta;
            $this->model = new $model();
        }
    }
}