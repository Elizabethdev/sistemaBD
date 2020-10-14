<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VistasDatos extends Model
{
    
    public function getEstados()
    {
        return $estados = DB::table('estados')
                            ->select('clave as value', 'estado as text')
                            ->orderBy('estado', 'ASC')
                            ->get();
    }

    public function getConsejosC()
    {
        return $consejo_bd = DB::table('consejos_cuencas')
                            ->select('consejo_cuenca as value', 'consejo_cuenca as text')
                            ->orderBy('consejo_cuenca', 'ASC')
                            ->get();
    }

    public function getMunicipios()
    {
        return $municipios = DB::table('municipios')
                            ->select('clave_m as value', 'municipio as text')
                            ->orderBy('municipio', 'ASC')
                            ->get();
    }

    public function getSubcuencas()
    {
        return $subcuencas = DB::table('subcuencas')
                            ->select('cve_subcuenca as value', 'subcuenca as text')
                            ->orderBy('subcuenca', 'ASC')
                            ->get();
    }

    public function getRegionesEco()
    {
        return $regiones_eco = DB::table('regiones_economicas')
                            ->select('num_region as value', 'region_economica as text')
                            ->orderBy('region_economica', 'ASC')
                            ->get();
    }

    public function getLocalidades()
    {
        return $localidades = DB::table('localidades')
                            ->select('localidad as value', 'localidad as text')
                            ->get();
    }

    public function getMunByConsejo($where, $campo)
    {
        return $municipios = DB::table('datos')->distinct()
                            ->select('CVE_MUN as cve_mun', 'MUNICIPIO as municipio', 'CONSEJO_CUENCA')
                            ->whereIn($campo, $where)->get();
        
    }
    //Agua Potable
    public function getDatosTotalesAPBy($where)
    {
        $first = 'SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, UPPER("TOTAL") as TIPO_20,
        SUM(DEM_AP_10) as DEM_AP_10, SUM(DEM_AP_15) as DEM_AP_15, SUM(DEM_AP_20) as DEM_AP_20, 
        SUM(DEM_AP_30) as DEM_AP_30 FROM vwdemanda_ap '.$where;

        return $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, TIPO_20, DEM_AP_10, DEM_AP_15, 
        DEM_AP_20, DEM_AP_30 FROM vwdemanda_ap '.$where. ' UNION ALL '. $first);
    }
    public function getDatosTotalesAP_COB($where)
    {
        $first = 'SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, UPPER("TOTAL") as TIPO_20,
        SUM(COB_AP_10) as COB_AP_10, SUM(COB_AP_15) as COB_AP_15, SUM(COB_AP_20) as COB_AP_20, 
        SUM(COB_AP_30) as COB_AP_30 FROM vw_cobertura_AP '.$where;

        return $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, TIPO_20, COB_AP_10, COB_AP_15, 
        COB_AP_20, COB_AP_30 FROM vw_cobertura_AP '.$where. ' UNION ALL '. $first);
    }

    //Alcantarillado
    public function getDatosTotalesALCBy($where)
    {
        $first = 'SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, UPPER("TOTAL") as TIPO_20,
        SUM(DEM_ALC_10) as DEM_ALC_10, SUM(DEM_ALC_15) as DEM_ALC_15, SUM(DEM_ALC_20) as DEM_ALC_20, 
        SUM(DEM_ALC_30) as DEM_ALC_30 FROM vwdemanda_alc '.$where;

        return $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, TIPO_20, DEM_ALC_10, DEM_ALC_15, 
        DEM_ALC_20, DEM_ALC_30 FROM vwdemanda_alc '.$where. ' UNION ALL '. $first);
    }

    public function getDatosTotalesByVista($vista, $where)
    {

        return $datos = DB::select('select * from '.$vista.' '.$where);
    }

    public function getDatosMunicipiosByFiltros($filtro, $subfiltro)
    {
        $query = 'SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, TIPO_20, SUM(DEM_AP_20) as totaldemap_20, 
                    (SELECT SUM(DEM_AP_10) FROM vwdemanda_ap
                        WHERE TIPO_10 = "RURAL" 
                        AND cve_mun = a.cve_mun
                        '.$filtro.'
                        GROUP BY cve_mun) as totaldemap_10,
                    (SELECT SUM(DEM_AP_15) FROM vwdemanda_ap
                        WHERE TIPO_15 = "RURAL" 
                        AND cve_mun = a.cve_mun
                        '.$filtro.'
                        GROUP BY cve_mun) as totaldemap_15,
                    (SELECT SUM(DEM_AP_30) FROM vwdemanda_ap
                        WHERE TIPO_30 = "RURAL" 
                        AND cve_mun = a.cve_mun
                    '.$filtro.'
                        GROUP BY cve_mun) as totaldemap_30
                FROM vwdemanda_ap a
                WHERE TIPO_20 = "RURAL"
                '.$filtro.'
                GROUP BY cve_mun 
                UNION ALL
                SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT, TIPO_20, SUM(DEM_AP_20) as totaldemap_20, 
                    (SELECT SUM(DEM_AP_10) FROM vwdemanda_ap
                        WHERE TIPO_10 = "URBANA" AND cve_mun = a.cve_mun
                        '.$filtro.'
                        GROUP BY cve_mun) as totaldemap_10,
                    (SELECT SUM(DEM_AP_15) FROM vwdemanda_ap
                        WHERE TIPO_15 = "URBANA" 
                        AND cve_mun = a.cve_mun
                    '.$filtro.'
                        GROUP BY cve_mun) as totaldemap_15,
                    (SELECT SUM(DEM_AP_30) FROM vwdemanda_ap
                        WHERE TIPO_30 = "URBANA" 
                        AND cve_mun = a.cve_mun
                    '.$filtro.'
                        GROUP BY cve_mun) as totaldemap_30
                FROM vwdemanda_ap a
                WHERE TIPO_20 = "URBANA" 
                '.$filtro.'
                GROUP BY cve_mun 
                UNION ALL
                SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region,
                    localidad, POBTOT, UPPER("TOTAL") as TIPO_20,
                    SUM(DEM_AP_20) as totaldemap_20, SUM(DEM_AP_10) as totaldemap_10, SUM(DEM_AP_15) as totaldemap_15, SUM(DEM_AP_30) as totaldemap_30
                FROM vwdemanda_ap 
                '.$subfiltro.'
                GROUP BY cve_mun
                ORDER BY municipio ASC';

        return $datos = DB::select($query);
    }


}
