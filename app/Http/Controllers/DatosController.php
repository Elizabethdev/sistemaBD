<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DatosImport;
use Illuminate\Support\Facades\DB;

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

    public function verDatos()
    {
        return view('datos.verdatos');
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
