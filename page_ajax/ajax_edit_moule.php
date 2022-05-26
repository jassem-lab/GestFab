<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $moule   				= $_POST['moule']; 
	$des					= $_POST['des']; 
	$id						= $_POST['id']; 
	
	
	$sql="UPDATE erp_fab_moules set moule='".$moule."', designation='".$des."' where id=".$id;
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"moule":"'.$moule.'"}';
	json_encode($json);
	echo $json;		

?>