<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VistasDatos;

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
        $localidades = collect([]);

        // $datos_total = $this->vistaDatos->getDatosTotales();
        // $grouped = $datos_total->groupBy('cve_mun');
        
        return view('website.alcantarillado', ['estados' => $estados, 
                                            'consejos' => $consejos, 
                                            'municipios' => $municipios, 
                                            'subcuencas' => $subcuencas, 
                                            'regionesEco' => $regionesEco,
                                            'localidades' => $localidades,
                                            'datos_total' => collect([])]);
    }

   
    public function consultarByvista(Request $request)
    {
        $vista = $request->vista;
        $vistaConsulta = 'vwDemanda_AP_by_mun';
        $where = '';

        switch ($vista) {
            case 'municipio':
                $vistaConsulta = 'vwDemanda_AP_by_mun';
                break;
            case 'consejo':
                    $vistaConsulta = 'vwDemanda_AP_BY_CONSEJO';
                    break;
            
            default:
                # code...
                break;
        }
        
        $consulta = collect($this->vistaDatos->getDatosTotalesBy($vistaConsulta, $where));

        return response()->json([
            'datos' => $consulta->groupBy('cve_mun')
        ]);
    }

    public function consultarMunByConsejo(Request $request)
    {
        $consejos = $request->consejos;
        $campo = 'CONSEJO_CUENCA';

        $consulta = collect($this->vistaDatos->getMunByConsejo($consejos, $campo));

        return response()->json([
            'municipios' => $consulta->groupBy('cve_mun')
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
