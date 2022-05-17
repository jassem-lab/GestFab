<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $famille   				= $_GET['famille']; 
	$tableau_phase			= $_GET['tableau_phase']; 
	$tableau_qte			= $_GET['tableau_qte']; 
	$tableau_prd			= $_GET['tableau_prd']; 
	$total_cmd				= $_GET['total_cmd']; 
	$nb_occ					= mb_substr_count($tableau_phase,',');
	$tableau_p				= array();	
	$nb_occ1				= mb_substr_count($tableau_qte,',');
	$tableau_q				= array();
	$nb_occ2				= mb_substr_count($tableau_prd,',');
	$tableau_pr				= array();
	
	//Vérification de date BL et dimanche
    $today = date("Y-m-d") ;  //Date de jour
    $this_year = date("Y") ;  // Année de jour
    $month = date("m",strtotime($today));	// Mois de jour
    $week_number  = date("W", strtotime('now')); //Numéro de semaine
    $year_number  = date("o", strtotime('now')); 	
    if($week_number<=9)
    {
      $week_number= "0".$week_number; 
    }
    $last_monday = date('Y-m-d', strtotime("$this_year-W$week_number")); 	
	$next_sunday= date('Y-m-d',strtotime("$last_monday +6 days")); //prochaine dimanche
	$monthOfNextSunday = date("m",strtotime($next_sunday)); //Mois de dimanche prochaine
	$lastDayThisMonth = date("Y-m-t"); //Dérnier jour de mois
	
	if($monthOfNextSunday<>$month){
		$next_sunday=$lastDayThisMonth;
	}
	
	
	//intilisation de tableau vide
	for($l=0; $l<$nb_occ+1; $l++){
		$tableau_p[$l]	="";
	}	
	
	for($l=0; $l<$nb_occ1+1; $l++){
		$tableau_q[$l]	="";
	}

	for($l=0; $l<$nb_occ2+1; $l++){
		$tableau_pr[$l]	="";
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

	$l=0;$j=0;
	for($k=0; $k<strlen($tableau_prd); $k++){
			if($tableau_prd[$k]<>","){
				$tableau_pr[$l]=$tableau_pr[$l].$tableau_prd[$k];	
				$j=$j+1;
			}else{
				$l=$l+1;
			}
	}	
	$idtableau=0;
	$reqMax="select max(id) as maxTableau from erp_bc_tableau";
	$queryMax=mysql_query($reqMax);
	if(mysql_num_rows($queryMax)>0){
		while($enregMax=mysql_fetch_array($queryMax)){
			$idtableau	=	$enregMax['maxTableau'];
		}
	} 



	$verification = 0;
	$phase="";
	for($i=0;$i<$nb_occ+1;$i++){	
		if($tableau_p[$i]<>0 and $verification==0 and $tableau_q[$i]<>''){	
		
			$typephase = "0";
			$phase="";
			$reqph="select * from erp_bc_phases where  id=".$tableau_p[$i];
			$queryph=mysql_query($reqph);
			while($enregph=mysql_fetch_array($queryph)){
				$typephase  = 	$enregph['type'];
				$phase		=	$enregph['phase'];
			}			
			
			
			$total_cmd=0;
			$reqcmd="select sum(quantite) as sumQte from erp_bc_det_bc where produit=".$tableau_pr[$i];
			$querycmd=mysql_query($reqcmd);
			while($enregcmd=mysql_fetch_array($querycmd)){
				$total_cmd	=	$enregcmd['sumQte'];
			}	
			if($idtableau>0){	
			//Vérification quantité saisie dans une phase
				//Retrouver la somme de quantité saisie par les phases supérieur
				$sumqte_phase = 0;
				 $req1="select * from erp_bc_suivi where idproduit=".$tableau_pr[$i]." and idphase>".$tableau_p[$i]." and idtableau=".$idtableau;
				$query1=mysql_query($req1);
				while($enreg1=mysql_fetch_array($query1)){
					$sumqte_phase = $sumqte_phase + $enreg1['quantite'];
				}
				if (($total_cmd-$sumqte_phase)<$tableau_q[$i]){
					$verification = 1;
				}			
			}

		}
	}
	//Livraison des produits
		//Nomber de semaine
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$week = $date->format("W");
		//Vérification de l'existance d'une BL
		$idbl=0;
		$req="select * from erp_bc_bl where sunday='".$next_sunday."'";
		$query=mysql_query($req);
		$numbl=mysql_num_rows($query);	
		if($numbl>0){
			while($enreg=mysql_fetch_array($query)){
				$idbl	=	$enreg['id'];
			}
		} else {
			$reqMax="select max(id) as maxBL from erp_bc_bl";
			$queryMax=mysql_query($reqMax);
			if(mysql_num_rows($queryMax)>0){
				while($enregMax=mysql_fetch_array($queryMax)){
					$idbl	=	$enregMax['maxBL'];
				}
			} 	else{
					$idbl	=	0;
			}
			//Création d'une nouvelle BL
				$reference	=	"";
				$date = date("Y");
				$max="01";
				$reqm="SELECT * from  erp_bc_compteur_bl  where date='".$date ."'" ;
				$querym=mysql_query($reqm);
				$numc=mysql_num_rows($querym);
					if($numc>0){
						$reqmax="SELECT max(compteur)+1 as MaxID from  erp_bc_compteur_bl  where date='".$date ."'";
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
					
					$reference= "BL_".$date."_".$max;	
					$mois = date("m"); $trimestre=0;
					//Vérification de trimestre`
					if($mois == 1 or $mois == 2 or $mois == 3) {
						$trimestre=1;
					}
					if($mois == 4 or $mois == 5 or $mois == 6) {
						$trimestre=2;
					}					
					if($mois == 7 or $mois == 8 or $mois == 9) {
						$trimestre=3;
					}					
					if($mois == 10 or $mois == 11 or $mois == 12) {
						$trimestre=4;
					}					
				    $date1= date("Y-m-d");$dateheure			= 	date("Y-m-d H:i:s");	
					$idutilisateur=$_SESSION['erp_bc_IDUSER'];
					$sql="INSERT INTO `erp_bc_bl`(`id`, `reference`,`client`, `trimestre`, `annee`, `semaine`, `mois`, `date`, `dateheure`, `idutilisateur`,`sunday`) VALUES ";
					$sql=$sql."('".$idbl."','".$reference."','1','".$trimestre."','".$date."','".$week."','".$mois."','".$date1."','".$dateheure."','".$idutilisateur."','".$next_sunday."') ";
					$req=mysql_query($sql);
					
					$sql="INSERT INTO `erp_bc_compteur_bl`(`date`, `compteur`, `iddoc`) VALUES ('".$date."' ,'".$max."','".$idbl."')";
					$req=mysql_query($sql);	

					
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
		$sql="INSERT INTO `erp_bc_tableau`(`id`, `idutilisateur`, `dateheure`, `idfamille`) VALUES ('".$idtableau."','".$_SESSION['erp_bc_IDUSER']."','".$dateheure."','".$famille."')";
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
					
					$sql="INSERT INTO `erp_bc_suivi`(`idtableau`,`idproduit`, `idphase`, `typephase`, `quantite`) VALUES ('".$idtableau."','".$tableau_pr[$i]."','".$tableau_p[$i]."','".$typephase."','".$tableau_q[$i]."')";
					$requete=mysql_query($sql);	
			}
		}		
	}

			$reqMax="select max(id) as maxBL from erp_bc_bl";
			$queryMax=mysql_query($reqMax);
			if(mysql_num_rows($queryMax)>0){
				while($enregMax=mysql_fetch_array($queryMax)){
					$idbl	=	$enregMax['maxBL'];
				}
			} else{
					$idbl	=	1;
			}
			
			$stock_prd="0";$stock_reservee="0";
			$reqprd="select * from erp_bc_produits where famille=".$famille;
			$queryprd=mysql_query($reqprd);
			while($enregprd=mysql_fetch_array($queryprd)){
					$stock_prd		=	$enregprd['stock_sf'];
					$stock_reservee	=	$enregprd['stock_reservee'];
					//Vérification de quantite à livré
					$quantite_livre="0"; $stock_maj_sf=0;
					$reqreste="select sum(quantite) as  quantite_livre from erp_bc_suivi where typephase=4  and idproduit=".$enregprd['id'];
					$queryreste=mysql_query($reqreste);
					while($enregreste=mysql_fetch_array($queryreste)){
						$quantite_livre	=	$enregreste['quantite_livre'];
						$stock_maj_sf	=	$enregreste['quantite_livre'];
					}
					
					$reqbl="select sum(quantite) as sumQTE from erp_bc_det_bl where produit=".$enregprd['id'];
					$querybl=mysql_query($reqbl);
					while($enregbl=mysql_fetch_array($querybl)){
						$quantite_livre	=	$quantite_livre - $enregbl['sumQTE'];
					}
					
					
					if($quantite_livre>0) {
						//Parcours des commandes
						$qte_bl=0;$qte_livre=0;$qte_bl1=0;
						
						
						$reqbc="SELECT * FROM erp_bc_bc  where exists(select * from erp_bc_det_bc where erp_bc_det_bc.idbc=erp_bc_bc.id and produit=".$enregprd['id'].")
						ORDER BY `trimestre` , `type` , `id`";
						$querybc=mysql_query($reqbc);
						while($enregbc=mysql_fetch_array($querybc)){
							
							$reqdetbc="select * from erp_bc_det_bc where produit=".$enregprd['id']." and idbc=".$enregbc['id']."  and quantite>qte_livree";
							$querydetbc=mysql_query($reqdetbc);
							while($enregdetbc=mysql_fetch_array($querydetbc)){
								$qte_bl	    =	$enregdetbc['quantite'] - $enregdetbc['qte_livree'];
								if($quantite_livre>0){
									if($quantite_livre>$qte_bl){
										//1ére livraison
										$sql="INSERT INTO `erp_bc_det_bl`(`idbl`, `iddetbc`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`) VALUES";
										$sql=$sql." ('".$idbl."','".$enregdetbc['id']."','".$enregprd['id']."','".$qte_bl."','".$enregdetbc['prix_unitaire']."','".$enregdetbc['prix_total']."','".$enregdetbc['poids']."','".$enregdetbc['volume']."')";
										$requete=mysql_query($sql);	
										
										$quantite_livre = $quantite_livre - $qte_bl;										
									} else{
										$pt=$quantite_livre * $enregdetbc['prix_unitaire'];
										
										$sql="INSERT INTO `erp_bc_det_bl`(`idbl`, `iddetbc`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`) VALUES";
										$sql=$sql." ('".$idbl."','".$enregdetbc['id']."','".$enregprd['id']."','".$quantite_livre."','".$enregdetbc['prix_unitaire']."','".$pt."','".$enregdetbc['poids']."','".$enregdetbc['volume']."')";
										$requete=mysql_query($sql);
										
										$quantite_livre = 0;										
									}
									
									//Correspondance bl et bc
									$reqverif="select * from erp_bc_bl_bc where idbl=".$idbl." and idbc=".$enregbc['id'];
									$queryverif=mysql_query($reqverif);
									if(mysql_num_rows($queryverif)<1){
										$sql="INSERT INTO `erp_bc_bl_bc`(`idbl`, `idbc`) VALUES ('".$idbl."','".$enregbc['id']."')";
										$requete=mysql_query($sql);
									}
									
								}
								
									//Mise à jours quantité
									$reqdet="select sum(quantite) as sumQTE from erp_bc_det_bl where iddetbc=".$enregdetbc['id'];
									$querydet=mysql_query($reqdet);
									while($enregdet=mysql_fetch_array($querydet)){
											$sql="update erp_bc_det_bc set qte_livree=".($enregdet['sumQTE'])." where id=".$enregdetbc['id'];
											$requete=mysql_query($sql);									
									}								
							}							
						}
										
					}	

								//Mise à jours stock semis finis
								$stock_sf = $stock_prd + $stock_maj_sf;
								$sql="update erp_bc_produits set stock_sf=".$stock_sf." where id=".$enregprd['id'];
								$requete=mysql_query($sql);	
								//Mise à jour stock reservée
								if($stock_sf>$stock_reservee){
									$sql="update erp_bc_produits set stock_reservee=0 where id=".$enregprd['id'];
									$requete=mysql_query($sql);										
								}
	
								
			}

	
	
	//Création de facture SEMI FINIS
		$ddate = date("Y-m-d");
		$date = new DateTime($ddate);
		$week = $date->format("W");	$semaine = $week;	
		$idfact=0; $mois = date('m');
		$req="select * from erp_bc_factsf where sunday='".$next_sunday."'";
		$query=mysql_query($req);
		$numfact=mysql_num_rows($query);	
		if($numfact>0){
			while($enreg=mysql_fetch_array($query)){
				$idfact	=	$enreg['id'];
			}
			//Mise à jour détail facture
			$reqdetbl="SELECT * FROM `erp_bc_det_bl` WHERE exists(select * from erp_bc_bl where erp_bc_bl.id=erp_bc_det_bl.idbl and semaine=".$semaine.")
			and not exists(select * from erp_bc_det_factsf where erp_bc_det_factsf.iddetbl=erp_bc_det_bl.id and idfact=".$idfact.")";
			$querydetbl=mysql_query($reqdetbl);
			while($enregdetbl=mysql_fetch_array($querydetbl)){
				
				$sqldet="INSERT INTO `erp_bc_det_factsf`( `idfact`, `iddetbl`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`, `volume`) VALUES";
				$sqldet=$sqldet." ('".$idfact."','".$enregdetbl['id']."','".$enregdetbl['produit']."','".$enregdetbl['quantite']."'
				,'".$enregdetbl['prix_unitaire']."','".$enregdetbl['prix_total']."'	,'".$enregdetbl['poids']."','".$enregdetbl['volume']."') ";
				$requete=mysql_query($sqldet);
				
			}			
			
			
		} else {
			$idfact=0; 
			$reqMax="select max(id) as maxFact from erp_bc_factsf";
			$queryMax=mysql_query($reqMax);
			if(mysql_num_rows($queryMax)>0){
				while($enregMax=mysql_fetch_array($queryMax)){
					$idfact	=	$enregMax['maxFact'] + 1;
				}
			} 	else{
					$idfact	=	1;
			}
			//Création d'une nouvelle facture
				$reference	=	"";
				$date = date("Y");
				$max="01";
				$reqm="SELECT * from  erp_bc_compteur_factsf  where date='".$date ."'" ;
				$querym=mysql_query($reqm);
				$numc=mysql_num_rows($querym);
					if($numc>0){
						$reqmax="SELECT max(compteur)+1 as MaxID from  erp_bc_compteur_factsf  where date='".$date ."'";
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
					
					$reference= "FC_".$date."_".$max;	
					$mois = date("m"); $trimestre=0;
					//Vérification de trimestre`
					if($mois == 1 or $mois == 2 or $mois == 3) {
						$trimestre=1;
					}
					if($mois == 4 or $mois == 5 or $mois == 6) {
						$trimestre=2;
					}					
					if($mois == 7 or $mois == 8 or $mois == 9) {
						$trimestre=3;
					}					
					if($mois == 10 or $mois == 11 or $mois == 12) {
						$trimestre=4;
					}					
				    $date1= date("Y-m-d");$dateheure			= 	date("Y-m-d H:i:s");	
					$idutilisateur=$_SESSION['erp_bc_IDUSER'];
					
					$sql="INSERT INTO `erp_bc_factsf`(`id`, `reference`, `client`, `trimestre`, `annee`, `mois`, `semaine`, `date`, `dateheure`, `idutilisateur`, `sunday`) VALUES ";
					$sql=$sql."('".$idfact."','".$reference."','1','".$trimestre."','".$date."','".$mois."','".$semaine."','".$date1."','".$dateheure."','".$idutilisateur."','".$next_sunday."') ";
					$req=mysql_query($sql);
					
					$sql="INSERT INTO `erp_bc_compteur_factsf`(`date`, `compteur`, `iddoc`) VALUES ('".$date."' ,'".$max."','".$idfact."')";
					$req=mysql_query($sql);	

					//Insertion détail
					$reqdetbl="SELECT * FROM `erp_bc_det_bl` WHERE exists(select * from erp_bc_bl where erp_bc_bl.id=erp_bc_det_bl.idbl and semaine='".$semaine."')
					and not exists(select * from erp_bc_det_factsf where erp_bc_det_factsf.iddetbl=erp_bc_det_bl.id and erp_bc_det_factsf.idfact=".$idfact.")";
					$querydetbl=mysql_query($reqdetbl);
					while($enregdetbl=mysql_fetch_array($querydetbl)){
						
						$sqldet="INSERT INTO `erp_bc_det_factsf`( `idfact`, `iddetbl`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`) VALUES";
						$sqldet=$sqldet." ('".$idfact."','".$enregdetbl['id']."','".$enregdetbl['produit']."','".$enregdetbl['quantite']."'
						,'".$enregdetbl['prix_unitaire']."','".$enregdetbl['prix_total']."'	,'".$enregdetbl['poids']."','".$enregdetbl['volume']."') ";
						$requete=mysql_query($sqldet);
						
					}
		}

		
	
	$json = '{"idfamille":"'.$famille.'","verification":"'.$verification.'","phase":"'.$phase.'"}';
	json_encode($json);
	echo $json;		

?>