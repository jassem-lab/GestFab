<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;

	$sql="delete from erp_bc_produits where id=".$id;
	$requete = mysql_query($sql) ;
	
	$sql_compteur="delete from erp_bc_produits where id=".$id;
	$requete = mysql_query($sql_compteur) ;
	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_produit.php" </SCRIPT>';

?>