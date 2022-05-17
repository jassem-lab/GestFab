<?php
session_start();
include('../connexion/cn.php');
	
	$idd  = $_GET["IDD"] ;	 //id détail
	$id   = $_GET["ID"] ;   // id entet
		
	$sql = "delete from `erp_bc_det_paiementsf` WHERE id=".$idd;
	$requete = mysql_query($sql) ;
	
	//Mise à jour montant total de BC
	$total="0";
	$reqTot="select sum(montant) as total from erp_bc_det_paiementsf where idpaiement=".$id;
	$queryTot=mysql_query($reqTot);
	while($enregTot=mysql_fetch_array($queryTot)){
		$total	=	$enregTot['total'];
	}
	
	$sql="UPDATE erp_bc_paiementsf set montant='".$total."' where id=".$id;
	$req=mysql_query($sql);		

	
	$req="select * from erp_bc_det_paiementsf where idpaiement=".$id;
	$query=mysql_query($req);
	if(mysql_num_rows($query)<1){
		$sql="delete from erp_bc_paiementsf where id=".$id;
		$requete = mysql_query($sql) ;
		
		$sql_compteur="delete from erp_bc_compteur_paiementsf where iddoc=".$id;
		$requete = mysql_query($sql_compteur) ;
		
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_paie.php" </SCRIPT>';
	} else{
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../addedit_paie.php?ID='.$id.'" </SCRIPT>';
	}
	
  
?>