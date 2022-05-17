<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    
	$date_jour = date('Y-m-d');
	$req="update erp_bc_bl set etat=1 where etat=0 and sunday<='".$date_jour."'";
	$query=mysql_query($req);
	
	
	$req="update erp_bc_factsf set etat=1 where etat=0 and sunday<='".$date_jour."'";
	$query=mysql_query($req);	
	
	
	$etat=0;
	
	$json = '{"etat":"'.$etat.'"}';
	json_encode($json);
	echo $json;		

?>