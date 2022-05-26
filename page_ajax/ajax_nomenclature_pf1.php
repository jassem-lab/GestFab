<?php
	session_start(); 
	include('../connexion/cn.php');  
 
	$idproduit			   	= $_POST['idproduit']; 
	$mp						= $_POST['mp']; 
	$qte				   	= $_POST['qte']; 
	$date_maj				= date('d/m/Y H:i:s');
	
	$sql="INSERT INTO `erp_fab_nomenclature_pf`(`idproduit`, `idmp`, `quantite`) VALUES";
	$sql=$sql." ('".$idproduit."','".$mp."','".$qte."')";
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"idproduit":"'.$idproduit.'"}';
	json_encode($json);
	echo $json;		

?>