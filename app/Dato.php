<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dato extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CVE_EDO', 'ESTADO', 'LOC','CVE_U', 'NOM_LOC', 'LONGITUD', 'LATITUD', 'ALTITUD', 'POBTOT', 'P3YM_HLI', '%POBIND', 'RangoPI', 'TVIVHAB', 'TVIVPAR',
        'VIVPAR_HAB', 'PROM_OCUP', 'VPH_AGUADV', 'VPH_DRENAJ', 'CONSEJO_CUENCA', 'CLAVE', 'SUBCUENCA', 'REGION',
        'CUENCA', 'DOF', 'CVE_MUN', 'MUNICIPIO', 'REGION_ECO', 'NUMREG',
    ];

}
