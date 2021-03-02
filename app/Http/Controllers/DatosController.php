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

    public function calcularDatosAP()
    {
        // Cache::forget('demandaap');
        // $value = Cache::rememberForever('demandaap', function () {
        //     return DB::table('vwdemanda_ap')->get();
        // });
        Cache::flush();
        DB::transaction(function () {
        
            DB::table('demanda_ap')->truncate();
            
            $value =  DB::select('INSERT INTO demanda_ap (cve_u, cve_edo, estado, consejo_cuenca, cve_mun, id_mun, municipio, cve_subcuenca,
            id_subcuenca, subcuenca, reg_economica, id_region, num_region, localidad, LONGITUD, LATITUD, P3YM_HLI, TVIVHAB, VIVPAR_HAB, PROM_OCUP, VPH_AGUADV, VPH_DRENAJ, POB_IND,
            RANGO_PI, POBTOT, POBTOT_10, TIPO_10, POBTOT_15, TIPO_15, POBTOT_20, TIPO_20, POBTOT_30, TIPO_30, DEM_AP_10, DEM_AP_15, DEM_AP_20, DEM_AP_30)
            SELECT * FROM vwdemanda_ap');

            // $total = DB::select('SELECT UPPER(" ") as cve_u, UPPER(" ") as cve_edo, UPPER(" ") as estado, UPPER(" ") as consejo_cuenca, UPPER(" ") as cve_mun, UPPER(" ") as id_mun, UPPER(" ") as municipio, 
            // UPPER(" ") as cve_subcuenca,UPPER(" ") as id_subcuenca, UPPER(" ") as subcuenca, UPPER(" ") as reg_economica,UPPER(" ") as id_region, UPPER(" ") as num_region, UPPER(" ") as localidad, UPPER(" ") as POBTOT_10, UPPER("") as TIPO_10, UPPER(" ") as POBTOT_15, UPPER("") as TIPO_15,
            // UPPER(" ") as POBTOT_20, UPPER("") as TIPO_20, UPPER(" ") as POBTOT_30, UPPER("TOTAL") as TIPO_30, SUM(DEM_AP_10) as DEM_AP_10, SUM(DEM_AP_15) as DEM_AP_15, SUM(DEM_AP_20) as DEM_AP_20, 
            // SUM(DEM_AP_30) as DEM_AP_30 FROM demanda_ap '.$where);

        });

        return response()->json([
            'res' => true,
            'msg' => 'Datos demanda AP guardados correctamente'
        ]);

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
