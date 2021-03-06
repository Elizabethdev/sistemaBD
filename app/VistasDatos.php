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
                            ->select('id_mun as value', 'municipio as text')
                            ->orderBy('municipio', 'ASC')
                            ->get();
    }

    public function getSubcuencas()
    {
        return $subcuencas = DB::table('subcuencas')
                            ->select('id_subcuenca as value', 'subcuenca as text')
                            ->orderBy('subcuenca', 'ASC')
                            ->get();
    }

    public function getRegionesEco()
    {
        return $regiones_eco = DB::table('regiones_economicas')
                            ->select('id_region as value', 'region_economica as text')
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
    public function getDatosTotalesAP_DEM($where, $order)
    {
        $total = DB::select('SELECT UPPER(" ") as cve_u, UPPER(" ") as cve_edo, UPPER(" ") as estado, UPPER(" ") as consejo_cuenca, UPPER(" ") as cve_mun, UPPER(" ") as municipio, 
        UPPER(" ") as cve_subcuenca, UPPER(" ") as subcuenca, UPPER(" ") as reg_economica, UPPER(" ") as num_region, UPPER(" ") as localidad, UPPER(" ") as POBTOT_10, UPPER("") as TIPO_10, UPPER(" ") as POBTOT_15, UPPER("") as TIPO_15,
        UPPER(" ") as POBTOT_20, UPPER("") as TIPO_20, UPPER(" ") as POBTOT_30, UPPER("TOTAL") as TIPO_30, SUM(DEM_AP_10) as DEM_AP_10, SUM(DEM_AP_15) as DEM_AP_15, SUM(DEM_AP_20) as DEM_AP_20, 
        SUM(DEM_AP_30) as DEM_AP_30 FROM demanda_ap '.$where);
     
        $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT_10, TIPO_10, POBTOT_15, TIPO_15, POBTOT_20, TIPO_20, POBTOT_30, TIPO_30, DEM_AP_10, DEM_AP_15, 
        DEM_AP_20, DEM_AP_30 FROM demanda_ap '.$where. ' ORDER BY '.$order);

        return [$datos, $total];
    }
    public function getDatosTotalesAP_COB($where, $order)
    {
        $total = DB::select('SELECT UPPER(" ") as cve_u, UPPER(" ") as cve_edo, UPPER("") as estado, UPPER("") as consejo_cuenca, UPPER("") as cve_mun, UPPER("") as municipio, 
        UPPER("") as cve_subcuenca, UPPER("") as subcuenca, UPPER("") as reg_economica, UPPER("") as num_region, UPPER("") as localidad, UPPER("") as RANGO_PI, UPPER("") as POBTOT_20, UPPER("TOTAL") as TIPO_20,
        UPPER("") as PO_CON_AP_15, UPPER("") as PO_CON_AP_20, UPPER("") as PO_CON_AP_30, UPPER("") as R_POB_15, UPPER("") as R_POB_20, UPPER("") as R_POB_30, SUM(COB_AP_10) as COB_AP_10, SUM(COB_AP_15) as COB_AP_15,  SUM(COB_AP_20) as COB_AP_20,  
        SUM(COB_AP_30) as COB_AP_30, UPPER("") as R_COB_AP_15, UPPER("") as R_COB_AP_20, UPPER("") as R_COB_AP_30 FROM cobertura_ap '.$where);

        $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca,
        reg_economica, num_region, localidad, RANGO_PI, POBTOT_20, TIPO_20, PO_CON_AP_15, PO_CON_AP_20, PO_CON_AP_30, R_POB_15, R_POB_20,R_POB_30, COB_AP_10, COB_AP_15,
        COB_AP_20, COB_AP_30, R_COB_AP_15, R_COB_AP_20, R_COB_AP_30 FROM cobertura_ap '.$where. ' ORDER BY '. $order);

        return [$datos, $total];
    }
    public function getDatosTotalesAP_POB($where, $order)
    {
        $total =  DB::select('SELECT UPPER(" ") as cve_u, UPPER(" ") as cve_edo, UPPER(" ") as estado, UPPER(" ") as consejo_cuenca, UPPER(" ") as cve_mun, UPPER(" ") as municipio, 
        UPPER(" ") as cve_subcuenca, UPPER(" ") as subcuenca, UPPER(" ") as reg_economica, UPPER(" ") as num_region, UPPER(" ") as localidad, UPPER(" ") as POBTOT_20, UPPER("TOTAL") as TIPO_20,SUM(PO_CON_AP_10) as PO_CON_AP_10, SUM(PO_SIN_AP_10) as PO_SIN_AP_10, 
        SUM(PO_CON_AP_15) as PO_CON_AP_15, SUM(PO_SIN_AP_15) as PO_SIN_AP_15, SUM(PO_CON_AP_20) as PO_CON_AP_20, SUM(PO_SIN_AP_20) as PO_SIN_AP_20, SUM(PO_CON_AP_30) as PO_CON_AP_30, SUM(PO_SIN_AP_30) as PO_SIN_AP_30 
        FROM pob_con_sin_ap '.$where);

        $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT_20, TIPO_20, PO_CON_AP_10, PO_SIN_AP_10, PO_CON_AP_15, PO_SIN_AP_15, 
        PO_CON_AP_20, PO_SIN_AP_20, PO_CON_AP_30, PO_SIN_AP_30 FROM pob_con_sin_ap '.$where. ' ORDER BY '. $order);

        return [$datos, $total];
    }

    //Alcantarillado
    public function getDatosTotalesALC_DEM($where, $order)
    {
        $total = DB::select('SELECT UPPER(" ") as cve_u, UPPER("") as cve_edo, UPPER("") as estado, UPPER("") as consejo_cuenca, UPPER("") as cve_mun, UPPER("") as municipio, 
        UPPER("") as cve_subcuenca, UPPER("") as subcuenca, UPPER("") as reg_economica, UPPER("") as num_region, UPPER("") as localidad, UPPER(" ") as POBTOT_10, UPPER("") as TIPO_10, UPPER(" ") as POBTOT_15, UPPER("") as TIPO_15,
        UPPER("") as POBTOT_20, UPPER("") as TIPO_20, UPPER(" ") as POBTOT_30, UPPER("TOTAL") as TIPO_30,
        SUM(DEM_ALC_10) as DEM_ALC_10, SUM(DEM_ALC_15) as DEM_ALC_15, SUM(DEM_ALC_20) as DEM_ALC_20, 
        SUM(DEM_ALC_30) as DEM_ALC_30 FROM demanda_alc '.$where);

        $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT_10, TIPO_10, POBTOT_15, TIPO_15, POBTOT_20, TIPO_20, POBTOT_30, TIPO_30, DEM_ALC_10, DEM_ALC_15, 
        DEM_ALC_20, DEM_ALC_30 FROM demanda_alc '.$where. ' ORDER BY '. $order);

        return [$datos, $total];
    }
    public function getDatosTotalesALC_COB($where, $order)
    {
        $total = DB::select('SELECT UPPER(" ") as cve_u, UPPER("") as cve_edo, UPPER("") as estado, UPPER("") as consejo_cuenca, UPPER("") as cve_mun, UPPER("") as municipio, 
        UPPER("") as cve_subcuenca, UPPER("") as subcuenca, UPPER("") as reg_economica, UPPER("") as num_region, UPPER("") as localidad, UPPER("") as RANGO_PI, UPPER("") as POBTOT_20, UPPER("TOTAL") as TIPO_20,
        UPPER("") as PO_CON_ALC_15, UPPER("") as PO_CON_ALC_20, UPPER("") as PO_CON_ALC_30, UPPER("") as R_POB_15, UPPER("") as R_POB_20, UPPER("") as R_POB_30, SUM(COB_ALC_10) as COB_ALC_10, SUM(COB_ALC_15) as COB_ALC_15, SUM(COB_ALC_20) as COB_ALC_20, 
        SUM(COB_ALC_30) as COB_ALC_30, UPPER("") as R_COB_ALC_15, UPPER("") as R_COB_ALC_20, UPPER("") as R_COB_ALC_30 FROM cobertura_alc '.$where);

        $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca,
        reg_economica, num_region, localidad, RANGO_PI, POBTOT_20, TIPO_20, PO_CON_ALC_15, PO_CON_ALC_20, PO_CON_ALC_30, R_POB_15, R_POB_20, R_POB_30, COB_ALC_10, COB_ALC_15,
        COB_ALC_20, COB_ALC_30, R_COB_ALC_15, R_COB_ALC_20, R_COB_ALC_30 FROM cobertura_alc '.$where. ' ORDER BY '. $order);

        return [$datos, $total];
    }
    public function getDatosTotalesALC_POB($where, $order)
    {
        $total = DB::select('SELECT UPPER(" ") as cve_u, UPPER(" ") as cve_edo, UPPER(" ") as estado, UPPER(" ") as consejo_cuenca, UPPER(" ") as cve_mun, UPPER(" ") as municipio, 
        UPPER(" ") as cve_subcuenca, UPPER(" ") as subcuenca, UPPER(" ") as reg_economica, UPPER(" ") as num_region, UPPER(" ") as localidad, UPPER(" ") as POBTOT_20, UPPER("TOTAL") as TIPO_20, SUM(PO_CON_ALC_10) as PO_CON_ALC_10, SUM(PO_SIN_ALC_10) as PO_SIN_ALC_10, 
        SUM(PO_CON_ALC_15) as PO_CON_ALC_15, SUM(PO_SIN_ALC_15) as PO_SIN_ALC_15, SUM(PO_CON_ALC_20) as PO_CON_ALC_20, SUM(PO_SIN_ALC_20) as PO_SIN_ALC_20, SUM(PO_CON_ALC_30) as PO_CON_ALC_30, SUM(PO_SIN_ALC_30) as PO_SIN_ALC_30 
        FROM pob_con_sin_alc '.$where);

        $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, 
        cve_subcuenca, subcuenca, reg_economica, num_region, localidad, POBTOT_20, TIPO_20, PO_CON_ALC_10, PO_SIN_ALC_10, PO_CON_ALC_15, PO_SIN_ALC_15, 
        PO_CON_ALC_20, PO_SIN_ALC_20, PO_CON_ALC_30, PO_SIN_ALC_30 FROM pob_con_sin_alc '.$where. ' ORDER BY '. $order);

        return [$datos, $total];
    }
    //Saneamiento
    public function getDatos_Saneamiento($where, $order)
    {
        return $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region,
                                    localidad, ESTATUS, CVE_INEGI, CAP_INSTALADA, CAUDAL_TRATADO, POBTOT_20, TIPO_20, ORG_OPERADOR, PROC_TRATAMIENTO, DESC_PROC_TRATAMIENTO,
                                    Observaciones, Inversion_Construccion, Programa_Construyo, Cuerpo_Receptor, Diagnostico FROM vw_datos_saneamiento '.$where. ' ORDER BY '. $order);
    }

    //Calidad
    public function getDatos_Calidad($where, $order)
    {
        return $datos = DB::select('SELECT cve_u, cve_edo, estado, consejo_cuenca, cve_mun, municipio, cve_subcuenca, subcuenca, reg_economica, num_region,
                                    localidad, POBTOT, POBTOT_10, TIPO_10, TVIVHAB, VIVPAR_HAB, VPH_AGUADV, VPH_DRENAJ, LATITUD, LONGITUD, HIPOCLORADORES, 
                                    PROGRAMA FROM vw_datos_calidad '.$where. ' ORDER BY '. $order);
    }

    public function getDatosTotalesByVista($vista, $where)
    {

        return $datos = DB::select('select * from '.$vista.' '.$where);
    }

   
}
