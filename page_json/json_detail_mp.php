<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $produit   = $_GET['ID'];

	$prix	   = 0;
	$req="select * from erp_fab_mp where id=".$produit;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$prix	   = $enreg['px_achat'];
	}
	
		
	$json = '{"prix_unitaire":"'.$prix.'"}';
	json_encode($json);
	echo $json;	
	
?>