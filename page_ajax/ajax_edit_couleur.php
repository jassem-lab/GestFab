<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $couleur   				= $_POST['couleur']; 
	$des					= $_POST['des']; 
	$id						= $_POST['id']; 
	
	
	$sql="UPDATE erp_fab_couleurs set couleur='".$couleur."', designation='".$des."' where id=".$id;
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"couleur":"'.$couleur.'"}';
	json_encode($json);
	echo $json;		

?>