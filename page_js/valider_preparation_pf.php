<?php
session_start();
include('../connexion/cn.php');
	
	$id   		 = $_GET["ID"] ;
	$idproduit   = $_GET["idproduit"] ;
	$idservice   = $_GET["idservice"] ;
	$iddet   	 = $_GET["iddet"] ;
	
	$sql="UPDATE erp_fab_preparation SET etat=1 where idof=".$id." and idproduit=".$idproduit." and idservice=".$idservice." and iddet=".$iddet;
	$query=mysql_query($sql);
	
	$qte=0;
	$req="select * from erp_fab_detof where idproduit=".$idproduit." and idof=".$id." and id=".$iddet;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$qte	=	$enreg['quantite'];
		
		$sql="UPDATE erp_fab_detof SET etat=1 where  idproduit=".$idproduit." and idof=".$id." and id=".$iddet;
		$query=mysql_query($sql);		
	}
	
	
	//Mise à jour stock
	$stock="0";
	$req="select * from erp_fab_produits where id=".$idproduit;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$stock	=	$enreg['stock'] +$qte[$i];
	}
	
	$sql="update erp_fab_produits set stock='".$stock."' where id=".$idproduit;
	$query=mysql_query($sql);		

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../detail_of_pf.php?ID='.$id.'" </SCRIPT>';
	
  
?>