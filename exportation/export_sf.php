<?php 

ini_set('memory_limit', '512M'); 
error_reporting(E_ALL);
include '../Classes/PHPExcel.php';
include '../Classes/PHPExcel/Writer/Excel2007.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Delta Web IT");
$objPHPExcel->getProperties()->setLastModifiedBy("Delta Web IT");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', ("Code"));
$objPHPExcel->getActiveSheet()->SetCellValue('B1', ("Désignation"));
$objPHPExcel->getActiveSheet()->SetCellValue('C1', ("Code à barre"));
$objPHPExcel->getActiveSheet()->SetCellValue('D1', ("Prix de vente"));
$objPHPExcel->getActiveSheet()->SetCellValue('E1', ("Provenance"));
$objPHPExcel->getActiveSheet()->SetCellValue('F1', ("Seuil d'approvisionnement"));


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);


	$i = 2;

	session_start();
	include('../connexion/cn.php');

	$article="";
	$req="select * from erp_fab_produits where semi=0  order by code  ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
    	$id					=	$enreg["id"] ;	
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$prix				=	$enreg["prix"] ;
		$type				=	$enreg["type"] ;
        $seuil              =   $enreg["seuil"] ; 
      
	


			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, ($code));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);
			
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, ($code_barre));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, ($designation));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, ($prix));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
            $provenance="";
            $req1="select * from erp_fab_classe where id=".$enreg['provenance'];
            $query1=mysql_query($req1);
            while($enreg1=mysql_fetch_array($query1)){
                $provenance	=	$enreg1['classe'];
            
           
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, ($provenance));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	 }	
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, ($seuil));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
           

		$i ++;
	}
	

	
$objPHPExcel->getActiveSheet()->setTitle('Liste des produits SF');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Liste_SF.xls"');
header('Cache-Control: max-age=0');

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$writer->save('php://output');
// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";

?>