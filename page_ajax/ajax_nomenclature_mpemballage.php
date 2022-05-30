<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idsf 					= $_POST['idsf']; 
	$mp						= $_POST['mp']; 
	$qte				   	= $_POST['qte']; 
	$date_maj				= date('d/m/Y H:i:s');
	
	$sql="INSERT INTO `erp_fab_nomenclature_emballage`(`idsemi`, `idmp`, `quantite`) VALUES";
	$sql=$sql." ('".$idsf."','".$mp."','".$qte."')";
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"idsf":"'.$idsf.'"}';
	json_encode($json);
	echo $json;		

?>