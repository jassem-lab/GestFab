<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $code   				= $_POST['code']; 
	$des					= $_POST['des']; 
	
	$verif=0;
	$sql="INSERT INTO `erp_fab_couleurs`(`couleur`, `designation`) VALUES";
	$sql=$sql." ('".$code."','".$des."')";
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"verif":"'.$verif.'"}';
	json_encode($json);
	echo $json;		

?>