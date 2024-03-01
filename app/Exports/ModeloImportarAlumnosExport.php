<?php

namespace App\Exports;

use App\Models\Empresas;
use App\Models\TipoDocumentos;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class ModeloImportarAlumnosExport implements FromView, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        // dd(TipoDocumentos::where('estado',1)->pluck('codigo')->toArray());
        return view('components.academico.alumnos.excel.modelo-importar-alumnos');
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;

                /**
                 * validation for bulkuploadsheet
                 */
                // lista para seleccionar el tipo de documento
                $configs = TipoDocumentos::where('estado',1)->get();
                $string_array = '';
                foreach($configs as $key=>$value){
                    if($key==0){
                        $string_array = $value->codigo;
                    }else{
                        $string_array = $value->codigo.','.$string_array;
                    }

                }


                $objValidation = $sheet->getCell('A2')->getDataValidation();


                $objValidation->setType(DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);

                $objValidation->setFormula1('"' . $string_array . '"');
                for ($i = 3; $i <= 101; $i++) {
                    $event->sheet->getCell("A{$i}")->setDataValidation(clone $objValidation);
                }

                // lista para seleccionar el sexo
                $sexo = 'M,F';
                $objValidation = $sheet->getCell('J2')->getDataValidation();
                $objValidation->setFormula1('"' . $sexo . '"');
                $objValidation->setType(DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                for ($i = 3; $i <= 101; $i++) {
                    $event->sheet->getCell("J{$i}")->setDataValidation(clone $objValidation);
                }

                // lista para seleccionar la empresa
                $empresa = Empresas::where('estado',1)->get();
                $string_empresa = '';
                foreach($empresa as $key=>$value){
                    if($key==0){
                        $string_empresa = $value->razon_social;
                    }else{
                        $string_empresa = $value->razon_social.','.$string_empresa;
                    }

                }
                $objValidation = $sheet->getCell('K2')->getDataValidation();
                $objValidation->setFormula1('"' . $sexo . '"');
                $objValidation->setType(DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setFormula1('"' . $string_empresa . '"');
                for ($i = 3; $i <= 101; $i++) {
                    $event->sheet->getCell("K{$i}")->setDataValidation(clone $objValidation);
                }
            }
        ];
    }
}
