<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["IDP"] ;
	$idd  = $_GET["ID"] ;	
	
	$sql = "delete from `erp_fab_produits_service` WHERE id=".$idd;
	$requete = mysql_query($sql) ;
	
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../affectation_service.php?IDP='.$id.'" </SCRIPT>';
?>