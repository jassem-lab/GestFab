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
if(isset($_GET['ID'])){
	$id = $_GET['ID'];
	
}else{
	$id = "0";		
}
// $req="select * from erp_fab_service where id=".$_GET['ID']; 
// $query=mysql_query($req);
// while($enreg=mysql_fetch_array($query))
// {
// 	$service			=	$enreg["service"] ;
// 	$objPHPExcel->getActiveSheet()->SetCellValue('A1', ($service));
// }
$Date =  date('d-m-y') ;


$objPHPExcel->getActiveSheet()->SetCellValue('A2', ($Date));
$objPHPExcel->getActiveSheet()->SetCellValue('A3', ("Produit"));
$objPHPExcel->getActiveSheet()->SetCellValue('B3', ("Comp"));
$objPHPExcel->getActiveSheet()->SetCellValue('C3', ("color"));
$objPHPExcel->getActiveSheet()->SetCellValue('D3', ("cliche"));
$objPHPExcel->getActiveSheet()->SetCellValue('E3', ("Box Qty"));
$objPHPExcel->getActiveSheet()->SetCellValue('F3', ("Jig"));
$objPHPExcel->getActiveSheet()->SetCellValue('G3', ("Mold"));
$objPHPExcel->getActiveSheet()->SetCellValue('H3', ("Net Weight"));
$objPHPExcel->getActiveSheet()->SetCellValue('I3', ("Gross Weight"));
$objPHPExcel->getActiveSheet()->SetCellValue('J3', ("Cavity"));

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

	$i = 5;

	session_start();
	include('../connexion/cn.php');
    $service 			=	'';
	$temps_execution 	=	0;
	$couleur		 	=	0;
	$cliche			 	=	'';
	$jig			 	=	'';
	$poids_net		 	=	'';
	$poids_brute	 	=	0;
	$box_qty			=	"";
	$cavity				=	0;
	$moule				=	0;
	$article="";
	$req="select * from erp_fab_produits_service where idservice=".$_GET['ID'];
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
        $service 			=	$enreg['idservice'];
		$temps_execution 	=	$enreg['temps_execution'];
		$couleur		 	=	$enreg['couleur'];
		$cliche			 	=	$enreg['cliche'];
		$jig			 	=	$enreg['jig'];
		$poids_net		 	=	$enreg['poids_net'];
		$poids_brute	 	=	$enreg['poids_brute'];
		$cavity			 	=	$enreg['cavity'];
		$box_qty			=	$enreg['box_qty'];
		$moule				=	$enreg['moule'];
        $sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enreg["idproduit"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}
        $reqser="select * from erp_fab_couleurs where id=".$couleur;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$couleur 			=	$enregser['couleur'].'-'.$enregser['designation'];
		}	
			
		$reqser="select * from erp_fab_cliches where id=".$cliche;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$cliche 			=	$enregser['cliche'];
		}

		$reqser="select * from erp_fab_jig where id=".$jig;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$jig 			=	$enregser['jig'];
		}	

		$reqser="select * from erp_fab_moules where id=".$moule;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$moule 			=	$enregser['moule'];
		}			



			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, ($sproduit));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);
			
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, ($temps_execution));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, ($couleur));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, ($cliche));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, ($box_qty));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, ($jig));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, ($moule));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, ($poids_net));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, ($poids_brute));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, ($cavity));
			$objPHPExcel->getActiveSheet()
			->getStyle('A'.$i)
			->getNumberFormat()
			->setFormatCode(
				PHPExcel_Style_NumberFormat::FORMAT_TEXT
			);	
         

		$i ++;
	}
	$req="select * from erp_fab_service where id=".$id; 
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$service			=	$enreg["service"] ;
	}

	
$objPHPExcel->getActiveSheet()->setTitle('Nm'.$service);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Liste_nomenclature_serv.xls"');
header('Cache-Control: max-age=0');

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$writer->save('php://output');
// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";

?>