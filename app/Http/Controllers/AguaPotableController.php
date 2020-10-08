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

        // $datos_total = $this->vistaDatos->getDatosTotales();
        // $grouped = $datos_total->groupBy('cve_mun');
        
        return view('website.aguapotable', ['estados' => $estados, 
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

        $consulta = collect($this->vistaDatos->getDatosTotalesBy($vistaConsulta, $where));

        return response()->json([
            'datos' => $consulta->groupBy($tipo)
        ]);
    }

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
                    $getQuery = $this->getQueryFiltro($filtros['consejo'], 'consejo_cuenca', $addQuery, $addQuery2);
                    $addQuery= $getQuery[0];
                    $addQuery2= $getQuery[1];
                }
                if ($filtros['subcuenca'] != []) {
                    $getQuery = $this->getQueryFiltro($filtros['subcuenca'], 'cve_subcuenca', $addQuery, $addQuery2);
                    $addQuery= $getQuery[0];
                    $addQuery2= $getQuery[1];
                }
                if ($filtros['region'] != []) {
                    $getQuery = $this->getQueryFiltro($filtros['region'], 'num_region', $addQuery, $addQuery2);
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

    public function getQueryFiltro($filtros, $field, $query, $query2)
    {
        $addQuery = $query;
        $addQuery2 = $query2;

        $addQuery .= "AND ".$field." IN(";
        if($addQuery2 == '')
            $addQuery2 .= "WHERE ".$field." IN(";
        else 
            $addQuery2 .= "AND ".$field." IN(";

        foreach ($filtros as $key => $filtro) {
            if($key == 0){
                $addQuery.=  "'".$filtro."'";
                $addQuery2 .= "'".$filtro."'";
            }
            else{
                $addQuery .= ",'".$filtro."'";
                $addQuery2 .= ",'".$filtro."'";
            }
        }
        $addQuery.= ") ";
        $addQuery2.= ") ";

        return [$addQuery, $addQuery2];
    }

    //depurando metodos

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
