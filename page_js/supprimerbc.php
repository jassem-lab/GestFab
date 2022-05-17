<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;

	$sql="delete from erp_bc_bc where id=".$id;
	$requete = mysql_query($sql) ;
	
	$sql_compteur="delete from erp_bc_compteur_bc where iddoc=".$id;
	$requete = mysql_query($sql_compteur) ;
	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_bc.php" </SCRIPT>';

?>