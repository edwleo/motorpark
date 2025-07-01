<?php
session_start();
use Spipu\Html2Pdf\Html2Pdf;
require_once __DIR__ . '/../vendor/autoload.php';

try {
    ob_end_clean(); 
    ob_start();
    include './reporte-contrato.php';
    $html = ob_get_clean();
    $pdf = new Html2Pdf('P', 'A4', 'es');
    $pdf->writeHTML($html);
    $pdf->output('reporte.pdf'); // Descarga el archivo PDF
} catch (Exception $e) {
    echo 'Error al generar el PDF: ' . $e->getMessage();
}