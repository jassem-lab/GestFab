<?php
session_start();
include('../connexion/cn.php');
	
	$idd  = $_GET["IDD"] ;	
	$id   = $_GET["ID"] ;
	
	
	$ancien_qte	=	0; 
	$type		=	0;
	$produit	=	0;
	$mp			=	0;
	$req="select * from erp_bc_det_bs where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$ancien_qte	=	$enreg['quantite'];
		$type		=	$enreg['type'];
		$produit	=	$enreg['produit'];
		$mp			=	$enreg['mp'];
	}		

	$sql = "delete from `erp_bc_det_bs` WHERE id=".$idd;
	$requete = mysql_query($sql) ;
	
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
	
	
	//Mise à jour montant total de BE
	$total="0";
	$reqTot="select sum(prix_total) as total from erp_bc_det_bs where idbs=".$id;
	$queryTot=mysql_query($reqTot);
	while($enregTot=mysql_fetch_array($queryTot)){
		$total	=	$enregTot['total'];
	}
	
	$sql="UPDATE erp_fab_bs set montant='".$total."' where id=".$id;
	$req=mysql_query($sql);		

	
	$req="select * from erp_bc_det_bs where idbs=".$id;
	$query=mysql_query($req);
	if(mysql_num_rows($query)<1){
		$sql="delete from erp_fab_bs where id=".$id;
		$requete = mysql_query($sql) ;
		
		$sql_compteur="delete from erp_fab_compteur_bs where iddoc=".$id;
		$requete = mysql_query($sql_compteur) ;
		
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../gest_bs.php" </SCRIPT>';
	} else{
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../addedit_bs.php?ID='.$id.'" </SCRIPT>';
	}
	
  
?>