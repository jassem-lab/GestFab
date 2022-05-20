<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   	 				= $_GET['ID']; 
	
	$poids	 				= 0;
	$volume	 				= 0;
	$prix	 		= 0;
	
	
	$req="select * from erp_bc_mp where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$prix		=	$enreg['prix'];
	}

	$json = '{"prix":"'.$prix.'"}';
	json_encode($json);
	echo $json;	
?>