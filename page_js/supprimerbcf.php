<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;
		
	$sql = "delete from `erp_bc_det_bcf` WHERE idbc=".$id;
	$requete = mysql_query($sql) ;
	
	$sql = "delete from `erp_fab_bcf` WHERE id=".$id;
	$requete = mysql_query($sql) ;

	$sql = "delete from `erp_fab_compteur_bcf` WHERE iddoc=".$id;
	$requete = mysql_query($sql) ;

	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_bcf.php" </SCRIPT>';
	
  
?>