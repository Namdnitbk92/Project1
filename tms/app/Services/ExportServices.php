<?php

namespace App\Services;

use Excel;

class ExportServices
{

    protected $config;
    protected $data;

    public function __construct($config, $data = [])
    {
        $this->config = $config;
        $this->data = $data;
    }

    public function buildExport()
    {
        if (empty($this->data)) {
            return 'data for excel is empty';
        }

        Excel::create($this->config->name, function ($excel) {
            $excel->getDefaultStyle();
            $excel->setCreator($this->config->creator)
                ->setCompany($this->config->company);
            $excel->sheet($this->config->sheetName, function ($sheet) {
                $sheet->setHeight(5, 50);
                if (property_exists($this->config, 'style')) {
                    $style = $this->config->style ? $this->config->style : [
                        'font' => [
                            'name' => 'Calibri',
                            'size' => 15,
                            'bold' => true
                        ]
                    ];
                    $sheet->setStyle($style);
                }

                $sheet->setOrientation('landscape');
                $row = 0;
                $sheet->row($row++, ['FRAMGIA TMS SYSTEM', null, null, null, null, null]);
                $sheet->row($row++, []);
                $sheet->row($row++, []);
                $sheet->row($row++, [null, null, null, 'Course List', null, null]);
                $sheet->row($row++, []);
                $sheet->row($row++, $this->config->datafields);
                $sheet->cells('A3:G5', function ($cells) {
                    $cells->setFont([
                        'family' => 'Calibri',
                        'size' => '14',
                        'bold' => true
                    ]);

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->row(5, function ($row) {
                    $row->setBackground('#337ab7');
                });

                $sheet->cells('A5:G' . (5 + sizeof($this->data)), function ($cells) {
                    $cells->setFont([
                        'family' => 'Calibri',
                        'size' => '12',
                    ]);

                    $cells->setBorder('solid', 'none', 'none', 'solid');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->setBorder('A3:G' . (5 + sizeof($this->data)), 'thin');

                $sheet->setAutoSize(true);

                $this->buildContent($sheet, $row);

            });

        })->export((property_exists($this->config,'exportType') ? $this->config->exportType : 'xls'));
    }

    private function buildContent($sheet, $row)
    {
        foreach ($this->data as $d) {
            $temp = [];
            $index = 0;
            foreach ($this->data[0]->getColumn() as $field) {
                $temp[$index++] = $d->$field;
            }
            $sheet->row($row++, $temp);
        }

    }

    private function exportPdf(Request $request)
    {
        Excel::create('Laravel Excel', function ($excel) {
            $excel->setCreator('Framgia')
                ->setCompany('Framgia');
            $excel->sheet('Excel sheet', function ($sheet) {
                $sheet->setOrientation('landscape');
            });

        })->export('pdf');

        return redirect()->route('course.index');
    }

}


