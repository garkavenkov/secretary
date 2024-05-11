<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;

class ExportDataController extends Controller
{

    const   CONTENT_TYPE_CSV    = 'text/csv';
    const   CONTENT_TYPE_JSON   = 'application/json';
    const   CONTENT_TYPE_EXCEL  = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8';
    const   CONTENT_TYPE_WORD   = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document;charset=utf-8';

    public function exportData(Request $request)
    {
        // dd($request->all());
        $model = $this->getExportModel($request);

        $ids = $this->getIds($request);

        $format = $this->getExportFormat($request);

        $orientation = $this->getOrientation($request);

        $fields = $this->getFields($request);

        $data = $model::findOrFail($ids);

        $exportMethod = 'export' . mb_strtoupper($format);

        call_user_func_array(array($this, $exportMethod), array($data, $fields, $orientation));

    }

    protected function getExportModel($request)
    {
        if (isset($request->model)) {
            return $request->model;
        } else {
            throw new \Exception('Відсутній код моделі експорту');
        }
    }

    protected function getIds($request): array
    {
        if (isset($request->ids)) {
            $ids = explode(',', $request->ids);
            return $ids;
        } else {
            throw new \Exception('Відсутній ідентифікатор (id) запису');
        }
    }

    protected function getExportFormat($request)
    {
        try {
            if (isset($request->format)) {
                $format = $request->format;
            } else {
                throw new \Exception('Відсутній формат файла для експорту данних');
            }            
            if (!in_array($format, ['word', 'excel', 'json', 'csv'])) {
                throw new \Exception("Формат експорта '$format' не підтримується'");
            }
            return $format;
        } catch (\Exception $e) {            
            throw new \Exception($e->getMessage(), 500);
        }
    }

    protected function getOrientation($request)
    {
        try {
            $orientation = 'landscape';
            
            if (isset($request->orientation)) {
                $orientation = $request->orientation;                
                if (!in_array($orientation, ['landscape', 'portrait'])) {
                    throw new \Exception("Оріентація документу '$orientation' не підтримується'");
                }
            }
            return $orientation;
        } catch (\Exception $e) {            
            throw new \Exception($e->getMessage(), 500);
        }
    }

    protected function getFields($request)
    {
        try {                        
            if (isset($request->fields)) {
                $fields = explode(',', $request->fields);
            } else {
                throw new \Exception("Відсутній перелів стовпців для єкспорту даних");
                // make static/protected model's property for list of fields for export
                // and if $request->fields is null, use model's export fields by default
            } 
            
            return $fields;

        } catch (\Exception $e) {            
            throw new \Exception($e->getMessage(), 500);
        }
    }
    
    private function sendFileToBrowser(string $content_type, string $filename)
    {        
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment; filename=" . basename($filename));
        header("Content-Length: " . filesize($filename));
        readfile($filename);
        unlink($filename);
        exit;
    }

    protected function exportCSV($records, array $fields, string $orientation)
    {
        $filename= storage_path('app/tmp/file.csv');
        $fp = fopen($filename, 'w');
        // Row with field's name
        foreach($fields as $field) {
            $data = __("fields.$field");
            $row[] = $data;
        }        
        fputcsv($fp, $row);
        // Rows with data
        foreach($records as $record) {
            $row = [];
            foreach($fields as $field) {                
                $row[] = $record[$field];
            }            
            fputcsv($fp, fields: $row);
        }
        fclose($fp);     
        
        $this->sendFileToBrowser(content_type:self::CONTENT_TYPE_CSV, filename: $filename);

        // header("Content-Type: text/csv");
        // header("Content-Disposition: attachment; filename=file.csv");
        // header("Content-Length: " . filesize($filename));
        // readfile($filename);
        // unlink($filename);
        // exit;
    }

    protected function exportJSON($records, array $fields, string $orientation)
    {
        // dd($records);
        $filename= storage_path('app/tmp/file.json');
        $data = [];
        foreach($records as $record) {
            $row = [];
            foreach($fields as $field) {                
                $row[$field] = $record[$field];
            }            
            $data[] = $row;            
        }
        // dd(json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
        file_put_contents($filename, json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));

        $this->sendFileToBrowser(content_type:self::CONTENT_TYPE_JSON, filename: $filename);

        // header("Content-Type: application/json");
        // header("Content-Disposition: attachment; filename=file.json");
        // header("Content-Length: " . filesize($filename));
        // readfile($filename);
        // unlink($filename);
        // exit;       
    }

    protected function exportEXCEL($records, $fields, $orientation)
    {   
        $filename= storage_path('app/tmp/file.xlsx');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        
        if ($orientation == 'landscape') {
            $activeWorksheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        } else {
            $activeWorksheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
        }

        // Row with field's name
        $column = 1; // A
        foreach($fields as $field) {        
            $activeWorksheet->setCellValue([$column, 1], __("fields.$field"));
            $activeWorksheet->getColumnDimensionByColumn($column)->setAutoSize(true);
            $column++;
        } 

        $fieldNameStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            // 'borders' => [
            //     'top' => [
            //         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            //     ],
            // ],
            // 'fill' => [
            //     'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            //     'rotation' => 90,
            //     'startColor' => [
            //         'argb' => 'FFA0A0A0',
            //     ],
            //     'endColor' => [
            //         'argb' => 'FFFFFFFF',
            //     ],
            // ],
        ];
        
        $activeWorksheet->getStyle([1,1,$column,1])->applyFromArray($fieldNameStyle);
        $row = 2;
        foreach($records as $record) {
            $column = 1;
            foreach($fields as $field) {        
                $activeWorksheet->setCellValue([$column, $row], $record[$field]);
                $column++;
            }
            $row++;            
        } 
        $activeWorksheet->getPageSetup()->setFitToWidth(1);

        $writer = new Xlsx($spreadsheet);
        
        $writer->save($filename);
        
        $this->sendFileToBrowser(content_type:self::CONTENT_TYPE_EXCEL, filename: $filename);

        // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8");
        // header("Content-Disposition: attachment; filename=file.xls");
        // header("Content-Length: " . filesize($filename));
        // readfile($filename);
        // unlink($filename);
        // exit;       
    }
   

    protected function exportWORD($records, $fields, $orientation)
    {
        $filename= storage_path('app/tmp/file.docx');
        // New Word Document
        // echo date('H:i:s'), ' Create new PhpWord object', EOL;
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array('orientation' => $orientation));
        // $header = ['size' => 16, 'bold' => true];

        // 1. Basic table

        // $rows = 10;
        // $cols = 5;
        // $section->addText('Basic table', $header);

        // $table = $section->addTable();
        // for ($r = 1; $r <= $rows; ++$r) {
        //     $table->addRow();
        //     for ($c = 1; $c <= $cols; ++$c) {
        //         $table->addCell(1750)->addText("Row {$r}, Cell {$c}");
        //     }
        // }

        // 2. Advanced table

        // $section->addTextBreak(1);
        // $section->addText('Fancy table', $header);

        // $tableStyleName = 'able';

        $tableStyle = [
            'borderSize' => 6, 
            'borderColor' => '006699', 
            'cellMargin' => 80, 
            'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 
            'cellSpacing' => 50
        ];
        
        $tableFirstRowStyle = [
            'borderBottomSize' => 18, 
            'borderBottomColor' => '0000FF', 
            'bgColor' => '66BBFF'
        ];

        $tableCellStyle = ['valign' => 'center'];

        $tableCellBtlrStyle = [
            'valign' => 'center', 
            'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR
        ];

        $tableFontStyle = [
            'bold' => true
        ];
        
        $phpWord->addTableStyle('', $tableStyle, $tableFirstRowStyle);
        
        $table = $section->addTable($tableStyle);
        // $table->addRow(900);
        $table->addRow();
        // $table->addCell(2000, $tableCellStyle)->addText('Row 1', $tableFontStyle);
        // $table->addCell(2000, $tableCellStyle)->addText('Row 2', $tableFontStyle);
        // $table->addCell(2000, $tableCellStyle)->addText('Row 3', $tableFontStyle);
        // $table->addCell(2000, $tableCellStyle)->addText('Row 4', $tableFontStyle);
        // $table->addCell(500, $tableCellBtlrStyle)->addText('Row 5', $tableFontStyle);
        foreach($fields as $field) {
            $table->addCell()->addText(__("fields.$field"), $tableFontStyle);
        }

        foreach($records as $record) {            
            $table->addRow();
            foreach($fields as $field) {
                $table->addCell()->addText($record[$field]);
            }
        }

        $writer = IOFactory::createWriter($phpWord, 'Word2007');     
        $writer->save($filename);
        
        $this->sendFileToBrowser(content_type:self::CONTENT_TYPE_WORD, filename: $filename);

        // header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document;charset=utf-8");
        // header("Content-Disposition: attachment; filename=file.docx");
        // header("Content-Length: " . filesize($filename));
        // readfile($filename);
        // unlink($filename);
        // exit;       
    }   

}
