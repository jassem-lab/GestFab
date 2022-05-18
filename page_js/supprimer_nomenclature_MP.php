<?php
session_start();
include('../connexion/cn.php');
	
	$id  = $_GET["ID"] ;	
	$idd = $_GET["IDD"] ; 
	 $sql = "delete from `erp_bc_nomenclatures_fini` WHERE id=".$idd;
	$requete = mysql_query($sql) ;

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../nomenclatures_produit.php?ID='.$id.'&suc=1" </SCRIPT>'; 
?>