<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;

	$sql="delete from erp_bc_historique_bl where id=".$id;
	$requete = mysql_query($sql) ;
	

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../historique_bl.php" </SCRIPT>';

?>