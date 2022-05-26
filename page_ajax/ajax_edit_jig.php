<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $jig   					= $_POST['jig']; 
	$des					= $_POST['des']; 
	$id						= $_POST['id']; 
	
	
	$sql="UPDATE erp_fab_jig set jig='".$jig."', designation='".$des."' where id=".$id;
	
	$requete = mysql_query($sql) or die( mysql_error()) ;	
	
	$json = '{"jig":"'.$jig.'"}';
	json_encode($json);
	echo $json;		

?>