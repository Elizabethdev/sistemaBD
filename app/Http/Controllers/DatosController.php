<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DatosImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DatosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cargarArchivo()
    {
        return view('datos.uploadfile');
    }

    public function importExcel(Request $request)
    {
        // dd($request->all());
        $file = $request->file('file');

        // DB::transaction(function () use ($file) {
            
            // DB::table('datos')->truncate();

            Excel::import(new DatosImport, $file);
        // });
        
        return response()->json([
            'message' => 'Importación de datos completada',
            'state' => 'ok',
        ]);

        // return back()->with('message', 'Importación de datos completada');
    }

    public function verCalcular()
    {
        return view('datos.verdatos');
    }

    public function calcularDatosAP_DEM(Request $request)
    {
        $page = $request->page;
        try {

            DB::transaction(function () {
                DB::table('demanda_ap')->truncate();
                
                $value =  DB::select('INSERT INTO demanda_ap (cve_u, cve_edo, estado, consejo_cuenca, cve_mun, id_mun, municipio, cve_subcuenca,
                id_subcuenca, subcuenca, reg_economica, id_region, num_region, localidad, LONGITUD, LATITUD, P3YM_HLI, TVIVHAB, VIVPAR_HAB, PROM_OCUP, VPH_AGUADV, VPH_DRENAJ, POB_IND,
                RANGO_PI, POBTOT, POBTOT_10, TIPO_10, POBTOT_15, TIPO_15, POBTOT_20, TIPO_20, POBTOT_30, TIPO_30, DEM_AP_10, DEM_AP_15, DEM_AP_20, DEM_AP_30)
                SELECT * FROM vwdemanda_ap');
            });
            
            return response()->json([
                'msg' => 'Datos '.$page.' AP guardados correctamente',
                'variant' => 'success'
            ]);
        } catch (\Throwable $th) {
            // dd($th);
            return response()->json([
                'msg' => 'Datos '.$page.' AP No guardados',
                'variant' => 'danger'
            ]);
        }
    }

    public function calcularDatosAP_COB(Request $request)
    {
        $page = $request->page;
        try {
                DB::transaction(function () {
                    DB::table('cobertura_ap')->truncate();
                    
                    $value =  DB::select('INSERT INTO cobertura_ap (cve_u, cve_edo, estado, consejo_cuenca, cve_mun, id_mun, municipio, cve_subcuenca,
                    id_subcuenca, subcuenca, reg_economica, id_region, num_region, localidad, POBTOT, TIPO_20, RANGO_PI, POBTOT_10, VPH_AGUADV, VPH_DRENAJ, VIVPAR_HAB, PROM_OCUP, POBTOT_15, R_POB_15,
                    POBTOT_20, R_POB_20, POBTOT_30, R_POB_30, PO_CON_AP_10, PO_CON_AP_15, PO_CON_AP_20, PO_CON_AP_30, COB_AP_10, COB_AP_15, R_COB_AP_15, COB_AP_20, R_COB_AP_20, COB_AP_30, R_COB_AP_30)
                    SELECT * FROM vw_cobertura_ap');
                });
            
                return response()->json([
                    'msg' => 'Datos '.$page.' AP guardados correctamente',
                    'variant' => 'success'
                ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Datos '.$page.' AP No guardados',
                'variant' => 'danger'
            ]);
        }
    }

    public function calcularDatosAP_POB(Request $request)
    {
        $page = $request->page;
        try {

            DB::transaction(function () {
                DB::table('pob_con_sin_ap')->truncate();
                
                $value =  DB::select('INSERT INTO pob_con_sin_ap (cve_u, cve_edo, estado, consejo_cuenca, cve_mun, id_mun, municipio, cve_subcuenca,
                id_subcuenca, subcuenca, reg_economica, id_region, num_region, localidad, POBTOT, POBTOT_10, TIPO_20, VPH_AGUADV, VPH_DRENAJ, VIVPAR_HAB, PROM_OCUP, POBTOT_15,
                POBTOT_20, POBTOT_30, POB_IND, RANGO_PI, COB_AP_2010, PO_CON_AP_10, PO_SIN_AP_10, PO_CON_AP_15, PO_SIN_AP_15, PO_CON_AP_20, PO_SIN_AP_20, PO_CON_AP_30, PO_SIN_AP_30)
                SELECT * FROM vwpob_con_sin_ap');
            });
                   
            return response()->json([
                'msg' => 'Datos '.$page.' AP guardados correctamente',
                'variant' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Datos '.$page.' AP No guardados',
                'variant' => 'danger'
            ]);
        }
    }

    public function filtrarDatosdemanda()
    {
        return view('datos.resumendemanda');
    }

    public function filtrarDatosServicio()
    {
        return view('datos.resumenservicios');
    }

    public function filtrarDatosRango()
    {
        return view('datos.resumenrangos');
    }

    
}
