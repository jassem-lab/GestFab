<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   	 				= $_GET['id']; 
	$couleur 				= $_GET['couleur']; 
	
	$px	 					= 0;
	$famille				= 0;
	
	$req="select * from erp_bc_couleur where id=".$couleur;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$famille			= $enreg['famille'];
	}
	
	$req="select * from erp_bc_det_prix where produit=".$id." and famillecouleur=".$famille." and prix<>'' ORDER BY idprix DESC limit 1";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$px		=	$enreg['prix'];
	}

	$json = '{"px":"'.$px.'"}';
	json_encode($json);
	echo $json;	
?>

