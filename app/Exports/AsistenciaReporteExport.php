<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Size;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AsistenciaReporteExport implements FromView, WithStyles
{

    public $data;
    public $cantidad_alumnos;

    public function __construct(string $json)
    {
        $this->data = json_decode($json);

        $this->cantidad_alumnos = sizeof($this->data->alumnos)+10;


    }

    public function view(): View
    {
        // dd($this->data);
        // dd($this->cantidad_alumnos);
        return view('components.academico.aulas.report.asistencia_reporte_excel', ['data' => $this->data] );
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->mergeCells('C3:D3');
        return [
            // 'A1' => ['font' => ['italic' => true]],
            'A8:H9' =>[
                'font' => ['size' => 8],
                'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]],
            'A10:H'.$this->cantidad_alumnos.'' =>[
                'font' => ['size' => 8],
                'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                // 'wrapText' => true,
            ]],
            'A3:C7' =>[
                'font' => ['size' => 8]
            ],
            'E3:E7' =>[
                'font' => ['size' => 8]
            ],
            'F3:F7' =>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    // 'wrapText' => true,
                ]
            ],

            'C2:D2' =>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    // 'wrapText' => true,
                ]
            ],
            'C1' =>[
                'font' => ['size' => 10],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    // 'wrapText' => true,
                ]
            ],
            'C3' =>[
                'font' => ['size' => 8, 'width'     => 50,],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ],

            // 'C'  => ['font' => ['size' => 16]],
            // 'C'  => ['font' => ['size' => 16]],
            // 'C'  => ['font' => ['size' => 16]],

        ];
    }
}
