<?php
session_start();
include('../connexion/cn.php');
	
	$id  = $_GET["ID"] ;	
	
	$sql = "UPDATE `erp_bc_clients` SET archive=0  WHERE id=".$id;
	$requete = mysql_query($sql) ;
	
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_clients.php" </SCRIPT>';
?>