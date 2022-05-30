<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;
		
	$sql = "delete from `erp_bc_det_bc` WHERE idbc=".$id;
	$requete = mysql_query($sql) ;
	
	$sql = "delete from `erp_fab_bc` WHERE id=".$id;
	$requete = mysql_query($sql) ;

	$sql = "delete from `erp_fab_compteur_bc` WHERE iddoc=".$id;
	$requete = mysql_query($sql) ;

	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_bc.php" </SCRIPT>';
	
  
?>