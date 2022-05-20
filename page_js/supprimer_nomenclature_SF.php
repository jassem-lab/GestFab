<?php
session_start();
include('../connexion/cn.php');
	
	$id  = $_GET["ID"] ;	
	$idd = $_GET["IDD"] ; 
	 $sql = "delete from `erp_bc_nomenclatures_fini` WHERE id=".$idd;
	$requete = mysql_query($sql) ;

		//Calcul coût PF
		$cout = 0 ;
		$req2=" select * from erp_bc_nomenclatures_fini where code_produit=".$id;
		$query2=mysql_query($req2);
		while($enreg=mysql_fetch_array($query2)){

			if($enreg['mp_fini']<>0){

				 $reqPrix = "select * from erp_bc_mp where id=".$enreg['mp_fini'] ; 
				$queryPrix=mysql_query($reqPrix) ;
				while($enregPrix = mysql_fetch_array($queryPrix)){
					$cout =  $cout + ($enregPrix["prix"]*$enreg['quantite']) ; 
				}
			}

			if($enreg['produit_sf']<>0){

				$reqPrix = "select * from erp_bc_produitsf where id=".$enreg['produit_sf'] ; 
				$queryPrix=mysql_query($reqPrix) ;
				while($enregPrix = mysql_fetch_array($queryPrix)){
					$cout =  $cout + ($enregPrix["prix"]*$enreg['quantite_sf']) ; 
				}
			}
		}



		$sql2="update erp_bc_produits set prix_unitaire=".$cout." where id=".$id;
		$requete2=mysql_query($sql2);

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../nomenclatures_produit.php?ID='.$id.'&suc=1" </SCRIPT>'; 
?>