<?php

class Views
{
    public function getView($controlador, $vista, $data='')
    {
        $controlador = get_class($controlador);
        /*Si no existe una vista, Lo primero que cargara sera
         la vista por defecto, el controlador Home*/
        if($controlador == 'Home')
        {
            $vista = 'Views/'.$vista.'.php';
            /*pero si existe, entonces que cargue la vista*/
        }else{
            $vista = 'Views/'.$controlador.'/'.$vista.'.php';
        }
        require $vista;
    }
}