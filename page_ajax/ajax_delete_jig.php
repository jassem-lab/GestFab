<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $cliche   				= $_POST['jig']; 
	$des					= $_POST['des']; 
	$id						= $_POST['id']; 
	
	
	$sql="DELETE FROM `erp_fab_jig` WHERE id=".$id;
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"cliche":"'.$cliche.'"}';
	json_encode($json);
	echo $json;		

?>