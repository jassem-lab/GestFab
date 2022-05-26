<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $code   				= $_POST['code']; 
	$des					= $_POST['des']; 
	
	$verif=0;
	$reqverfication="select * from erp_fab_moules where moule='".$code."'";
	$queryverfication=mysql_query($reqverfication);
	$verif=mysql_num_rows($queryverfication);
	
	if($verif==0){
		$sql="INSERT INTO `erp_fab_moules`(`moule`, `designation`) VALUES";
		$sql=$sql." ('".$code."','".$des."')";
		$requete = mysql_query($sql) or die( mysql_error()) ;	
	}
	
	$json = '{"verif":"'.$verif.'"}';
	json_encode($json);
	echo $json;		

?>