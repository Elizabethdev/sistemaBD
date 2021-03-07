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
        try {
            Cache::flush();
            DB::transaction(function () {
            
                DB::table('demanda_ap')->truncate();
                
                $value =  DB::select('INSERT INTO demanda_ap (cve_u, cve_edo, estado, consejo_cuenca, cve_mun, id_mun, municipio, cve_subcuenca,
                id_subcuenca, subcuenca, reg_economica, id_region, num_region, localidad, LONGITUD, LATITUD, P3YM_HLI, TVIVHAB, VIVPAR_HAB, PROM_OCUP, VPH_AGUADV, VPH_DRENAJ, POB_IND,
                RANGO_PI, POBTOT, POBTOT_10, TIPO_10, POBTOT_15, TIPO_15, POBTOT_20, TIPO_20, POBTOT_30, TIPO_30, DEM_AP_10, DEM_AP_15, DEM_AP_20, DEM_AP_30)
                SELECT * FROM vwdemanda_ap');
            });

            return response()->json([
                'res' => true,
                'msg' => 'Datos demanda AP guardados correctamente',
                'variant' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'res' => true,
                'msg' => 'Datos demanda AP No guardados',
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
