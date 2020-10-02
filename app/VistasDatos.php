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
        return $consejo_bd = DB::table('municipios')
                            ->select(DB::raw('clave_m as value, municipio as text'))
                            ->get();
    }

    public function getSubcuencas()
    {
        return $consejo_bd = DB::table('subcuencas')
                            ->select(DB::raw('cve_subcuenca as value, subcuenca as text'))
                            ->get();
    }

    public function getRegionesEco()
    {
        return $consejo_bd = DB::table('regiones_economicas')
                            ->select(DB::raw('num_region as value, region_economica as text'))
                            ->get();
    }

    public function getLocalidades()
    {
        return $consejo_bd = DB::table('localidades')
                            ->select(DB::raw('localidad as value, localidad as text'))
                            ->get();
    }

    public function getDatosTotales()
    {
        return $consejo_bd = DB::table('vwDemanda_AP_GROUP_MUN')->get();
    }

    public function getDatosTotalesBy($where)
    {
        // return $consejo_bd = DB::table('vwDemanda_AP_GROUP_MUN')->where($where)->orWhere($where)->get();
        return $consejo_bd = DB::select('select * from vwDemanda_AP_GROUP_MUN ' .$where);
    }

    

}
