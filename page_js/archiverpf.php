<?php
session_start();
include('../connexion/cn.php');
	
	$id  = $_GET["ID"] ;	
	
	$sql = "UPDATE `erp_bc_produits` SET archive=1  WHERE id=".$id;
	$requete = mysql_query($sql) ;
	
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../produits.php" </SCRIPT>';
?>