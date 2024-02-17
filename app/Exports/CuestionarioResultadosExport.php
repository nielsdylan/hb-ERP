<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CuestionarioResultadosExport implements FromView, WithStyles
{
    public $data;
    public $cantidad_respuestas;
    public $cantidad_preguntas;

    public function __construct(string $json)
    {
        $this->data = json_decode($json);
        $this->cantidad_respuestas = sizeof($this->data->respuestas);
        $this->cantidad_preguntas = sizeof($this->data->preguntas);
    }

    public function view(): View
    {
        // dd($this->data);
        return view('components.academico.cuestionario.Report.cuadro_comparativo', ['data' => $this->data] );
    }

    public function styles(Worksheet $sheet)
    {
        return [
            '1'=>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ],
            'A'=>[
                'font' => ['size' => 8],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'quotePrefix'    => true
            ]
        ];
    }
}
