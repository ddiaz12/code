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
        // Obtener todas las regulaciones desde el modelo
        $regulaciones = $this->RegulacionModel->getRegulacionExcel();

        // Crear un nuevo Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar encabezados con los campos solicitados
        $sheet->setCellValue('A1', 'Nombre regulación')
            ->setCellValue('B1', 'Ambito de aplicacion')
            ->setCellValue('C1', 'Tipo ordenamiento')
            ->setCellValue('D1', 'Fecha expedición')
            ->setCellValue('E1', 'Vigencia')
            ->setCellValue('F1', 'Fecha de publicacion')
            ->setCellValue('G1', 'Fecha de entrada en vigor')
            ->setCellValue('H1', 'Fecha de ultima actualizacion')
            ->setCellValue('I1', 'Orden de gobierno que la emite')
            ->setCellValue('J1', 'Regulaciones vinculadas')
            ->setCellValue('K1', 'Enlace oficial de la regulacion')
            ->setCellValue('L1', 'Tramites y servicio');

        // Recorrer los datos de las regulaciones y agregarlos al Excel
        $row = 2; // Comienza en la fila 2 para los datos
        foreach ($regulaciones as $regulacion) {
            $sheet->setCellValue('A' . $row, $regulacion->Nombre_Regulacion)
                ->setCellValue('B' . $row, $regulacion->Ambito_Aplicacion)
                ->setCellValue('C' . $row, $regulacion->Tipo_Ordenamiento)
                ->setCellValue('D' . $row, $regulacion->Fecha_Exp)
                ->setCellValue('E' . $row, $regulacion->Vigencia)
                ->setCellValue('F' . $row, $regulacion->Fecha_Publi)
                ->setCellValue('G' . $row, $regulacion->Fecha_vigor)
                ->setCellValue('H' . $row, $regulacion->Fecha_Act)
                ->setCellValue('I' . $row, $regulacion->Orden_Gob)
                ->setCellValue('J' . $row, $regulacion->Regulaciones_Vinculadas)
                ->setCellValue('K' . $row, $regulacion->Enlace_Oficial)
                ->setCellValue('L' . $row, $regulacion->Tramites_Servicio);
            $row++;
        }

        // Aplicar estilo a la tabla de encabezados
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

        // Aplicar estilos solo a la fila de encabezados (A1:J1)
        $sheet->getStyle('A1:F1')->applyFromArray($styleArray);

        // Ajustar ancho automático para las columnas
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'regulaciones.xlsx';

        // Enviar el archivo al navegador para su descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function descargarRegulacionesOrdenamiento()
    {
        // Obtener los datos de los tipos de ordenamiento jurídico
        $ordenamientos = $this->RegulacionModel->countTipoOrdenamiento();

        // Crear un nuevo Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar encabezados
        $sheet->setCellValue('A1', 'Dependencia');
        $sheet->setCellValue('B1', 'Acuerdo');
        $sheet->setCellValue('C1', 'Aviso');
        $sheet->setCellValue('D1', 'Bases');
        $sheet->setCellValue('E1', 'Calendario');
        $sheet->setCellValue('F1', 'Circular');
        $sheet->setCellValue('G1', 'Código');
        $sheet->setCellValue('H1', 'Constitución');
        $sheet->setCellValue('I1', 'Convenio');
        $sheet->setCellValue('J1', 'Convocatoria');
        $sheet->setCellValue('K1', 'Criterios');
        $sheet->setCellValue('L1', 'Declaratoria');
        $sheet->setCellValue('M1', 'Decreto');
        $sheet->setCellValue('N1', 'Directiva');
        $sheet->setCellValue('O1', 'Disposiciones');
        $sheet->setCellValue('P1', 'Estatuto');
        $sheet->setCellValue('Q1', 'Exención de MIR');
        $sheet->setCellValue('R1', 'Guía');
        $sheet->setCellValue('S1', 'Ley');
        $sheet->setCellValue('T1', 'Lineamientos');
        $sheet->setCellValue('U1', 'Lista');
        $sheet->setCellValue('V1', 'Manual');
        $sheet->setCellValue('W1', 'Metodología');
        $sheet->setCellValue('X1', 'Norma Oficial Mexicana');
        $sheet->setCellValue('Y1', 'Normas');
        $sheet->setCellValue('Z1', 'Presupuesto');
        $sheet->setCellValue('AA1', 'Procedimiento');
        $sheet->setCellValue('AB1', 'Programa');
        $sheet->setCellValue('AC1', 'Reglamento');
        $sheet->setCellValue('AD1', 'Reglas');
        $sheet->setCellValue('AE1', 'Resolución');
        $sheet->setCellValue('AF1', 'Otros');
        $sheet->setCellValue('AG1', 'Total');

        // Inicializar un array para almacenar los datos por dependencia
        $data = [];

        // Recorrer los datos de los tipos de ordenamiento jurídico y agregarlos al array
        foreach ($ordenamientos as $ordenamiento) {
            $dependencia = $ordenamiento->Tipo_Dependencia;
            $tipoOrdenamiento = $ordenamiento->Tipo_Ordenamiento;
            $count = $ordenamiento->count;

            if (!isset($data[$dependencia])) {
                $data[$dependencia] = array_fill_keys([
                    'Acuerdo',
                    'Aviso',
                    'Bases',
                    'Calendario',
                    'Circular',
                    'Código',
                    'Constitución',
                    'Convenio',
                    'Convocatoria',
                    'Criterios',
                    'Declaratoria',
                    'Decreto',
                    'Directiva',
                    'Disposiciones',
                    'Estatuto',
                    'Exención de MIR',
                    'Guía',
                    'Ley',
                    'Lineamientos',
                    'Lista',
                    'Manual',
                    'Metodología',
                    'Norma Oficial Mexicana',
                    'Normas',
                    'Presupuesto',
                    'Procedimiento',
                    'Programa',
                    'Reglamento',
                    'Reglas',
                    'Resolución',
                    'Otros',
                    'Total'
                ], 0);
            }
            $data[$dependencia][$tipoOrdenamiento] = $count;
            $data[$dependencia]['Total'] += $count;
        }

        // Agregar los datos al Excel
        $row = 2;
        foreach ($data as $dependencia => $counts) {
            $sheet->setCellValue('A' . $row, $dependencia);
            $col = 'B';
            foreach ($counts as $count) {
                $sheet->setCellValue($col . $row, $count);
                $col++;
            }
            $row++;
        }

        // Aplicar estilo a la tabla de encabezados
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

        // Aplicar estilos solo a la fila de encabezados (A1:AF1)
        $sheet->getStyle('A1:AG1')->applyFromArray($styleArray);

        // Ajustar ancho automático para las columnas
        foreach (range('A', 'AG') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'regulaciones_ordenamiento.xlsx';

        // Enviar el archivo al navegador para su descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

}