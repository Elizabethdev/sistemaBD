<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VistasDatos;
use App\Http\Helpers\Helpers;

class CalidadController extends Controller
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
        
        return view('website.calidad.calidadagua', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                            'datos_total' => collect([])]);
    }

    public function consultarByFiltros(Request $request)
    {
        $filtros = $request->filtros;
        $addQuery = '';
        $addQuery2 = '';
        $consulta = collect([]);
        $order = '';
        $orderValue = 5;

        if ($filtros['consejo'] != []) {
            $order .= 'consejo_cuenca ASC, ';
            $orderTemp = 1;
            $orderValue = $orderValue > $orderTemp ? $orderTemp : $orderValue;
            $getQuery = Helpers::getQueryFiltro($filtros['consejo'], 'consejo_cuenca', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['subcuenca'] != []) {
            $order .= 'subcuenca ASC, ';
            $orderTemp = 2;
            $orderValue = $orderValue > $orderTemp ? $orderTemp : $orderValue;
            $getQuery = Helpers::getQueryFiltro($filtros['subcuenca'], 'id_subcuenca', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['region'] != []) {
            $order .= 'reg_economica ASC, ';
            $orderTemp = 3;
            $orderValue = $orderValue > $orderTemp ? $orderTemp : $orderValue;
            $getQuery = Helpers::getQueryFiltro($filtros['region'], 'id_region', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['municipio'] != []) {
            $order .= 'municipio ASC, ';
            $orderTemp = 4;
            $orderValue = $orderValue > $orderTemp ? $orderTemp : $orderValue;
            $getQuery = Helpers::getQueryFiltro($filtros['municipio'], 'id_mun', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['estado'] != []) {
            $getQuery = Helpers::getQueryFiltro($filtros['estado'], 'cve_edo', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['tipo'] != []) {
            $getQuery = Helpers::getQueryFiltro($filtros['tipo'], 'TIPO_10', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }

        $order .= 'localidad ASC';

        $consulta = collect($this->vistaDatos->getDatos_Calidad($addQuery2, $order));

        return response()->json([
            'datos' => $consulta
        ]);
    }

}
