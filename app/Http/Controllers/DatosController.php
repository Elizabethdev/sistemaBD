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

        DB::transaction(function () use ($file) {
            
            DB::table('datos')->truncate();

            Excel::import(new DatosImport, $file);
        });
        
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
