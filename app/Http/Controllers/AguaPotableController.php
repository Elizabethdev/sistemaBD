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
        $localidades = $this->vistaDatos->getLocalidades();
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
        $where = '';

        foreach ($municipios as $key => $value) {
            if($key==0)
                $where.=  'WHERE cve_mun = ' .$value;
            else
                $where.=  ' OR cve_mun = ' .$value;
        }
        // dd($where);
        $consulta = collect($this->vistaDatos->getDatosTotalesBy($where));

        return response()->json([
            'municipios' => $consulta->groupBy('cve_mun')
        ]);
    }

}
