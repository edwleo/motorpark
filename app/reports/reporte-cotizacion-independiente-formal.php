<?php
require_once '../../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    require_once './content/data-reporte-cotizacion-independiente-formal.html';
    $html = ob_get_clean();

    // Inicializo en español y habilito imágenes locales
    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [0, 0, 0, 0]);
    $html2pdf->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $html2pdf->writeHTML($html);
    $html2pdf->output('reporte-cotizacion.pdf');
} catch (\Exception $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
