<?php
spl_autoload_register(function($class){
    /*Comprobamos que exista una clase en esta carpeta
    si es asi entonces la requerimos*/
    if(file_exists('Config/App/'.$class.'.php'))
    {
        require_once 'Config/App/'.$class.'.php';
    }
});