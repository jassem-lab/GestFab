<?php
session_start();
include('../connexion/cn.php');
	
	$id  = $_GET["ID"] ;	
	
	$sql = "UPDATE `erp_bc_intervalles` SET archive=1  WHERE id=".$id;
	$requete = mysql_query($sql) ;
	
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../intervalle_prix.php" </SCRIPT>';
?>