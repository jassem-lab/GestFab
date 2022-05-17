<?php
session_start();
include('../connexion/cn.php');
	
	$id  = $_GET["ID"] ;	
	
	$maxID="0";
	$re="select max(id) as maxID from erp_bc_produits";
	$query=mysql_query($re);
	while($enreg=mysql_fetch_array($query)){
		$maxID	=	$enreg['maxID'] + 1;
	}
	
	$sql = "select * from  erp_bc_produits WHERE id=".$id;
	$query=mysql_query($sql);
	while($enreg=mysql_fetch_array($query)){
		
		$nom=$enreg['code'].'_copie';
		
		$sql1="INSERT INTO `erp_bc_produits`(`id`,`code`, `code_barre`, `designation`, `unite`, `surface`, `famille`, `prix`, `semi_finis`) VALUES
		('".$maxID."','".$nom."','".$enreg['code_barre']."','".$enreg['designation']."' ,'".$enreg['unite']."' ,'".$enreg['surface']."' ,'".$enreg['famille']."','".$enreg['prix']."' ,'".$enreg['semi_finis']."' )";
		$req1=mysql_query($sql1);
		
	}
	
	$date=date('d/m/Y H:i:s');
	$sql = "select * from  erp_bc_produits_phases WHERE idproduit=".$id;
	$query=mysql_query($sql);
	while($enreg=mysql_fetch_array($query)){
		
		$sql1="INSERT INTO `erp_bc_produits_phases`(`idproduit`, `idphase`, `ordre`, `nomenclature_fabrication`, `date_maj`, `utilisateur_maj`, `sans_nm`) VALUES 
		('".$maxID."','".$enreg['idphase']."','".$enreg['ordre']."','".$enreg['nomenclature_fabrication']."','".$date."','".$_SESSION['erp_bc_IDUSER']."','".$enreg['sans_nm']."')";
		$req1=mysql_query($sql1);
	}
	
		
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../produits.php" </SCRIPT>';
?>