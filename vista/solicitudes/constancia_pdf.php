<?php

require_once(PDF.'tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($this->titulo);
$pdf->SetTitle('Constancia de Residencia');
$pdf->SetSubject('Impresion en TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setCellPaddings(0,0,0,0);
$pdf->SetAutoPageBreak(TRUE, 0);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->AddPage();

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

ob_start();

?>
<!-- INICIO DEL CONTENIDO -->
<?php
echo $this->header_constancia;
?>


<!-- FIN DEL CONTENIDO -->
<?php

$html=ob_get_clean();
$pdf->writeHTML($html, true, 0, true, true);
$pdf->Output('Constancia_residencia.pdf', 'I');

?>