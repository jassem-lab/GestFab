<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idservice 				= $_GET['idservice']; 
	$idproduit			   	= $_GET['idproduit']; 
	$idof					= $_GET['idof']; 
	$iddet					= $_GET['iddet'];
	$tableau	   			= $_GET['tableau'];
	$tableau_qte 			= $_GET['tableau_qte'];
	
	
	$nb_occ					= mb_substr_count($tableau,',');
	$tableau_semifini		= array();
	$tableau_qtesemifini	= array();
	//intilisation de tableau vide
	for($l=0; $l<$nb_occ+1; $l++){
		$tableau_semifini[$l]		="";
		$tableau_qtesemifini[$l]	="";
	}		
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau); $k++){
			if($tableau[$k]<>","){
				$tableau_semifini[$l]=$tableau_semifini[$l].$tableau[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_qte); $k++){
			if($tableau_qte[$k]<>","){
				$tableau_qtesemifini[$l]=$tableau_qtesemifini[$l].$tableau_qte[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	
	
	
	
	$reference_of	=	"";
	$date = date("Y");
	$max="01";
	$reqm="SELECT * from  erp_fab_compteur_preparation  where date='".$date ."'" ;
	$querym=mysql_query($reqm);
	$numc=mysql_num_rows($querym);
		if($numc>0){
			$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_preparation  where date='".$date ."'";
			$querymax=mysql_query($reqmax);
			while($enregmax=mysql_fetch_array($querymax)){
				$max	=	$enregmax["MaxID"];
				if(strlen($max)==1){
						$max = '00'.$max;
				}
				if(strlen($max)==2){
						$max = '0'.$max;
				}				
			}
		} else{
			$max = '001';			
		}
		
		$reference_of= "Prep_".$date."_".$max;		
		//Insertion entête
		$idpreparation="0";
		$reqMax="select max(id) as idbc from erp_fab_preparation";
		$queryMax=mysql_query($reqMax);
		if(mysql_num_rows($queryMax)>0){
			while($enregMax=mysql_fetch_array($queryMax)){
				$idpreparation	=	$enregMax['idbc'] + 1;
			}
		} else{
				$idpreparation	=	"1";
		}
		$sql="INSERT INTO erp_fab_preparation(`id`, `reference`, `idof`, `idproduit`, `idservice`, `iddet`) VALUES 
		('".$idpreparation."','".$reference_of."','".$idof."','".$idproduit."','".$idservice."','".$iddet."' )";
		$req=mysql_query($sql);	
		
		$sql="INSERT INTO `erp_fab_compteur_preparation`(`date`, `compteur`, `iddoc`) VALUES ('".$date."' ,'".$max."','".$idpreparation."')";
		$req=mysql_query($sql);	


	//Insertion préparation produit/semi/service
	for($i=0;$i<$nb_occ+1;$i++){
		if($tableau_qtesemifini[$i]<>0){	
			$sql="INSERT INTO `erp_fab_detpreparation_sf`(`idpreparation`,`iddet`, `produit`, `quantite`, `idsemi`, `idservice`) VALUES ";
			$sql=$sql." ('".$idpreparation."','".$iddet."','".$idproduit."','".$tableau_qtesemifini[$i]."','".$tableau_semifini[$i]."','".$idservice."')";
			$query=mysql_query($sql);
			
			//Mise à jour stock
			$stock="0";
			$req="select * from erp_fab_produits where id=".$tableau_semifini[$i];
			$query=mysql_query($req);
			while($enreg=mysql_fetch_array($query)){
				$stock	=	$enreg['stock'] - $tableau_qtesemifini[$i];
			}
			
			$sql="update erp_fab_produits set stock='".$stock."' where id=".$tableau_semifini[$i];
			$query=mysql_query($sql);			
			
		}
	}
	
	$json = '{"idof":"'.$idof.'"}';
	json_encode($json);
	echo $json;		

?>