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

        return view('components.academico.cuestionario.Report.cuadro_comparativo', ['data' => $this->data] );
    }

    public function styles(Worksheet $sheet)
    {
        for ($i=0; $i < ($this->cantidad_respuestas+1) ; $i++) {
            $index = ''.($i+1);
            $sheet->getStyle($index)->getFont()->setSize(8);
            $sheet->getStyle($index)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($index)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $sheet->getStyle($index)->getAlignment()->setWrapText(true);
            $sheet->getStyle($index)->getQuotePrefix(true);
        }
        return [
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
