<?php

class DbQueries extends Conexion
{
    /*--------------------------------*/
    /* Listar registros desde la base de datos o un solo registro */
    /*--------------------------------*/

    public static function listEqual($table,$params = [], $limit = null)
    {
        $col_values = "";
        $limits = "";
        if (!empty($params))
        {
            $col_values .= "WHERE";
            foreach ($params as $key => $value)
            {
                $col_values .= " {$key} = :{$key} AND";
            }
            $col_values = substr($col_values,0,-3);
        }
        if($limit !== null)
        {
            $limits = " LIMIT {$limit}";
        }
        $stmt = "SELECT * FROM $table {$col_values}{$limits}";

        //llamando al query
        if(!$rows = parent::query($stmt, $params))
        {
            return false;
        }
        return $limit === 1 ? $rows[0] : $rows;
    }
}