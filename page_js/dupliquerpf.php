<?php
session_start();
include('../connexion/cn.php');
	
	$id  = $_GET["ID"] ;	
	
	$maxID="0";
	$re="select max(id) as maxID from erp_bc_produitsf";
	$query=mysql_query($re);
	while($enreg=mysql_fetch_array($query)){
		$maxID	=	$enreg['maxID'] + 1;
	}
	
	$sql = "select * from  erp_bc_produitsf WHERE id=".$id;
	$query=mysql_query($sql);
	while($enreg=mysql_fetch_array($query)){
		
		$nom=$enreg['code_interne'].'_copie';
		
		$sql1="INSERT INTO `erp_bc_produitsf`(`id`,`code_interne`, `code_barre`, `designation`, `moule`) VALUES
		('".$maxID."','".$nom."','".$enreg['code_barre']."','".$enreg['designation']."' ,'".$enreg['moule']."'  )";
		$req1=mysql_query($sql1);
		
	}
	
	// $date=date('d/m/Y H:i:s');
	// $sql = "select * from  erp_bc_produits_phases WHERE idproduit=".$id;
	// $query=mysql_query($sql);
	// while($enreg=mysql_fetch_array($query)){
		
	// 	$sql1="INSERT INTO `erp_bc_produits_phases`(`idproduit`, `idphase`, `ordre`, `nomenclature_fabrication`, `date_maj`, `utilisateur_maj`, `sans_nm`) VALUES 
	// 	('".$maxID."','".$enreg['idphase']."','".$enreg['ordre']."','".$enreg['nomenclature_fabrication']."','".$date."','".$_SESSION['erp_bc_IDUSER']."','".$enreg['sans_nm']."')";
	// 	$req1=mysql_query($sql1);
	// }
	
		
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_produitsf.php" </SCRIPT>';
?>