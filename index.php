<?php
require_once 'Config/Config.php';
require_once 'Helpers/Helpers.php';
$ruta = !empty($_GET['url']) ? $_GET['url']: 'Home/index';
$array = explode('/',$ruta);
$controller = $array[0];
$metodo = 'index';
$parametro = '';

/*=====================================
* == Cargando el metodo
=======================================*/
if(!empty($array[1]))
{
    if(!empty($array[1] != ''))
    {
        $metodo = $array[1];
    }
}

/*=====================================
* == Cargando el parametro
=======================================*/
if (!empty($array[2]))
{
    if(!empty($array[2] != ''))
    {
        for ($i=2; $i < count($array); $i++) {
            $parametro .= $array[$i] . ',';
        }
        $parametro = trim($parametro,',');
    }
}

require_once 'Config/App/autoload.php';
/*=====================================
* == Directorio desde donde se cargaran los controladores
=======================================*/
$diController = "Controllers/".$controller.'.php';

/*=====================================
* == Verificando si existe el controlador
=======================================*/
if(file_exists($diController))
{
    require_once $diController;
    $controller = new $controller();
    if (method_exists($controller,$metodo))
    {
        $controller->$metodo($parametro);
    }else{
        echo 'El metodo no existe';
    }
}else{
    echo 'No existe el controlador';
}
