<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $stock   	 			= $_GET['stock']; 
	
	$montant 				= 0;
	
	$req="select * from erp_bc_intervalles where compteur_deb<=".$stock." and compteur_fin>=".$stock;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$montant				=	$enreg['prix'];
	}

	$json = '{"montant":"'.$montant.'"}';
	json_encode($json);
	echo $json;	
?>

