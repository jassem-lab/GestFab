<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;
	
	$idbc=0;
	$req="select * from erp_fab_of where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$idbc	=	$enreg['idbc'];
	}
		
	$req="select * from erp_fab_of where idbc=".$idbc;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		
		$sql = "delete from `erp_fab_detof` WHERE idof=".$enreg['id'];
		$requete = mysql_query($sql) ;

		$sql = "delete from `erp_fab_detof_mp` WHERE idof=".$enreg['id'];
		$requete = mysql_query($sql) ;

		$sql = "delete from `erp_fab_detof_mp_emballage` WHERE idof=".$enreg['id'];
		$requete = mysql_query($sql) ;

		$sql = "delete from `erp_fab_detof_mp_emballage_pf` WHERE idof=".$enreg['id'];
		$requete = mysql_query($sql) ;		
		
		$sql = "delete from `erp_fab_detof_sf` WHERE idof=".$enreg['id'];
		$requete = mysql_query($sql) ;	

		$sql = "delete from `erp_fab_of` WHERE id=".$enreg['id'];
		$requete = mysql_query($sql) ;			
	}		
		
	
	$sql = "update`erp_fab_bc` set etat=0 WHERE id=".$idbc;
	$requete = mysql_query($sql) ;

	$sql = "delete from `erp_fab_compteur_of` WHERE iddoc=".$id;
	$requete = mysql_query($sql) ;

	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_bc.php" </SCRIPT>';
	
  
?>