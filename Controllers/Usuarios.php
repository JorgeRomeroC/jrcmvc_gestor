<?php

class Usuarios extends Controllers
{
    public function index()
    {
        $data['page_name'] = "Usuarios";
        $data['function_js'] = "Usuarios.js";
        $this->views->getView($this,'index',$data);
    }
}