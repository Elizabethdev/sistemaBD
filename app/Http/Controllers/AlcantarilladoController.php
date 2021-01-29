<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VistasDatos;
use App\Http\Helpers\Helpers;

class AlcantarilladoController extends Controller
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
        
        return view('website.alcantarillado.alcantarillado', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                            'datos_total' => collect([])]);
    }

    public function cobertura()
    {
        $estados = $this->vistaDatos->getEstados();
        $consejos = $this->vistaDatos->getConsejosC();
        $municipios = $this->vistaDatos->getMunicipios();
        $subcuencas = $this->vistaDatos->getSubcuencas();
        $regionesEco = $this->vistaDatos->getRegionesEco();
        
        return view('website.alcantarillado.cobertura', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                            'datos_total' => collect([])]);
    }
    public function poblacion()
    {
        $estados = $this->vistaDatos->getEstados();
        $consejos = $this->vistaDatos->getConsejosC();
        $municipios = $this->vistaDatos->getMunicipios();
        $subcuencas = $this->vistaDatos->getSubcuencas();
        $regionesEco = $this->vistaDatos->getRegionesEco();
        
        return view('website.alcantarillado.poblacion', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                            'datos_total' => collect([])]);
    }

    public function consultarByFiltros(Request $request)
    {
        $filtros = $request->filtros;
        $page= $request->page;
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
            $getQuery = Helpers::getQueryFiltro($filtros['tipo'], 'TIPO_20', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['rcobertura'] != [] && $filtros['año'] != []) {
            foreach ($filtros['año'] as $key => $value) {
                if($value == '2015') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rcobertura'], 'R_COB_ALC_15', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
                if($value == '2020') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rcobertura'], 'R_COB_ALC_20', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
                if($value == '2030') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rcobertura'], 'R_COB_ALC_30', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
            }
            $addQuery= $getQuery[0];
        }
        if ($filtros['rpoblacion'] != [] && $filtros['año'] != []) {
            foreach ($filtros['año'] as $key => $value) {
                if($value == '2015') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rpoblacion'], 'R_POB_15', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
                if($value == '2020') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rpoblacion'], 'R_POB_20', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
                if($value == '2030') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rpoblacion'], 'R_POB_30', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
            }
            $addQuery= $getQuery[0];
        }
        if ($filtros['pi'] != []) {
            $getQuery = Helpers::getQueryFiltro($filtros['pi'], 'RANGO_PI', $addQuery, $addQuery2);
            $addQuery2= $getQuery[1];
            $addQuery= $getQuery[0];
        }

        // switch ($orderValue) {
        //     case 1:
        //         $order = 'consejo_cuenca';
        //         break;
        //     case 2:
        //         $order = 'subcuenca';
        //         break;
        //     case 3:
        //         $order = 'reg_economica';
        //         break;
        //     case 4:
        //         $order = 'municipio';
        //         break;
        //     case 5:
        //         $order = 'localidad';
        //         break;
        //     default:
        //         break;
        // }
        $order .= 'localidad ASC';

        switch ($page) {
            case 'demanda':
                $consulta = collect($this->vistaDatos->getDatosTotalesALCBy($addQuery2, $order));
                break;
            case 'cobertura':
                $consulta = collect($this->vistaDatos->getDatosTotalesALC_COB($addQuery2, $order));
                break;
            case 'poblacion':
                $consulta = collect($this->vistaDatos->getDatosTotalesALC_POB($addQuery2, $order));
                break;
            default:
                # code...
                break;
        }

        return response()->json([
            'datos' => $consulta[0],
            'total' => $consulta[1]
        ]);
    }

   
   

    

}
