<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   	 				= $_GET['ID']; 
	$idbc_original			= $_GET['idbc_original']; 
	$idbc   	 			= $_GET['idbc'];
	
	$poids	 				= 0;
	$volume	 				= 0;
	$prix_unitaire	 		= 0;
	$quantite		 		= 1;
	
	$req="select * from erp_bc_det_bc where idbc=".$idbc_original." and produit=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$prix_unitaire		=	$enreg['prix_unitaire'];
		$poids 				=	$enreg['poids'];
		$volume				=	$enreg['volume'];
	}
	
	$req="select * from erp_bc_det_bc where idbc=".$idbc." and produit=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$prix_unitaire		=	$enreg['prix_unitaire'];
		$poids 				=	$enreg['poids'];
		$volume				=	$enreg['volume'];
		$quantite			=	$enreg['quantite'];
	}

	$json = '{"prix_unitaire":"'.$prix_unitaire.'","poids":"'.$poids.'","volume":"'.$volume.'","quantite":"'.$quantite.'"}';
	json_encode($json);
	echo $json;	
?>

