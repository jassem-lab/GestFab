<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;

	$sql="delete from erp_bc_paiementsf where id=".$id;
	$requete = mysql_query($sql) ;
	
	$sql_compteur="delete from erp_bc_compteur_paiementsf where iddoc=".$id;
	$requete = mysql_query($sql_compteur) ;
	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_paie.php" </SCRIPT>';

?>