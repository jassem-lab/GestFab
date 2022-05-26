<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $produit   = $_GET['ID'];
	$idbc	   = $_GET['idbc'];

	$prix	   = 0;
	$quantite  = 0;
	$prix_tot  = 0;
	$date_liv  = 0;
	
	$req="select * from erp_fab_produits where id=".$produit;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$prix	   = $enreg['prix'];
	}

	$req="select * from erp_bc_det_bc where produit=".$produit." and idbc=".$idbc;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$prix	  	   = $enreg['prix_unitaire'];
		$quantite	   = $enreg['quantite'];
		$prix_tot  	   = $enreg['prix_total'];
		$date_liv  	   = $enreg['date_livraison'];
	}	
		
	$json = '{"prix_unitaire":"'.$prix.'","quantite":"'.$quantite.'","prix_tot":"'.$prix_tot.'","date_livraison":"'.$date_liv.'"}';
	json_encode($json);
	echo $json;	
	
?>