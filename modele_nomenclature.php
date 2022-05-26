<?php 
error_reporting(E_ALL);
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Delta Web IT");
$objPHPExcel->getProperties()->setLastModifiedBy("Delta Web IT");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', ("Reference"));
$objPHPExcel->getActiveSheet()->SetCellValue('B1', ("Désignation"));
$objPHPExcel->getActiveSheet()->SetCellValue('C1', ("Comp."));
$objPHPExcel->getActiveSheet()->SetCellValue('D1', ("Color"));
$objPHPExcel->getActiveSheet()->SetCellValue('E1', ("Color Tag"));
$objPHPExcel->getActiveSheet()->SetCellValue('F1', ("Cliches"));
$objPHPExcel->getActiveSheet()->SetCellValue('G1', ("Box Qty"));
$objPHPExcel->getActiveSheet()->SetCellValue('H1', ("Jig"));
$objPHPExcel->getActiveSheet()->SetCellValue('I1', ("Mold"));
$objPHPExcel->getActiveSheet()->SetCellValue('J1', ("Net Weight"));
$objPHPExcel->getActiveSheet()->SetCellValue('K1', ("Gross Weight"));
$objPHPExcel->getActiveSheet()->SetCellValue('L1', ("Cavity"));
$objPHPExcel->getActiveSheet()->SetCellValue('M1', ("FM"));
$objPHPExcel->getActiveSheet()->SetCellValue('N1', ("FA"));
$objPHPExcel->getActiveSheet()->SetCellValue('O1', ("FZ"));

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);


	
$objPHPExcel->getActiveSheet()->setTitle('Nomenclature');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="modele_nomenclature.xls"');
header('Cache-Control: max-age=0');

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$writer->save('php://output');
// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";

?>