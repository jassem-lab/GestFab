<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   	 				= $_GET['ID']; 
	
	$poids	 				= 0;
	$volume	 				= 0;
	$prix_unitaire	 		= 0;
	
	
	$req="select * from erp_bc_bc_produits where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$prix_unitaire		=	$enreg['prix'];
		$poids 				=	$enreg['poids'];
		$volume				=	$enreg['volume'];
	}

	$json = '{"prix_unitaire":"'.$prix_unitaire.'","poids":"'.$poids.'","volume":"'.$volume.'"}';
	json_encode($json);
	echo $json;	
?>

