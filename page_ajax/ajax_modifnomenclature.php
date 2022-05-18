<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   				= $_POST['id']; 
	$qte   				= $_POST['qte']; 
	
	$sql="UPDATE erp_nomenclature SET quantite=".$qte." WHERE id=".$id;
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"id":"'.$id.'"}';
	json_encode($json);
	echo $json;		

?>