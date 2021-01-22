<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DatosExport;
use App\VistasDatos;
use App\Http\Helpers\Helpers;

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
        $page = $request->page;
        $addQuery = '';
        $addQuery2 = '';
        $order = 'localidad';
        $orderValue = 5;
        $consulta = collect([]);

        if ($filtros['consejo'] != []) {
            $orderTemp = 1;
            $orderValue = $orderValue > $orderTemp ? $orderTemp : $orderValue;
            $getQuery = Helpers::getQueryFiltro($filtros['consejo'], 'consejo_cuenca', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['subcuenca'] != []) {
            $orderTemp = 2;
            $orderValue = $orderValue > $orderTemp ? $orderTemp : $orderValue;
            $getQuery = Helpers::getQueryFiltro($filtros['subcuenca'], 'id_subcuenca', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['region'] != []) {
            $orderTemp = 3;
            $orderValue = $orderValue > $orderTemp ? $orderTemp : $orderValue;
            $getQuery = Helpers::getQueryFiltro($filtros['region'], 'id_region', $addQuery, $addQuery2);
            $addQuery= $getQuery[0];
            $addQuery2= $getQuery[1];
        }
        if ($filtros['municipio'] != []) {
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

        switch ($orderValue) {
            case 1:
                $order = 'consejo_cuenca';
                break;
            case 2:
                $order = 'subcuenca';
                break;
            case 3:
                $order = 'reg_economica';
                break;
            case 4:
                $order = 'municipio ASC, localidad ASC';
                break;
            case 5:
                $order = 'localidad';
                break;
            default:
                break;
        }
        
        switch ($page) {
            case 'demanda':
                $consulta = collect($this->vistaDatos->getDatosTotalesAPBy($addQuery2, $order));
                break;
            case 'cobertura':
                $consulta = collect($this->vistaDatos->getDatosTotalesAP_COB($addQuery2, $order));
                break;
            case 'poblacion':
                $consulta = collect($this->vistaDatos->getDatosTotalesAP_POB($addQuery2, $order));
                break;
            default:
                break;
        }

        return response()->json([
            'datos' => $consulta[0],
            'total' => $consulta[1]
        ]);
    }

    public function exportExcel(Request $request)
    {
        $datos = $request->datos;
        $export = new DatosExport($datos);
    
        return Excel::download($export, 'calculos.xlsx');
    }

    //depurando metodos
    public function consultarMunByFiltros(Request $request)
    {
        $filtros = $request->filtros;
        $tipoVista= $request->tipoVista;
        $addQuery = '';
        $addQuery2 = '';
        $consulta = collect([]);

        switch ($tipoVista) {
            case 'municipio':
                if ($filtros['consejo'] != []) {
                    $getQuery = Helpers::getQueryFiltro($filtros['consejo'], 'consejo_cuenca', $addQuery, $addQuery2);
                    $addQuery= $getQuery[0];
                    $addQuery2= $getQuery[1];
                }
                if ($filtros['subcuenca'] != []) {
                    $getQuery = Helpers::getQueryFiltro($filtros['subcuenca'], 'cve_subcuenca', $addQuery, $addQuery2);
                    $addQuery= $getQuery[0];
                    $addQuery2= $getQuery[1];
                }
                if ($filtros['region'] != []) {
                    $getQuery = Helpers::getQueryFiltro($filtros['region'], 'num_region', $addQuery, $addQuery2);
                    $addQuery= $getQuery[0];
                    $addQuery2= $getQuery[1];
                }
                $consulta = collect($this->vistaDatos->getDatosMunicipiosByFiltros($addQuery, $addQuery2));
                $consulta->groupBy('cve_mun');
                break;
            case 'consejo':
                # code...
                break;
            case 'subcuenca':
                # code...
                break;
            case 'region':
                # code...
                break;
            default:
                break;
        }

        return response()->json([
            'datos' => $consulta
        ]);
    }

    public function consultarByMun(Request $request)
    {
        $municipios = $request->municipios;
        $vista = 'vwDemanda_AP_by_mun ';
        $where = '';

        foreach ($municipios as $key => $value) {
            if($key == 0 && array_key_last($municipios) == $key)
                $where.=  "WHERE cve_mun IN ('".$value ."')";
            elseif($key==0 && array_key_last($municipios) != $key)
                $where.=  "WHERE cve_mun IN ('".$value ."',";
            elseif(array_key_last($municipios) == $key && $key != 0)
                $where.=  "'".$value ."')";
            else
                $where.=  "'".$value."',";
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
            if($key == 0 && array_key_last($consejos) == $key)
                $where.=  "WHERE consejo_cuenca IN ('".$value ."')";
            elseif($key==0 && array_key_last($consejos) != $key)
                $where.=  "WHERE consejo_cuenca IN ('".$value ."',";
            elseif(array_key_last($consejos) == $key && $key != 0)
                $where.=  "'".$value ."')";
            else
                $where.=  "'".$value."',";
        }
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
            if($key == 0 && array_key_last($subcuencas) == $key)
                $where.=  "WHERE cve_subcuenca IN ('".$value ."')";
            elseif($key==0 && array_key_last($subcuencas) != $key)
                $where.=  "WHERE cve_subcuenca IN ('".$value ."',";
            elseif(array_key_last($subcuencas) == $key && $key != 0)
                $where.=  "'".$value ."')";
            else
                $where.=  "'".$value."',";
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
            if($key == 0 && array_key_last($regiones) == $key)
                $where.=  "WHERE num_region IN ('".$value ."')";
            elseif($key==0 && array_key_last($regiones) != $key)
                $where.=  "WHERE num_region IN ('".$value ."',";
            elseif(array_key_last($regiones) == $key && $key != 0)
                $where.=  "'".$value ."')";
            else
                $where.=  "'".$value."',";
        }
        $consulta = collect($this->vistaDatos->getDatosTotalesBy($vista, $where));

        return response()->json([
            'regiones' => $consulta->groupBy('num_region')
        ]);
    }

}
