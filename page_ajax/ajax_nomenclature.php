<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idphase   				= $_POST['idphase']; 
	$idproduit			   	= $_POST['idproduit']; 
	$mp						= $_POST['mp']; 
	$qte				   	= $_POST['qte']; 
	$date_maj				= date('d/m/Y H:i:s');
	
	$sql="INSERT INTO `erp_nomenclature`(`idphase`, `idproduit`, `idmp`, `quantite`, `idutilisateur_maj`, `date_maj`) VALUES";
	$sql=$sql." ('".$idphase."','".$idproduit."','".$mp."','".$qte."','".$_SESSION['ERP_IDUSER']."','".$date_maj."')";
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"idphase":"'.$idphase.'"}';
	json_encode($json);
	echo $json;		

?>