<?php
session_start();
include('../connexion/cn.php');
	
	$id   		 = $_GET["ID"] ;
	$idproduit   = $_GET["idproduit"] ;
	$idservice   = $_GET["idservice"] ;
	
	$sql="UPDATE erp_fab_preparation SET etat=1 where idof=".$id." and idproduit=".$idproduit." and idservice=".$idservice;
	$query=mysql_query($sql);

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../detail_of.php?ID='.$id.'" </SCRIPT>';
	
  
?>