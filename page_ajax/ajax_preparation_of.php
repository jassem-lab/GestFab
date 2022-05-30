<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idservice 				= $_GET['idservice']; 
	$idproduit			   	= $_GET['idproduit']; 
	$idof					= $_GET['idof']; 
	$iddet					= $_GET['iddet'];
	$tableau	   			= $_GET['tableau'];
	$tableau_qte 			= $_GET['tableau_qte'];
	$tableau_sfm			= $_GET['tableau_sfm'];
	$tableau_qfm  			= $_GET['tableau_qfm'];
	$tableau_qfz   			= $_GET['tableau_qfz'];
	$tableau_sfz  			= $_GET['tableau_sfz'];
	$tableau_sfa  			= $_GET['tableau_sfa'];
	$tableau_qfa	  		= $_GET['tableau_qfa'];
	
	$tableau_idmpfm	  		= $_GET['tableau_idmpfm'];
	$tableau_idmpfa	  		= $_GET['tableau_idmpfa'];
	$tableau_idmpfz	  		= $_GET['tableau_idmpfz'];
	
	
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
	
	
	$nb_occ1				= mb_substr_count($tableau_sfm,',');	
	$tableau_fm				= array();
	$tableau_qtefm			= array();
	$tableau_idfm			= array();
	//intilisation de tableau vide
	for($l=0; $l<$nb_occ1+1; $l++){
		$tableau_fm[$l]		="";
		$tableau_qtefm[$l]	="";
		$tableau_idfm[$l]	="";
	}		

	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_idmpfm); $k++){
			if($tableau_idmpfm[$k]<>","){
				$tableau_idfm[$l]=$tableau_idfm[$l].$tableau_idmpfm[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_sfm); $k++){
			if($tableau_sfm[$k]<>","){
				$tableau_fm[$l]=$tableau_fm[$l].$tableau_sfm[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_qfm); $k++){
			if($tableau_qfm[$k]<>","){
				$tableau_qtefm[$l]=$tableau_qtefm[$l].$tableau_qfm[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}		
	
	$nb_occ2				= mb_substr_count($tableau_sfz,',');	
	$tableau_fz				= array();
	$tableau_qtefz			= array();
	$tableau_idfz			= array();
	//intilisation de tableau vide
	for($l=0; $l<$nb_occ2+1; $l++){
		$tableau_fz[$l]		="";
		$tableau_qtefz[$l]	="";
		$tableau_idfz[$l]	="";
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
	
	
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_idmpfz); $k++){
			if($tableau_idmpfz[$k]<>","){
				$tableau_idfz[$l]=$tableau_idfz[$l].$tableau_idmpfz[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_sfz); $k++){
			if($tableau_sfz[$k]<>","){
				$tableau_fz[$l]=$tableau_fz[$l].$tableau_sfz[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_qfz); $k++){
			if($tableau_qfz[$k]<>","){
				$tableau_qtefz[$l]=$tableau_qtefz[$l].$tableau_qfz[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}		
	

	$nb_occ3				= mb_substr_count($tableau_sfa,',');	
	$tableau_fa				= array();
	$tableau_qtefa			= array();
	$tableau_idfa			= array();
	//intilisation de tableau vide
	for($l=0; $l<$nb_occ3+1; $l++){
		$tableau_fa[$l]		="";
		$tableau_qtefa[$l]	="";
		$tableau_idfa[$l]	="";
	}	
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_idmpfa); $k++){
			if($tableau_idmpfa[$k]<>","){
				$tableau_idfa[$l]=$tableau_idfa[$l].$tableau_idmpfa[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_sfa); $k++){
			if($tableau_sfa[$k]<>","){
				$tableau_fa[$l]=$tableau_fa[$l].$tableau_sfa[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}		
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_qfa); $k++){
			if($tableau_qfa[$k]<>","){
				$tableau_qtefa[$l]=$tableau_qtefa[$l].$tableau_qfa[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}		
	
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
				$stock	=	$enreg['stock_reservee'] + $tableau_qtesemifini[$i];
			}
			
			$sql="update erp_fab_produits set stock_reservee='".$stock."' where id=".$tableau_semifini[$i];
			$query=mysql_query($sql);			
			
		}
	}
	
	//Insertion préparation mp/produit/semi/service
	for($i=0;$i<$nb_occ1+1;$i++){
		if($tableau_qtefm[$i]<>0){	
			$sql="INSERT INTO `erp_fab_detprepartation_mp`(`idpreparation`,`iddet`, `produit`, `idsemi`, `quantite`, `idmp`, `idservice`) VALUES  ";
			$sql=$sql." ('".$idpreparation."','".$iddet."','".$idproduit."','".$tableau_fm[$i]."','".$tableau_qtefm[$i]."','".$tableau_idfm[$i]."','".$idservice."')";
			$query=mysql_query($sql);
			
			//Mise à jour stock
			$stock="0";
			$req="select * from erp_fab_mp where id=".$tableau_idfm[$i];
			$query=mysql_query($req);
			while($enreg=mysql_fetch_array($query)){
				$stock	=	$enreg['stock'] - $tableau_qtefm[$i];
			}
			
			$sql="update erp_fab_mp set stock='".$stock."' where id=".$tableau_idfm[$i];
			$query=mysql_query($sql);
			
		}
	}	

	//Insertion préparation mp/produit/semi/service
	for($i=0;$i<$nb_occ2+1;$i++){
		if($tableau_qtefz[$i]<>0){	
			$sql="INSERT INTO `erp_fab_detprepartation_mp`(`idpreparation`,`iddet`, `produit`, `idsemi`, `quantite`, `idmp`, `idservice`) VALUES  ";
			$sql=$sql." ('".$idpreparation."','".$iddet."','".$idproduit."','".$tableau_fz[$i]."','".$tableau_qtefz[$i]."','".$tableau_idfz[$i]."','".$idservice."')";
			$query=mysql_query($sql);

			//Mise à jour stock
			$stock="0";
			$req="select * from erp_fab_mp where id=".$tableau_idfz[$i];
			$query=mysql_query($req);
			while($enreg=mysql_fetch_array($query)){
				$stock	=	$enreg['stock'] - $tableau_qtefz[$i];
			}
			
			$sql="update erp_fab_mp set stock='".$stock."' where id=".$tableau_idfz[$i];
			$query=mysql_query($sql);			
		}
	}	
	
	//Insertion préparation mp/produit/semi/service
	for($i=0;$i<$nb_occ3+1;$i++){
		if($tableau_qtefa[$i]<>0){	
			$sql="INSERT INTO `erp_fab_detprepartation_mp`(`idpreparation`,`iddet`, `produit`, `idsemi`, `quantite`, `idmp`, `idservice`) VALUES  ";
			$sql=$sql." ('".$idpreparation."','".$iddet."','".$idproduit."','".$tableau_fa[$i]."','".$tableau_qtefa[$i]."','".$tableau_idfa[$i]."','".$idservice."')";
			$query=mysql_query($sql);
			
			//Mise à jour stock
			$stock="0";
			$req="select * from erp_fab_mp where id=".$tableau_idfa[$i];
			$query=mysql_query($req);
			while($enreg=mysql_fetch_array($query)){
				$stock	=	$enreg['stock'] - $tableau_qtefa[$i];
			}
			
			$sql="update erp_fab_mp set stock='".$stock."' where id=".$tableau_idfa[$i];
			$query=mysql_query($sql);			
			
		}
	}		

	$json = '{"idof":"'.$idof.'"}';
	json_encode($json);
	echo $json;		

?>