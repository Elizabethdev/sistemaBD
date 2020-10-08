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
        $vistaConsulta = $request->vista;
        $where = '';

        $consulta = collect($this->vistaDatos->getDatosTotalesBy($vistaConsulta, $where));

        return response()->json([
            'datos' => $consulta->groupBy('cve_mun')
        ]);
    }

    public function consultarMunByFiltros(Request $request)
    {
        $filtros = $request->filtros;
        $addQuery = '';
        $addQuery2 = '';
        $campo = 'CONSEJO_CUENCA';
        if ($filtros['consejo'] != []) {
            $addQuery .= "AND consejo_cuenca IN(";
            $addQuery2 .= "WHERE consejo_cuenca IN(";

            foreach ($filtros['consejo'] as $key => $consejo) {
                if($key == 0){
                    $addQuery.=  "'".$consejo."'";
                    $addQuery2 .= "'".$consejo."'";
                }
                else{
                    $addQuery .= ",'".$consejo."'";
                    $addQuery2 .= ",'".$consejo."'";
                }
            }
            $addQuery.= ")";
            $addQuery2.= ")";
        }
        // dd($addQuery);
        $consulta = collect($this->vistaDatos->getDatosMunByFiltroCuenca($addQuery, $addQuery2));

        return response()->json([
            'municipios' => $consulta->groupBy('cve_mun')
        ]);
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
