<?php

namespace App\Imports;

use App\Dato;
// use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\Queue\ShouldQueue;

class DatosImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $data = [];
        foreach ($rows as $row) 
        {
            $data[] = [
                'CVE_EDO' => $row['cve_esto'],
                'ESTADO' => $row['estado'],
                'CVE_MUN' => $row['cve_mun'],
                'MUNICIPIO' => $row['municipio'],
                'LOC' => $row['loc'],
                'CVE_U' => $row['cve_u'],
                'NOM_LOC' => $row['nom_loc'],
                'LONGITUD' => $row['longitud'],
                'LATITUD' => $row['latitud'],
                'ALTITUD' => $row['altitud'],
                'POBTOT' => $row['pobtot'],
                'P3YM_HLI' => $row['p3ym_hli'],
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
                'REGION_ECO' => $row['region_eco'],
                'NUMREG' => $row['numreg'],
                'NUMREG_2' => $row['numreg_2'],
            ];
        }

        Dato::insert($data);
        // return new Dato([
        //     'CVE_EDO' => $row['cve_esto'],
        //     'ESTADO' => $row['estado'],
        //     'LOC' => $row['loc'],
        //     'CVE_U' => $row['cve_u'],
        //     'NOM_LOC' => $row['nom_loc'],
        //     'POBTOT' => $row['pobtot'],
        //     'P3YM_HLI' => $row['p3ym_hli'],
        //     'TVIVHAB' => $row['tvivhab'],
        //     'TVIVPAR' => $row['tvivpar'],
        //     'VIVPAR_HAB' => $row['vivpar_hab'],
        //     'PROM_OCUP' => $row['prom_ocup'],
        //     'VPH_AGUADV' => $row['vph_aguadv'],
        //     'VPH_DRENAJ' => $row['vph_drenaj'],
        //     'CONSEJO_CUENCA' => $row['consejo_cuenca'],
        //     'CLAVE' => $row['clave'],
        //     'SUBCUENCA' => $row['subcuenca'],
        //     'REGION' => $row['region'],
        //     'CUENCA' => $row['cuenca'],
        //     'DOF' => $row['dof'],
        //     'CVE_MUN' => $row['cve_mun'],
        //     'MUNICIPIO' => $row['municipio'],
        // ]);
    }

    public function batchSize(): int
    {
        return 2000;
    }

    public function chunkSize(): int
    {
        return 2000;
    }
}
