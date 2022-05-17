<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $produit   				= $_GET['produit']; 
	$tableau_phase			= $_GET['tableau_phase']; 
	$tableau_qte			= $_GET['tableau_qte']; 
	$total_cmd				= $_GET['total_cmd']; 
	$nb_occ					= mb_substr_count($tableau_phase,',');
	$tableau_p				= array();	
	$nb_occ1				= mb_substr_count($tableau_qte,',');
	$tableau_q				= array();

	//intilisation de tableau vide
	for($l=0; $l<$nb_occ+1; $l++){
		$tableau_p[$l]	="";
	}	
	
	for($l=0; $l<$nb_occ1+1; $l++){
		$tableau_q[$l]	="";
	}
	
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_phase); $k++){
			if($tableau_phase[$k]<>","){
				$tableau_p[$l]=$tableau_p[$l].$tableau_phase[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}
	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_qte); $k++){
			if($tableau_qte[$k]<>","){
				$tableau_q[$l]=$tableau_q[$l].$tableau_qte[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	
	$verification = 0;
	$phase="";
	for($i=0;$i<$nb_occ+1;$i++){	
		if($tableau_p[$i]<>0 and $verification==0 and $tableau_q[$i]<>''){	
			//Vérification quantité saisie dans une phase
				//Retrouver la dérnier quantité saisie par phase
				$qte_phase = 0;
				$req1="select * from erp_bc_suivi where idproduit=".$produit." and idphase=".$tableau_p[$i];
				$query1=mysql_query($req1);
				while($enreg1=mysql_fetch_array($query1)){
					$qte_phase = $qte_phase + $enreg1['quantite'];
				}
				//Retrouver la somme de quantité saisie par les phases supérieur
				$sumqte_phase = 0;
				 $req1="select DISTINCT * from erp_bc_suivi where idproduit=".$produit." and idphase>".$tableau_p[$i]." and quantite>0 ORDER BY id DESC ";
				$query1=mysql_query($req1);
				while($enreg1=mysql_fetch_array($query1)){
					$sumqte_phase = $sumqte_phase + $enreg1['quantite'];
				}
				if(($total_cmd-($qte_phase+$sumqte_phase+$tableau_q[$i]))<0){
					$reqphase="select * from erp_bc_phases where id=".$tableau_p[$i];
					$queryphase=mysql_query($reqphase);
					while($enregphase=mysql_fetch_array($queryphase)){
						$phase	=	$enregphase['phase'];
					}
					$verification = 1;
				}	
		}
	}
	
	
	
	if($verification==0){
		//Insertion tableau:
		$idtableau=0;
		$reqMax="select max(id) as maxTableau from erp_bc_tableau";
		$queryMax=mysql_query($reqMax);
		if(mysql_num_rows($queryMax)>0){
			while($enregMax=mysql_fetch_array($queryMax)){
				$idtableau	=	$enregMax['maxTableau'] + 1;
			}
		} else{
				$idtableau	=	 1;
		}
		$dateheure=date("Y-m-d H:i:s");
		$sql="INSERT INTO `erp_bc_tableau`(`id`, `idutilisateur`, `dateheure`, `idproduit`) VALUES ('".$idtableau."','".$_SESSION['erp_bc_IDUSER']."','".$dateheure."','".$produit."')";
		$requete=mysql_query($sql);		
		
		for($i=0;$i<$nb_occ+1;$i++){
			if($tableau_p[$i]<>0){	
					//Insertion dans la base table suivi
					$typephase = "0";
					$reqph="select * from erp_bc_phases where  id=".$tableau_p[$i];
					$queryph=mysql_query($reqph);
					while($enregph=mysql_fetch_array($queryph)){
						$typephase = $enregph['type'];
					}
					
					$sql="INSERT INTO `erp_bc_suivi`(`idtableau`,`idproduit`, `idphase`, `typephase`, `quantite`) VALUES ('".$idtableau."','".$produit."','".$tableau_p[$i]."','".$typephase."','".$tableau_q[$i]."')";
					$requete=mysql_query($sql);				
			}
		}		
	}
	

	
	
	$json = '{"idproduit":"'.$produit.'","verification":"'.$verification.'","phase":"'.$phase.'"}';
	json_encode($json);
	echo $json;		

?>