<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;
		
	
	$quantite	=	0; 
	$type		=	0;
	$produit	=	0;
	$mp			=	0;
	$req="select * from erp_bc_det_inventaire where idinventaire=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$quantite	=	$enreg['quantite'];
		$type		=	$enreg['type'];
		$produit	=	$enreg['produit'];
		$mp			=	$enreg['mp'];
		
		if($type==1){
			//Mise à jour stock
			$sql="update erp_fab_produits set stock='".$quantite."' where  id=".$produit;
			$req=mysql_query($sql);						
		} else{
			//Mise à jour stock
			$sql="update erp_fab_mp set stock='".$quantite."' where  id=".$mp;
			$req=mysql_query($sql);						
		}			
	}				
		

	
	$sql = "update `erp_fab_inventaire` set etat=1 WHERE id=".$id;
	$requete = mysql_query($sql) ;

	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_inv.php" </SCRIPT>';
	
  
?>