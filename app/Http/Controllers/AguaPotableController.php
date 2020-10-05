<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VistasDatos;

class AguaPotableController extends Controller
{
    protected $vistaDatos;

    public function __construct(VistasDatos $vistaDatos)
    {
        $this->vistaDatos = $vistaDatos;
        
        // $this->middleware('auth');
    }

    public function index()
    {
        $estados = $this->vistaDatos->getEstados();
        $consejos = $this->vistaDatos->getConsejosC();
        $municipios = $this->vistaDatos->getMunicipios();
        $subcuencas = $this->vistaDatos->getSubcuencas();
        $regionesEco = $this->vistaDatos->getRegionesEco();
        // $localidades = $this->vistaDatos->getLocalidades();
        $localidades = collect([]);

        $datos_total = $this->vistaDatos->getDatosTotales();
        $grouped = $datos_total->groupBy('cve_mun');
        
        return view('website.aguapotable', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                            'localidades' => $localidades,
                                            'datos_total' => $grouped]);
    }

   
    public function consultarByMun(Request $request)
    {
        $municipios = $request->municipios;
        $vista = 'vwDemanda_AP_by_mun ';
        $where = '';

        foreach ($municipios as $key => $value) {
            if($key==0)
                $where.=  'WHERE cve_mun = ' .$value;
            else
                $where.=  ' OR cve_mun = ' .$value;
        }
        $consulta = collect($this->vistaDatos->getDatosTotalesBy($vista, $where));

        return response()->json([
            'municipios' => $consulta->groupBy('cve_mun')
        ]);
    }

    public function consultarByconsejo(Request $request)
    {
        $consejos = $request->consejos;
        $vista = 'vwDemanda_AP_BY_CONSEJO ';
        $where = '';

        foreach ($consejos as $key => $value) {
            if($key==0)
                $where.=  "WHERE consejo_cuenca LIKE '%" .$value ."%'";
            else
                $where.=  " OR consejo_cuenca LIKE '%" .$value."%'";
        }
        dd($where);
        $consulta = collect($this->vistaDatos->getDatosTotalesBy($vista, $where));

        return response()->json([
            'consejos' => $consulta->groupBy('cve_mun')
        ]);
    }
    
    public function consultarBysubcuenca(Request $request)
    {
        $subcuencas = $request->subcuencas;
        $vista = 'vwDemanda_AP_BY_subcuenca ';
        $where = '';

        foreach ($subcuencas as $key => $value) {
            if($key==0)
                $where.=  'WHERE cve_subcuenca = ' .$value;
            else
                $where.=  ' OR cve_subcuenca = ' .$value;
        }
        $consulta = collect($this->vistaDatos->getDatosTotalesBy($vista, $where));

        return response()->json([
            'subcuencas' => $consulta->groupBy('cve_subcuenca')
        ]);
    }
    public function consultarByregion(Request $request)
    {
        $regiones = $request->regiones;
        $vista = 'vwDemanda_AP_BY_region_eco ';
        $where = '';

        foreach ($regiones as $key => $value) {
            if($key==0)
                $where.=  'WHERE num_region = ' .$value;
            else
                $where.=  ' OR num_region = ' .$value;
        }
        $consulta = collect($this->vistaDatos->getDatosTotalesBy($where));

        return response()->json([
            'regiones' => $consulta->groupBy('num_region')
        ]);
    }

}
