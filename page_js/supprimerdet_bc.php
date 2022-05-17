<?php
session_start();
include('../connexion/cn.php');
	
	$idd  = $_GET["IDD"] ;	
	$id   = $_GET["ID"] ;
		
	$sql = "delete from `erp_bc_det_bc` WHERE id=".$idd;
	$requete = mysql_query($sql) ;
	
	//Mise à jour montant total de BC
	$total="0";
	$reqTot="select sum(prix_total) as total from erp_bc_det_bc where idbc=".$id;
	$queryTot=mysql_query($reqTot);
	while($enregTot=mysql_fetch_array($queryTot)){
		$total	=	$enregTot['total'];
	}
	
	$sql="UPDATE erp_bc_bc set montant='".$total."' where id=".$id;
	$req=mysql_query($sql);		

	
	$req="select * from erp_bc_det_bc where idbc=".$id;
	$query=mysql_query($req);
	if(mysql_num_rows($query)<1){
		$sql="delete from erp_bc_bc where id=".$id;
		$requete = mysql_query($sql) ;
		
		$sql_compteur="delete from erp_bc_compteur_bc where iddoc=".$id;
		$requete = mysql_query($sql_compteur) ;
		
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_bc.php" </SCRIPT>';
	} else{
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../addedit_bc.php?ID='.$id.'" </SCRIPT>';
	}
	
  
?>