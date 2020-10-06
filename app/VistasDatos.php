<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VistasDatos extends Model
{
    
    public function getEstados()
    {
        return $estados = DB::table('estados')
                            ->select(DB::raw('clave as value, estado as text'))
                            ->get();
    }

    public function getConsejosC()
    {
        return $consejo_bd = DB::table('consejos_cuencas')
                            ->select(DB::raw('consejo_cuenca as value, consejo_cuenca as text'))
                            ->get();

    }

    public function getMunicipios()
    {
        return $municipios = DB::table('municipios')
                            ->select(DB::raw('clave_m as value, municipio as text'))
                            ->get();
    }

    public function getSubcuencas()
    {
        return $subcuencas = DB::table('subcuencas')
                            ->select(DB::raw('cve_subcuenca as value, subcuenca as text'))
                            ->get();
    }

    public function getRegionesEco()
    {
        return $regiones_eco = DB::table('regiones_economicas')
                            ->select(DB::raw('num_region as value, region_economica as text'))
                            ->get();
    }

    public function getLocalidades()
    {
        return $localidades = DB::table('localidades')
                            ->select(DB::raw('localidad as value, localidad as text'))
                            ->get();
    }

    public function getDatosTotales()
    {
        return $datos = DB::table('vwDemanda_AP_by_mun')->get();
    }

    public function getDatosTotalesBy($vista, $where)
    {
        return $consejo_bd = DB::select('select * from '.$vista .$where);

        // return $consejo_bd = DB::table('vwDemanda_AP_GROUP_MUN')->where($where)->orWhere($where)->get();
        // return $datos = DB::table($vista)
        //                         ->whereIn($campo, $where)->get();
        
    }


}
