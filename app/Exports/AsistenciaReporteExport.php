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
    public $cel_firma;

    public function __construct(string $json)
    {
        $this->data = json_decode($json);

        $this->cantidad_alumnos = sizeof($this->data->alumnos)+12;
        $this->cel_firma = $this->cantidad_alumnos+3;


    }

    public function view(): View
    {
        // dd($this->data);
        // dd($this->cel_firma);
        return view('components.academico.aulas.report.asistencia_reporte_excel', ['data' => $this->data] );
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('C2:D3');
        $sheet->mergeCells('E2:F3');
        $sheet->mergeCells('G2:H3');
        //firmas
        $sheet->mergeCells('B'.$this->cel_firma.':C'.($this->cel_firma+2));
        $sheet->mergeCells('E'.$this->cel_firma.':F'.($this->cel_firma+2));
        return [
            // 'A1' => ['font' => ['italic' => true]],
            'A5:D9' =>[
                'font' => ['size' => 8],
                'alignment' => [
                'wrapText' => true,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]],
            'E5:E9' =>[
                'font' => ['size' => 8],
                'alignment' => [

                'wrapText' => true,
            ]],
            'A12:H'.$this->cantidad_alumnos.'' =>[
                'font' => ['size' => 8],
                'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]],
            'F5:H9' =>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ]
            ],
            'A10:H11' =>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ]
            ],
            'C2' =>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ],
            'C3' =>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ],
            'C3' =>[
                'font' => ['size' => 8, ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ],

            'D2:E3' =>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ],
            'F2:G2'=>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ],
            'E'.$this->cel_firma.':F'.($this->cel_firma+2).'' =>[
                'font' => ['size' => 8],
                'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]],
            'B'.$this->cel_firma.':C'.($this->cel_firma+2).'' =>[
                'font' => ['size' => 8],
                'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]],
        ];
    }
}
