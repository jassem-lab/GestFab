<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML('You can<br><p align="center">waaaaaaa fffffffffff ggggggggggggg waaaaaaa fffffffffff ggggggggggggg </p>and add a horizontal rule:<br><hr>');
$pdf->Output();
?>
