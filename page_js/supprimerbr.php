<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;

	$sql="delete from erp_bc_br where id=".$id;
	$requete = mysql_query($sql) ;
	
	$sql_compteur="delete from erp_bc_compteur_br where iddoc=".$id;
	$requete = mysql_query($sql_compteur) ;
	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_retour.php" </SCRIPT>';

?>