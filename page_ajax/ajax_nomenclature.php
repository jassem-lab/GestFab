<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idservice 				= $_POST['idservice']; 
	$idproduit			   	= $_POST['idproduit']; 
	$mp						= $_POST['mp']; 
	$qte				   	= $_POST['qte']; 
	$date_maj				= date('d/m/Y H:i:s');
	
	$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES";
	$sql=$sql." ('".$idproduit."','".$idservice."','".$mp."','".$qte."')";
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"idservice":"'.$idservice.'"}';
	json_encode($json);
	echo $json;		

?>