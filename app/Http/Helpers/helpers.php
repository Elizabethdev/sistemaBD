<?php

namespace App\Http\Helpers;

class Helpers
{
    public static function getQueryFiltro($filtros, $field, $query, $query2)
    {
        $addQuery = $query;
        $addQuery2 = $query2;

        $addQuery .= "AND ".$field." IN(";
        if($addQuery2 == '')
            $addQuery2 .= "WHERE ".$field." IN(";
        else 
            $addQuery2 .= "AND ".$field." IN(";

        foreach ($filtros as $key => $filtro) {
            if($key == 0){
                $addQuery.=  "'".$filtro."'";
                $addQuery2 .= "'".$filtro."'";
            }
            else{
                $addQuery .= ",'".$filtro."'";
                $addQuery2 .= ",'".$filtro."'";
            }
        }
        $addQuery.= ") ";
        $addQuery2.= ") ";

        return [$addQuery, $addQuery2];
    }
}