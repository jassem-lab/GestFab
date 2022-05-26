<?php
session_start();
include('../connexion/cn.php');
	
	$id   = $_GET["ID"] ;
		
	
	$ancien_qte	=	0; 
	$type		=	0;
	$produit	=	0;
	$mp			=	0;
	$req="select * from erp_bc_det_bs where idbs=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$ancien_qte	=	$enreg['quantite'];
		$type		=	$enreg['type'];
		$produit	=	$enreg['produit'];
		$mp			=	$enreg['mp'];
		
		if($type==1){
			//Mise à jour stock
			$reqstock="select * from erp_fab_produits where id=".$produit;
			$querystock=mysql_query($reqstock);
			while($enregstock=mysql_fetch_array($querystock)){
				$stock = ($enregstock['stock']+$ancien_qte) ;
			}	
			$sql="update erp_fab_produits set stock='".$stock."' where  id=".$produit;
			$req=mysql_query($sql);						
		} else{
			//Mise à jour stock
			$reqstock="select * from erp_fab_mp where id=".$mp;
			$querystock=mysql_query($reqstock);
			while($enregstock=mysql_fetch_array($querystock)){
				$stock = ($enregstock['stock']+$ancien_qte) ;
			}	
			$sql="update erp_fab_mp set stock='".$stock."' where  id=".$mp;
			$req=mysql_query($sql);						
		}			
	}				
		
	$sql = "delete from `erp_bc_det_bs` WHERE idbs=".$id;
	$requete = mysql_query($sql) ;
	
	$sql = "delete from `erp_fab_bs` WHERE id=".$id;
	$requete = mysql_query($sql) ;

	$sql = "delete from `erp_fab_compteur_bs` WHERE iddoc=".$id;
	$requete = mysql_query($sql) ;

	
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_bs.php" </SCRIPT>';
	
  
?>