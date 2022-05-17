<?php 
/** Error reporting */
error_reporting(E_ALL);


/** PHPExcel */
include 'Classes/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'Classes/PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
//echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Macsi Centre");
$objPHPExcel->getProperties()->setLastModifiedBy("Macsi Centre");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


// Add some data
//echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0);
/*
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'world!');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'world!');*/


$objPHPExcel->getActiveSheet()->SetCellValue('A1', ("Date de demande"));
$objPHPExcel->getActiveSheet()->SetCellValue('B1', ("Nom et Prénom"));
$objPHPExcel->getActiveSheet()->SetCellValue('C1', ("CIN"));
$objPHPExcel->getActiveSheet()->SetCellValue('D1', ("Société / Emplacement (Projet)"));
$objPHPExcel->getActiveSheet()->SetCellValue('E1', ("Date Début"));
$objPHPExcel->getActiveSheet()->SetCellValue('F1', ("Date Fin"));
$objPHPExcel->getActiveSheet()->SetCellValue('G1', ("Etat"));



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$i = 2;

	session_start();
	include('connexion/cn.php');

	$reqDateDu="";
	$date_debut="";
	if(isset($_GET['date_debut'])){
		if(($_GET['date_debut'])<>""){
			$date_debut		=	$_GET['date_debut'];
			$reqDateDu		=	" and  date_debut >='".$date_debut."'";
		}
	}

	$reqDateAu="";
	$date_fin="";
	if(isset($_GET['date_fin'])){
		if(($_GET['date_fin'])<>""){
			$date_fin		=	$_GET['date_fin'];
			$reqDateAu		=	" and  date_fin <='".$date_fin."'";
		}
	}		
	


	$reqSociete="";
	$soc="0";
	if(isset($_GET['soc'])){
		if(($_GET['soc'])){
			$soc		=	$_GET['soc'];
			$reqSociete	=	" and  exists( select * from gc_salaries where gc_salaries.id=gc_conges.idsalarie and soc =".$soc.")";
		}
	}
	$nom_site="";
	$reqSite="";
	$site="0";
	if(isset($_GET['site'])){
		if(is_numeric($_GET['site'])){
			$site		=	$_GET['site'];
			$reqSite	=	" and  exists( select * from gc_salaries where gc_salaries.id=gc_conges.idsalarie and site=".$site.")";
		}
		
	}	

	$reqc="select * from gc_sites where id=".$site;
	$queryc=mysql_query($reqc);
	while($enregc=mysql_fetch_array($queryc)){
		$nom_site			=	$enregc['site'];
	}	

	$societe			=	"";
	$reqc="select * from gc_societe where id=".$soc;
	$queryc=mysql_query($reqc);
	while($enregc=mysql_fetch_array($queryc)){
		$societe			=	$enregc['raisonsocial'];
	}

	$reqEquipe="";
	$equipe="0";
	if(isset($_GET['equipe'])){
		if(($_GET['equipe'])){
			$mot=',';
			$equipe		=	$_GET['equipe'];
			if(strpos($equipe, $mot) !== false){
				$reqEquipe	=	" and  exists( select * from gc_salaries where gc_salaries.id=gc_conges.idsalarie and  equipe in (".$equipe."))";
			} else{
				$reqEquipe	=	" and  exists( select * from gc_salaries where gc_salaries.id=gc_conges.idsalarie and  equipe =".$equipe.")";	
			}
		}
	}		
	
	
	
	
	$req1="select * from gc_autorisation where 1=1 ".$reqDateAu.$reqDateDu.$reqSociete.$reqSite." order by id";
	$query1=mysql_query($req1);
	while($enreg1=mysql_fetch_array($query1))
	{
		$id					=	$enreg1["id"] 	;
		$idsalarie			=	$enreg1["idsalarie"] ;	
		$dateheure			=	$enreg1["dateheure"] ;
		$date_debut			=	$enreg1["date_debut"] ;
		$date_fin			=	$enreg1["date_fin"] ;
		$observation		=	$enreg1["observation"] ;
		$document			=	$enreg1["document"] ;
		$etat				=	$enreg1["etat"];

		$date_debut			=   date("d-m-Y", strtotime($date_debut));
		$date_fin			=   date("d-m-Y", strtotime($date_fin));
		
		$salarie="";
		$reqc="select * from gc_salaries where id=".$idsalarie;
		$queryc=mysql_query($reqc);
		while($enregc=mysql_fetch_array($queryc)){
			$salarie			=	$enregc['nom']." ".$enregc['prenom'];
			$cin				=	$enregc['cin'];
			
			$societe			=	"";
			$reqcc="select * from gc_societe where id=".$enregc['soc'];
			$querycc=mysql_query($reqcc);
			while($enregcc=mysql_fetch_array($querycc)){
				$societe			=	$enregcc['raisonsocial'];
			}
			$site			=	"";
			$reqcc="select * from gc_sites where id=".$enregc['site'];
			$querycc=mysql_query($reqcc);
			while($enregcc=mysql_fetch_array($querycc)){
				$site			=	$enregcc['site'];
			}				
		}		
		if($enreg1['etat']==0){ 
			$etat = "En attente";
		} elseif($enreg1['etat']==1){
			$etat="Validé";
		} else{
			$etat="Refusé";
		}
			
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, ($dateheure));
		$objPHPExcel->getActiveSheet()
		->getStyle('A'.$i)
		->getNumberFormat()
		->setFormatCode(
			PHPExcel_Style_NumberFormat::FORMAT_TEXT
		);	
		
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, ($salarie));
		$objPHPExcel->getActiveSheet()
		->getStyle('B'.$i)
		->getNumberFormat()
		->setFormatCode(
			PHPExcel_Style_NumberFormat::FORMAT_TEXT
		);		

		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, ($cin));
		$objPHPExcel->getActiveSheet()
		->getStyle('C'.$i)
		->getNumberFormat()
		->setFormatCode(
			PHPExcel_Style_NumberFormat::FORMAT_TEXT
		);		

		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, ($societe.' - '.$site));
		$objPHPExcel->getActiveSheet()
		->getStyle('D'.$i)
		->getNumberFormat()
		->setFormatCode(
			PHPExcel_Style_NumberFormat::FORMAT_TEXT
		);				

		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, ($date_debut));
		$objPHPExcel->getActiveSheet()
		->getStyle('E'.$i)
		->getNumberFormat()
		->setFormatCode(
			PHPExcel_Style_NumberFormat::FORMAT_TEXT
		);			

		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, ($date_fin));
		$objPHPExcel->getActiveSheet()
		->getStyle('F'.$i)
		->getNumberFormat()
		->setFormatCode(
			PHPExcel_Style_NumberFormat::FORMAT_TEXT
		);		


		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, (($etat)));
		$objPHPExcel->getActiveSheet()
		->getStyle('G'.$i)
		->getNumberFormat()
		->setFormatCode(
			PHPExcel_Style_NumberFormat::FORMAT_TEXT
		);

		
		$i ++;
	}	




// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('LISTE DES AUTORISATION');

		
// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="liste_autorisation.xls"');
header('Cache-Control: max-age=0');

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$writer->save('php://output');
// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";

?>