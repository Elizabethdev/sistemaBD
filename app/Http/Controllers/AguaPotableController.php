<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DatosExport;
use App\VistasDatos;
use App\Http\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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

        return view('website.aguapotable.aguapotable', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                        ]);
    }

    public function cobertura()
    {
        $estados = $this->vistaDatos->getEstados();
        $consejos = $this->vistaDatos->getConsejosC();
        $municipios = $this->vistaDatos->getMunicipios();
        $subcuencas = $this->vistaDatos->getSubcuencas();
        $regionesEco = $this->vistaDatos->getRegionesEco();

        return view('website.aguapotable.cobertura', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                        ]);
    } 
    public function poblacion()
    {
        $estados = $this->vistaDatos->getEstados();
        $consejos = $this->vistaDatos->getConsejosC();
        $municipios = $this->vistaDatos->getMunicipios();
        $subcuencas = $this->vistaDatos->getSubcuencas();
        $regionesEco = $this->vistaDatos->getRegionesEco();

        return view('website.aguapotable.poblacion', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                        ]);
    } 

    public function consultarByvista(Request $request)
    {
        $vistaConsulta= $request->vista;
        $tipo= $request->tipo;
        $where= '';

        $consulta = collect($this->vistaDatos->getDatosTotalesByVista($vistaConsulta, $where));

        return response()->json([
            'datos' => $consulta->groupBy($tipo)
        ]);
    }

    public function consultarByFiltros(Request $request)
    {
        $filtros = $request->filtros;
        $page = $request->pagina;
        $addQuery = '';
        $addQuery2 = '';
        $order = '';
        $orderValue = 5;
        $consulta = collect([]);

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
                    $getQuery = Helpers::getQueryFiltro($filtros['rcobertura'], 'R_COB_AP_15', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
                if($value == '2020') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rcobertura'], 'R_COB_AP_20', $addQuery, $addQuery2);
                    $addQuery2= $getQuery[1];
                }
                if($value == '2030') {
                    $getQuery = Helpers::getQueryFiltro($filtros['rcobertura'], 'R_COB_AP_30', $addQuery, $addQuery2);
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

        $order .= 'localidad ASC';
        
        switch ($page) {
            case 'demanda':
                $cache = collect($this->vistaDatos->getDatosTotalesAP_DEM($addQuery2, $order));
                // if (Cache::has('demanda'.$addQuery2)) {
                //     $cache = Cache::get('demanda'.$addQuery2);
                // } else{
                //     $cache = Cache::rememberForever('demanda'.$addQuery2, function () use ($addQuery2, $order) {
                //         return collect($this->vistaDatos->getDatosTotalesAP_DEM($addQuery2, $order));
                //     });
                // }
                break;
            case 'cobertura':
                $cache = collect($this->vistaDatos->getDatosTotalesAP_COB($addQuery2, $order));
                break;
            case 'poblacion':
                $cache = collect($this->vistaDatos->getDatosTotalesAP_POB($addQuery2, $order));
                break;
            default:
                break;
        }
        $consulta = collect($cache[0])->push($cache[1][0]);
        $total = count($consulta);
        $per_page = 1000;
        $current_page = $request->page ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $consulta = $consulta->toArray();
        $array = array_slice($consulta, $starting_point, $per_page, true);

        $array = new Paginator($array, $total, $per_page, $current_page, [
            'path' => $request->url(),
        ]);

        return response()->json([
            'datos' => $array,
            // 'total' => $cache[1]
        ]);
    }

    public function exportExcel(Request $request)
    {
        try {
            $datos = $request->datos;
            $export = new DatosExport($datos);
        
            return Excel::download($export, 'calculos.xlsx');
        } catch (\Throwable $th) {
            return $th;
        }
    }

}
