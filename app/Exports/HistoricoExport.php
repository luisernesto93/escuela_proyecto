<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

//para dar estilo a las celdas de la tabla
use Maatwebsite\Excel\Concerns\WithStyles;

class HistoricoExport implements FromCollection, WithHeadings, WithStyles
{
    protected $request = null;

    public function __construct($datos)
    {
        $this->request = $datos;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $r_historicos = DB::table('notasgestions')->select('notasgestions.nota_final as nota_final', 'notasgestions.prueba_recuperatoria as prueba_recuperatoria', 'notasgestions.observaciones as observaciones', 'notasgestions.estudiante_id as estudiante_id', 'gestions.descripcion as gestion', 'gestions.anio as anio', 'materias.nivel as nivel', 'materias.sigla as sigla', 'materias.nombre_materia as nombre_materia', 'carreras.nombre as nombre_carrera', 'estudiantes.nombres as nombre_estudiante', 'estudiantes.apellidos as apellido_estudiante', 'estudiantes.id as id_estudiante', 'estudiantes.documento as documento')
            ->join('gestions', 'gestions.id', '=', 'notasgestions.gestion_id')
            ->join('carreras', 'carreras.id', '=', 'notasgestions.carrera_id')
            //       ->join('materias', 'materias.planestudio_id', '')
            ->join('materias', 'materias.id', '=', 'notasgestions.materia_id')
            ->join('estudiantes', 'estudiantes.id', '=', 'notasgestions.estudiante_id')
            ->where('notasgestions.estudiante_id', $this->request->estudiante_id);

        /* if ($this->request->gestion_id != '*') {
            $r_historicos->where('notasgestions.gestion_id', $this->request->gestion_id);
        }

        if ($this->request->carrera_id != '*') {
            $r_historicos->where('notasgestions.carrera_id', $this->request->carrera_id);
        } */

        $resultados = $r_historicos->get();


        foreach ($resultados as $key => $resultado) {
            $result[] = [
                '#' => $key + 1,
                'gestion' => $resultado->gestion . '-' . $resultado->anio,
                'semestre' => $this->textoNivel($resultado->nivel),
                'sigla' => $resultado->sigla ?? '',
                'nombre_materia' => $resultado->nombre_materia ?? '',
                'nota_final' => $resultado->nota_final ?? '',
                'prueba_recuperatoria' => $resultado->prueba_recuperatoria ?? '',
                'observaciones' => $resultado->observaciones ?? '',
            ];
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            '#',
            'GESTION',
            'SEMESTRE',
            'CODIGO',
            'ASIGNATURA',
            'NOTA FINAL',
            'PRUEBA RECUPERATORIA',
            'OBSERVACIONES',
        ];
    }

    public function styles($sheet)
    {

        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 10,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],

        ]);
        $sheet->getStyle('A2:H' . $sheet->getHighestRow())->applyFromArray([
            'font' => [
                'size' => 10,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],

        ]);
    }
    function textoNivel($nivel)
    {
        if ($nivel == 1) {
            return 'PRIMERO';
        } elseif ($nivel == 2) {
            return 'SEGUNDO';
        } elseif ($nivel == 3) {
            return 'TERCERO';
        } elseif ($nivel == 4) {
            return 'CUARTO';
        } elseif ($nivel == 5) {
            return 'QUINTO';
        } elseif ($nivel == 6) {
            return 'SEXTO';
        } elseif ($nivel == 7) {
            return 'SEPTIMO';
        } elseif ($nivel == 8) {
            return 'OCTAVO';
        } elseif ($nivel == 9) {
            return 'NOVENO';
        } elseif ($nivel == 10) {
            return 'DECIMO';
        } elseif ($nivel == 11) {
            return 'UNDECIMO';
        } elseif ($nivel == 12) {
            return 'DUODECIMO';
        }

        return '';
    }
}
