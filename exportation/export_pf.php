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

$Date =  date('d-m-y') ;


$objPHPExcel->getActiveSheet()->SetCellValue('A1', ("Titre : "));
$objPHPExcel->getActiveSheet()->SetCellValue('B1', ("Liste des Produits finis"));
$objPHPExcel->getActiveSheet()->SetCellValue('A2', ("Date"));
$objPHPExcel->getActiveSheet()->SetCellValue('B2', ($Date));
$objPHPExcel->getActiveSheet()->SetCellValue('A4', ("Code"));
$objPHPExcel->getActiveSheet()->SetCellValue('B4', ("Désignation"));
$objPHPExcel->getActiveSheet()->SetCellValue('C4', ("Code à barre"));
$objPHPExcel->getActiveSheet()->SetCellValue('D4', ("Prix de vente"));
$objPHPExcel->getActiveSheet()->SetCellValue('E4', ("Provenance"));
$objPHPExcel->getActiveSheet()->SetCellValue('F4', ("Seuil d'approvisionnement"));
$objPHPExcel->getActiveSheet()->SetCellValue('H4', ("Type d'emballage"));


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);


	$i = 5;

	session_start();
	include('../connexion/cn.php');

	$article="";
	$req="select * from erp_fab_produits where semi=1  order by code  ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
    	$id					=	$enreg["id"] ;	
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$prix				=	$enreg["prix"] ;
	
        $seuil              =   $enreg["seuil"] ; 
      
        if($enreg["type"==0]){
			$type				=	'Emballage par pièce';
		} else{
			$type				=	'Emballage par séparation';
		}


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
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, ($type));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
           

		$i ++;
	}
	

	
$objPHPExcel->getActiveSheet()->setTitle('Liste des produits PF');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Liste_PF.xls"');
header('Cache-Control: max-age=0');

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$writer->save('php://output');
// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";

?>