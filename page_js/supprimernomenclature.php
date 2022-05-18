<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;	
    $idd  = $_GET["IDD"] ;
	
	$sql = "delete from `erp_bc_nomenclatures` WHERE id=".$idd;
	$requete = mysql_query($sql) ;
	
  	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../nomenclatures.php?ID='.$id.'" </SCRIPT>';
?>