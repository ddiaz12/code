<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\TableStyle;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PhpSpreadsheet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegulacionModel');
        // Cargar la librería de PhpSpreadsheet
        require_once 'vendor/autoload.php';
    }

    public function descargarRegulaciones()
    {
        // Obtener todas las regulaciones
        $regulaciones = $this->RegulacionModel->getRegulacionExcel();

        // Crear un nuevo Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Homoclave');
        $sheet->setCellValue('D1', 'Objeto');
        $sheet->setCellValue('E1', 'Vigencia');

        // Agrega más encabezados según sea necesario

        // Agregar datos
        $row = 2;
        foreach ($regulaciones as $regulacion) {
            $sheet->setCellValue('A' . $row, isset($regulacion['ID_Regulacion']) ? $regulacion['ID_Regulacion'] : '');
            $sheet->setCellValue('B' . $row, isset($regulacion['Nombre_Regulacion']) ? $regulacion['Nombre_Regulacion'] : '');
            $sheet->setCellValue('C' . $row, isset($regulacion['Homoclave']) ? $regulacion['Homoclave'] : '');
            $sheet->setCellValue('D' . $row, isset($regulacion['Objetivo_Reg']) ? $regulacion['Objetivo_Reg'] : '');
            $sheet->setCellValue('E' . $row, isset($regulacion['Vigencia']) ? $regulacion['Vigencia'] : '');
            // Agrega más columnas según sea necesario
            $row++;
        }

        // Aplicar estilo a la tabla
        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::COLOR_DARKBLUE],
            ],
        ];

        $sheet->getStyle('A1:E1')->applyFromArray($styleArray);

        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'regulaciones.xlsx';

        // Enviar el archivo al navegador para su descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}