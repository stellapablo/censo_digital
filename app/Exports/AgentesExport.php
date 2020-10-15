<?php

namespace App\Exports;

use App\Agente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class AgentesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Agente::select('APYNOM','DOCUME','CUILAG','nrouag','AREA','DENARE','turno','print')->orderBy('turno','DESC')->get();
    }

    public function headings(): array
    {
        return [
            'APELLIDO Y NOMBRE',
            'DNI',
            'CUIL',
            'NRO_AG',
            'AREA',
            'DENARE',
            'TURNO',
            'DJ PRINT'
        ];
    }
}
