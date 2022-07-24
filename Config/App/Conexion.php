<?php

class Conexion
{
    private $conect;

    public function __construct()
    {
        $connectionString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
        try {
            $this->conect = new PDO($connectionString,DB_USER,DB_PASSWORD);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /*echo "Conexion Existosa";*/
        }catch (PDOException $e){
            echo"Error: " . $e->getMessage();
        }
    }

    public function conect()
    {
        return $this->conect;
    }
    public static function query($sql,$params=[])
    {
        $db = new Conexion();
        $link = $db->conect();
        $link->beginTransaction();//por algun error que se genere
        $query = $link->prepare($sql);

        if (!$query->execute($params))
        {
            //sino viene con parametros que no haga nada
            $link->rollBack();
            //y que muestre los errores con esta funcion errorInfo
            $error = $query->errorInfo();
            throw new Exception($error[2]);
        }
        // SELECT | INSERT | UPDATE | DELETE
        // Manejo del tipo de query
        if(strpos($sql,'SELECT') !== false)
        {
            return $query->rowCount() > 0 ? $query->fetchAll(PDO::FETCH_ASSOC):false;
        }elseif(strpos($sql,'INSERT') !== false)
        {
            $id = $link->lastInsertId();
            $link->commit();
            return $id;
        }elseif(strpos($sql,'UPDATE') !== false)
        {
            $link->commit();
            return true;
        }elseif(strpos($sql,'DELETE') !== false)
        {
            // si encuentyra un registro que lo actualice
            if ($query->rowCount() > 0)
            {
                $link->commit();
                return true;
            }
            // sino encuentra ningun registro para actualizar , entonces que no actualice nada
            $link->rollBack();
            return false;
        }else{
            // alter table
            $link->commit();
            return true;
        }
    }
}