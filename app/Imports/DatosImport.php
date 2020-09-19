<?php

namespace App\Imports;

use App\Dato;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Dato([
            'LOC' => $row['loc'],
            'CVE_U' => $row['cve_u'],
            'NOM_LOC' => $row['nom_loc'],
            'POBTOT' => $row['pobtot'],
            'P3YM_HLI' => $row['p3ym_hli'],
            '%POBIND' => $row['pob_ind'],
            'RangoPI' => $row['rango_pi'],
            'PEA' => $row['pea'],
            'POCUPADA' => $row['pocupada'],
            'TVIVHAB' => $row['tvivhab'],
            'TVIVPAR' => $row['tvivpar'],
            'VIVPAR_HAB' => $row['vivpar_hab'],
            'PROM_OCUP' => $row['prom_ocup'],
            'VPH_AGUADV' => $row['vph_aguadv'],
            'VPH_DRENAJ' => $row['vph_drenaj'],
            'CONSEJO_CUENCA' => $row['consejo_cuenca'],
            'CLAVE' => $row['clave'],
            'SUBCUENCA' => $row['subcuenca'],
            'REGION' => $row['region'],
            'CUENCA' => $row['cuenca'],
            'DOF' => $row['dof'],
            'CVE_MUN' => $row['cve_mun'],
            'MUNICIPIO' => $row['municipio'],
            'POBTOT_10' => $row['pobtot_10'],
        ]);
    }
}
