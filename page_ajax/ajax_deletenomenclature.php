<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   				= $_POST['id']; 
	
	$sql="DELETE FROM erp_fab_nomenclature WHERE id=".$id;
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"id":"'.$id.'"}';
	json_encode($json);
	echo $json;		

?>