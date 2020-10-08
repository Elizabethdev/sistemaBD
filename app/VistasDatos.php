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

    public function getMunByConsejo($where, $campo)
    {
        return $municipios = DB::table('datos')->distinct()
                            ->select('CVE_MUN as cve_mun', 'MUNICIPIO as municipio', 'CONSEJO_CUENCA')
                            ->whereIn($campo, $where)->get();
        
    }

    public function getDatosTotales()
    {
        return $datos = DB::table('vwDemanda_AP_by_mun')->get();
    }

    public function getDatosTotalesBy($vista, $where)
    {
        return $datos = DB::select('select * from '.$vista .$where);
    }

    public function getDatosMunByFiltroCuenca($filtro)
    {
        $query = "SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, TIPO_20, SUM(DEM_AP_20) as totaldemap_20, 
                    (SELECT SUM(DEM_AP_10) FROM vwdemanda_ap
                        WHERE TIPO_10 = 'RURAL' 
                        AND cve_mun = a.cve_mun
                        AND consejo_cuenca IN(".$filtro.")
                        GROUP BY cve_mun) as totaldemap_10,
                    (SELECT SUM(DEM_AP_15) FROM vwdemanda_ap
                        WHERE TIPO_15 = 'RURAL' 
                        AND cve_mun = a.cve_mun
                        AND consejo_cuenca IN(".$filtro.")
                        GROUP BY cve_mun) as totaldemap_15,
                    (SELECT SUM(DEM_AP_30) FROM vwdemanda_ap
                        WHERE TIPO_30 = 'RURAL' 
                        AND cve_mun = a.cve_mun
                    AND consejo_cuenca IN(".$filtro.")
                        GROUP BY cve_mun) as totaldemap_30
                FROM vwdemanda_ap a
                WHERE TIPO_20 = 'RURAL' 
                and a.cve_mun = 17
                AND consejo_cuenca IN(".$filtro.")
                GROUP BY cve_mun 
                UNION ALL
                SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, TIPO_20, SUM(DEM_AP_20) as totaldemap_20, 
                    (SELECT SUM(DEM_AP_10) FROM vwdemanda_ap
                        WHERE TIPO_10 = 'URBANA' AND cve_mun = a.cve_mun
                        AND consejo_cuenca IN(".$filtro.")
                        GROUP BY cve_mun) as totaldemap_10,
                    (SELECT SUM(DEM_AP_15) FROM vwdemanda_ap
                        WHERE TIPO_15 = 'URBANA' 
                        AND cve_mun = a.cve_mun
                    AND consejo_cuenca IN(".$filtro.")
                        GROUP BY cve_mun) as totaldemap_15,
                    (SELECT SUM(DEM_AP_30) FROM vwdemanda_ap
                        WHERE TIPO_30 = 'URBANA' 
                        AND cve_mun = a.cve_mun
                    AND consejo_cuenca IN(".$filtro.")
                        GROUP BY cve_mun) as totaldemap_30
                FROM vwdemanda_ap a
                WHERE TIPO_20 = 'URBANA' 
                AND consejo_cuenca IN(".$filtro.")
                GROUP BY cve_mun 
                UNION ALL
                SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region,
                    localidad, POBTOT, UPPER('TOTAL') as TIPO_20,
                    SUM(DEM_AP_20) as totaldemap_20, SUM(DEM_AP_10) as totaldemap_10, SUM(DEM_AP_15) as totaldemap_15, SUM(DEM_AP_30) as totaldemap_30
                FROM vwdemanda_ap 
                WHERE consejo_cuenca IN(".$filtro.")
                GROUP BY cve_mun
                ORDER BY municipio ASC";

            return $datos = DB::select($query);
    }


}
