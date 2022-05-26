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

$objPHPExcel->getActiveSheet()->SetCellValue('A1', ("Code Interne"));
$objPHPExcel->getActiveSheet()->SetCellValue('B1', ("Désignation"));
$objPHPExcel->getActiveSheet()->SetCellValue('C1', ("Quantité"));

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

	$i = 2;

	session_start();
	include('connexion/cn.php');

	$article="";
	$req="select * from erp_fab_mp  order by code desc ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code				=	$enreg["code"] ;	
		$des				=	$enreg["designation"] ;
		$qte				=	$enreg["stock"] ;

			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, ($code));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);
			
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, ($des));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, ($qte));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	

		$i ++;
	}
	

	
$objPHPExcel->getActiveSheet()->setTitle('Inventaire MP');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="inventaire_mp.xls"');
header('Cache-Control: max-age=0');

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$writer->save('php://output');
// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";

?>