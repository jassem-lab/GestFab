<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;
		
	$sql = "delete from `erp_bc_det_inventaire` WHERE idinventaire=".$id;
	$requete = mysql_query($sql) ;
	
	$sql = "delete from `erp_fab_inventaire` WHERE id=".$id;
	$requete = mysql_query($sql) ;

	$sql = "delete from `erp_fab_compteur_inventaire` WHERE iddoc=".$id;
	$requete = mysql_query($sql) ;

	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_inv.php" </SCRIPT>';
	
  
?>