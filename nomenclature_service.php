<?php include ("menu_footer/menu.php"); ?>
<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Nomenclature Service et produits Semi Finis</h4>
                    <?php 
	$id = $_GET['ID'];
	$req="select * from erp_fab_service where id=".$id; 
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$service			=	$enreg["service"] ;
	}

?>
                    <h4>Service : <?php echo $service; ?></h4>

                    <br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
                </div>
            </div>
        </div>
    </div>

    <?php

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
		
	}else{
		$id = "0";		
	}


if(isset($_POST['enregistrer_mail'])){	

	$file = $_FILES["fileAimporter"]["tmp_name"]; 
	include("Classes/PHPExcel/IOFactory.php"); 
	$objPHPExcel = PHPExcel_IOFactory::load($file); 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	{
		
		
		$highestRow = $worksheet->getHighestRow();	
		for($row=2; $row<=$highestRow; $row++)
		{
			
			
			
			$idservice  = $id;
			$code   			    = trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
			$des 			    	= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
			$temps_execution 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
			$couleur		 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(3, $row)->getValue()));
			$couleur_tag	 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(4, $row)->getValue()));
			$cliche 				= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(5, $row)->getValue()));
			$box_qty		 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(6, $row)->getValue()));
			$jig			 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(7, $row)->getValue()));
			$moule			 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(8, $row)->getValue()));
			$poids_net		 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(9, $row)->getValue()));
			$poids_brute	 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(10, $row)->getValue()));
			$cavity			 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(11, $row)->getValue()));
			$fm				 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(12, $row)->getValue()));
			$fa				 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(13, $row)->getValue()));
			$fz				 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(14, $row)->getValue()));

			if($code<>""){ // Début Insertion d'une ligne
			
				$idproduit = 0;
				$req="select * from erp_fab_produits where code='".$code."'";
				$query=mysql_query($req);
				if(mysql_num_rows($query)>0){
					while($enreg=mysql_fetch_array($query)){
						$idproduit = $enreg['id'];
					}
				} else{ //Insertion d'un nouvelle produit
					$reqmax="select max(id) as maxID from erp_fab_produits";
					$querymax=mysql_query($reqmax);
					while($enregmax=mysql_fetch_array($querymax)){
						$idproduit = $enregmax['maxID']+1;
					}
					$sql="INSERT INTO `erp_fab_produits`(`id`,`code`,`designation`,`semi`,`provenance`) VALUES ('".$idproduit."','".$code."','".$des."','0','1')";
					$requete=mysql_query($sql);
				}
				
				$idcouleur = 0;
				$req="select * from erp_fab_couleurs where couleur='".$couleur_tag."'";
				$query=mysql_query($req);
				if(mysql_num_rows($query)>0){
					while($enreg=mysql_fetch_array($query)){
						$idcouleur = $enreg['id'];
					}
				} else{ //Insertion d'un nouvelle couleur
					$reqmax="select max(id) as maxID from erp_fab_couleurs";
					$querymax=mysql_query($reqmax);
					while($enregmax=mysql_fetch_array($querymax)){
						$idcouleur = $enregmax['maxID']+1;
					}
					$sql="INSERT INTO `erp_fab_couleurs`(`id`,`couleur`,`designation`) VALUES ('".$idcouleur."','".$couleur_tag."','".$couleur."')";
					$requete=mysql_query($sql);
				}

				$idcliche = 0;
				$req="select * from erp_fab_cliches where cliche='".$cliche."'";
				$query=mysql_query($req);
				if(mysql_num_rows($query)>0){
					while($enreg=mysql_fetch_array($query)){
						$idcliche = $enreg['id'];
					}
				} else{ //Insertion d'un nouvelle cliche
					$reqmax="select max(id) as maxID from erp_fab_cliches";
					$querymax=mysql_query($reqmax);
					while($enregmax=mysql_fetch_array($querymax)){
						$idcliche = $enregmax['maxID']+1;
					}
					$sql="INSERT INTO `erp_fab_cliches`(`id`,`cliche`) VALUES ('".$idcliche."','".$cliche."')";
					$requete=mysql_query($sql);
				}				

				$idjig = 0;
				$req="select * from erp_fab_jig where jig='".$jig."'";
				$query=mysql_query($req);
				if(mysql_num_rows($query)>0){
					while($enreg=mysql_fetch_array($query)){
						$idjig = $enreg['id'];
					}
				} else{ //Insertion d'un nouvelle jig
					$reqmax="select max(id) as maxID from erp_fab_jig";
					$querymax=mysql_query($reqmax);
					while($enregmax=mysql_fetch_array($querymax)){
						$idjig = $enregmax['maxID']+1;
					}
					$sql="INSERT INTO `erp_fab_jig`(`id`,`jig`) VALUES ('".$idjig."','".$jig."')";
					$requete=mysql_query($sql);
				}					

				$idmoule = 0;
				$req="select * from erp_fab_moules where moule='".$moule."'";
				$query=mysql_query($req);
				if(mysql_num_rows($query)>0){
					while($enreg=mysql_fetch_array($query)){
						$idmoule = $enreg['id'];
					}
				} else{ //Insertion d'un nouvelle moule
					$reqmax="select max(id) as maxID from erp_fab_moules";
					$querymax=mysql_query($reqmax);
					while($enregmax=mysql_fetch_array($querymax)){
						$idmoule = $enregmax['maxID']+1;
					}
					$sql="INSERT INTO `erp_fab_moules`(`id`,`moule`) VALUES ('".$idmoule."','".$moule."')";
					$requete=mysql_query($sql);
				}	


				
				$reqverif="select * from erp_fab_produits_service where idservice=".$id." and idproduit=".$idproduit;
				$queryverif=mysql_query($reqverif);
				if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
					
					$sql="update erp_fab_produits_service set temps_execution='".$temps_execution."', couleur=".$idcouleur.", cliche=".$idcliche.",
					 jig=".$idjig.", moule=".$idmoule.", box_qty=".$box_qty.", cavity=".$cavity.", poids_net=".$poids_net.", poids_brute=".$poids_brute."
					where idservice=".$id." and idproduit=".$idproduit;
					$requete=mysql_query($sql);
				} else{ //Insertion de nomenclature
					
					$sql="INSERT INTO `erp_fab_produits_service`(`idproduit`, `idservice`, `temps_execution`, `couleur`, `cliche`, `jig`, `moule`, `box_qty`, `poids_net`, `poids_brute`, `cavity`) VALUES";
					$sql=$sql."('".$idproduit."','".$idservice."','".$temps_execution."','".$idcouleur."','".$idcliche."','".$idjig."','".$idmoule."','".$box_qty."','".$poids_net."','".$poids_brute."','".$cavity."') ";
					$requete=mysql_query($sql);
				}
				
				
				//Nomenclature MP
				if(trim($fm)<>""){ //Début FM
					$qte					= 0;
					$fm 					= trim($fm); //Supprimer les espaces
					$nb_occ					= mb_substr_count($fm,'-');
					if($nb_occ==1){ //Début test sur une seule référence de FM
						$fm = str_replace('-','',$fm);
						$fm = trim($fm);
						$nb_occ_1	= strpos(trim($fm),"(");
						$nb_occ_2	= strpos(trim($fm),")");
						if($nb_occ_1>0){
							$fm1=$fm;
							$fm=substr(trim($fm),0,$nb_occ_1);
							$fm=trim($fm);
							$qte=substr($fm1,$nb_occ_1,strlen($fm1));
							
							$qte=str_replace("(","",$qte);
							$qte=str_replace(")","",$qte);							
						} 	else{
							$qte=1;	
						}
						//Test sur l'existance de référence
								$idmp = 0;
								$req="select * from erp_fab_mp where code='".$fm."'";
								$query=mysql_query($req);
								if(mysql_num_rows($query)>0){
									while($enreg=mysql_fetch_array($query)){
										$idmp = $enreg['id'];
									}
								} else{ //Insertion d'un nouvelle mp
									$reqmax="select max(id) as maxID from erp_fab_mp";
									$querymax=mysql_query($reqmax);
									while($enregmax=mysql_fetch_array($querymax)){
										$idmp = $enregmax['maxID']+1;
									}
									$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fm."')";
									$requete=mysql_query($sql);
								}							
						//Fin Test sur l'existance de référence
						//Insertion ou mise à jour de table Nomenclature MP
							$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
							$queryverif=mysql_query($reqverif);
							if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
								$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
								$requete=mysql_query($sql);
							} else{
								$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
								$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
								$requete=mysql_query($sql);
							}							
						//Fin Insertion ou mise à jour de table Nomenclature MP
						
						
					} else{
						$tableau_fm	 = array();
						for($l=0; $l<$nb_occ+1; $l++){
							$tableau_fm[$l]	="";
						}	
												
						$l=0;$j=0;
						for($k=0; $k<strlen($fm); $k++){
								if($fm[$k]<>"-"){
									$tableau_fm[$l]=trim($tableau_fm[$l].$fm[$k]);	
									$j=$j+1;
								}else{
									$l=$l+1;
								}
						}
						
						for($i=0;$i<$nb_occ+1;$i++){	
							$nb_occ_1	= strpos($tableau_fm[$i],"(");
							$nb_occ_2	= strpos($tableau_fm[$i],")");					
								if($nb_occ_1>0){
									$fm=substr($tableau_fm[$i],0,$nb_occ_1);
									$fm=trim($fm);
									$qte=substr($tableau_fm[$i],$nb_occ_1+1,strlen($tableau_fm[$i]));
									$qte=str_replace("(","",$qte);
									$qte=str_replace(")","",$qte);
									if($fm<>''){
											//Test sur l'existance de référence
													$idmp = 0;
													$req="select * from erp_fab_mp where code='".$fm."'";
													$query=mysql_query($req);
													if(mysql_num_rows($query)>0){
														while($enreg=mysql_fetch_array($query)){
															$idmp = $enreg['id'];
														}
													} else{ //Insertion d'un nouvelle mp
														$reqmax="select max(id) as maxID from erp_fab_mp";
														$querymax=mysql_query($reqmax);
														while($enregmax=mysql_fetch_array($querymax)){
															$idmp = $enregmax['maxID']+1;
														}
														$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fm."')";
														$requete=mysql_query($sql);
													}							
											//Fin Test sur l'existance de référence
											//Insertion ou mise à jour de table Nomenclature MP
												$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
												$queryverif=mysql_query($reqverif);
												if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
													$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
													$requete=mysql_query($sql);
												} else{
													$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
													$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
													$requete=mysql_query($sql);
												}							
											//Fin Insertion ou mise à jour de table Nomenclature MP
											
									}
								} else{
									$fm=($tableau_fm[$i]);
									$qte=1;
									if($fm<>''){
											//Test sur l'existance de référence
													$idmp = 0;
													$req="select * from erp_fab_mp where code='".$fm."'";
													$query=mysql_query($req);
													if(mysql_num_rows($query)>0){
														while($enreg=mysql_fetch_array($query)){
															$idmp = $enreg['id'];
														}
													} else{ //Insertion d'un nouvelle mp
														$reqmax="select max(id) as maxID from erp_fab_mp";
														$querymax=mysql_query($reqmax);
														while($enregmax=mysql_fetch_array($querymax)){
															$idmp = $enregmax['maxID']+1;
														}
														$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fm."')";
														$requete=mysql_query($sql);
													}							
											//Fin Test sur l'existance de référence
											//Insertion ou mise à jour de table Nomenclature MP
												$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
												$queryverif=mysql_query($reqverif);
												if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
													$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
													$requete=mysql_query($sql);
												} else{
													$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
													$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
													$requete=mysql_query($sql);
												}							
											//Fin Insertion ou mise à jour de table Nomenclature MP
											
									}			
								}						
							}						

					}//Fin test sur une seule référence de FM
				}  //fin FM
				
				//Nomenclature MP
				if(trim($fa)<>""){ //Début FA
					$qte					= 0;
					$fa 					= trim($fa); //Supprimer les espaces
					$nb_occ					= mb_substr_count($fa,'-');
					if($nb_occ==1){ //Début test sur une seule référence de FM
						$fa = str_replace('-','',$fa);
						$fa = trim($fa);
						$nb_occ_1	= strpos(trim($fa),"(");
						$nb_occ_2	= strpos(trim($fa),")");
						if($nb_occ_1>0){
							$fa1=$fa;
							$fa=substr(trim($fa),0,$nb_occ_1);
							$fm=trim($fm);
							$qte=substr($fa1,$nb_occ_1,strlen($fa1));
							
							$qte=str_replace("(","",$qte);
							$qte=str_replace(")","",$qte);							
						} 	else{
							$qte=1;	
						}
						//Test sur l'existance de référence
								$idmp = 0;
								$req="select * from erp_fab_mp where code='".$fa."'";
								$query=mysql_query($req);
								if(mysql_num_rows($query)>0){
									while($enreg=mysql_fetch_array($query)){
										$idmp = $enreg['id'];
									}
								} else{ //Insertion d'un nouvelle mp
									$reqmax="select max(id) as maxID from erp_fab_mp";
									$querymax=mysql_query($reqmax);
									while($enregmax=mysql_fetch_array($querymax)){
										$idmp = $enregmax['maxID']+1;
									}
									$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fa."')";
									$requete=mysql_query($sql);
								}							
						//Fin Test sur l'existance de référence
						//Insertion ou mise à jour de table Nomenclature MP
							$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
							$queryverif=mysql_query($reqverif);
							if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
								$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
								//$requete=mysql_query($sql);
							} else{
								$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
								$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
								$requete=mysql_query($sql);
							}							
						//Fin Insertion ou mise à jour de table Nomenclature MP
						
						
					} else{
						$tableau_fm	 = array();
						for($l=0; $l<$nb_occ+1; $l++){
							$tableau_fm[$l]	="";
						}	
												
						$l=0;$j=0;
						for($k=0; $k<strlen($fa); $k++){
								if($fa[$k]<>"-"){
									$tableau_fm[$l]=trim($tableau_fm[$l].$fa[$k]);	
									$j=$j+1;
								}else{
									$l=$l+1;
								}
						}
						
						for($i=0;$i<$nb_occ+1;$i++){	
							$nb_occ_1	= strpos($tableau_fm[$i],"(");
							$nb_occ_2	= strpos($tableau_fm[$i],")");					
								if($nb_occ_1>0){
									$fa=substr($tableau_fm[$i],0,$nb_occ_1);
									$fa=trim($fa);
									$qte=substr($tableau_fm[$i],$nb_occ_1+1,strlen($tableau_fm[$i]));
									$qte=str_replace("(","",$qte);
									$qte=str_replace(")","",$qte);
									if($fa<>''){
											//Test sur l'existance de référence
													$idmp = 0;
													$req="select * from erp_fab_mp where code='".$fa."'";
													$query=mysql_query($req);
													if(mysql_num_rows($query)>0){
														while($enreg=mysql_fetch_array($query)){
															$idmp = $enreg['id'];
														}
													} else{ //Insertion d'un nouvelle mp
														$reqmax="select max(id) as maxID from erp_fab_mp";
														$querymax=mysql_query($reqmax);
														while($enregmax=mysql_fetch_array($querymax)){
															$idmp = $enregmax['maxID']+1;
														}
														$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fa."')";
														$requete=mysql_query($sql);
													}							
											//Fin Test sur l'existance de référence
											//Insertion ou mise à jour de table Nomenclature MP
												$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
												$queryverif=mysql_query($reqverif);
												if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
													$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
													$requete=mysql_query($sql);
												} else{
													$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
													$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
													$requete=mysql_query($sql);
												}							
											//Fin Insertion ou mise à jour de table Nomenclature MP
											
									}
								} else{
									$fa=($tableau_fm[$i]);
									$qte=1;
									if($fa<>''){
											//Test sur l'existance de référence
													$idmp = 0;
													$req="select * from erp_fab_mp where code='".$fa."'";
													$query=mysql_query($req);
													if(mysql_num_rows($query)>0){
														while($enreg=mysql_fetch_array($query)){
															$idmp = $enreg['id'];
														}
													} else{ //Insertion d'un nouvelle mp
														$reqmax="select max(id) as maxID from erp_fab_mp";
														$querymax=mysql_query($reqmax);
														while($enregmax=mysql_fetch_array($querymax)){
															$idmp = $enregmax['maxID']+1;
														}
														$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fa."')";
														$requete=mysql_query($sql);
													}							
											//Fin Test sur l'existance de référence
											//Insertion ou mise à jour de table Nomenclature MP
												$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
												$queryverif=mysql_query($reqverif);
												if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
													$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
													$requete=mysql_query($sql);
												} else{
													$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
													$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
													$requete=mysql_query($sql);
												}							
											//Fin Insertion ou mise à jour de table Nomenclature MP
											
									}			
								}						
							}						

					}//Fin test sur une seule référence de FA
				}  //fin FA				
				
				//Nomenclature MP
				if(trim($fz)<>""){ //Début FZ
					$qte					= 0;
					$fz 					= trim($fz); //Supprimer les espaces
					$nb_occ					= mb_substr_count($fz,'-');
					if($nb_occ==1){ //Début test sur une seule référence de FM
						$fz = str_replace('-','',$fz);
						$fz = trim($fz);
						$nb_occ_1	= strpos(trim($fz),"(");
						$nb_occ_2	= strpos(trim($fz),")");
						if($nb_occ_1>0){
							$fz1=$fz;
							$fz=substr(trim($fz),0,$nb_occ_1);
							$fm=trim($fm);
							$qte=substr($fz1,$nb_occ_1,strlen($fz1));
							
							$qte=str_replace("(","",$qte);
							$qte=str_replace(")","",$qte);							
						} 	else{
							$qte=1;	
						}
						//Test sur l'existance de référence
								$idmp = 0;
								$req="select * from erp_fab_mp where code='".$fz."'";
								$query=mysql_query($req);
								if(mysql_num_rows($query)>0){
									while($enreg=mysql_fetch_array($query)){
										$idmp = $enreg['id'];
									}
								} else{ //Insertion d'un nouvelle mp
									$reqmax="select max(id) as maxID from erp_fab_mp";
									$querymax=mysql_query($reqmax);
									while($enregmax=mysql_fetch_array($querymax)){
										$idmp = $enregmax['maxID']+1;
									}
									$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fz."')";
									$requete=mysql_query($sql);
								}							
						//Fin Test sur l'existance de référence
						//Insertion ou mise à jour de table Nomenclature MP
							$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
							$queryverif=mysql_query($reqverif);
							if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
								$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
								$requete=mysql_query($sql);
							} else{
								$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
								$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
								$requete=mysql_query($sql);
							}							
						//Fin Insertion ou mise à jour de table Nomenclature MP
						
						
					} else{
						$tableau_fm	 = array();
						for($l=0; $l<$nb_occ+1; $l++){
							$tableau_fm[$l]	="";
						}	
												
						$l=0;$j=0;
						for($k=0; $k<strlen($fz); $k++){
								if($fz[$k]<>"-"){
									$tableau_fm[$l]=trim($tableau_fm[$l].$fz[$k]);	
									$j=$j+1;
								}else{
									$l=$l+1;
								}
						}
						
						for($i=0;$i<$nb_occ+1;$i++){	
							$nb_occ_1	= strpos($tableau_fm[$i],"(");
							$nb_occ_2	= strpos($tableau_fm[$i],")");					
								if($nb_occ_1>0){
									$fz=substr($tableau_fm[$i],0,$nb_occ_1);
									$fz=trim($fz);
									$qte=substr($tableau_fm[$i],$nb_occ_1+1,strlen($tableau_fm[$i]));
									$qte=str_replace("(","",$qte);
									$qte=str_replace(")","",$qte);
									if($fz<>''){
											//Test sur l'existance de référence
													$idmp = 0;
													$req="select * from erp_fab_mp where code='".$fz."'";
													$query=mysql_query($req);
													if(mysql_num_rows($query)>0){
														while($enreg=mysql_fetch_array($query)){
															$idmp = $enreg['id'];
														}
													} else{ //Insertion d'un nouvelle mp
														$reqmax="select max(id) as maxID from erp_fab_mp";
														$querymax=mysql_query($reqmax);
														while($enregmax=mysql_fetch_array($querymax)){
															$idmp = $enregmax['maxID']+1;
														}
														$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fz."')";
														$requete=mysql_query($sql);
													}							
											//Fin Test sur l'existance de référence
											//Insertion ou mise à jour de table Nomenclature MP
												$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
												$queryverif=mysql_query($reqverif);
												if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
													$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
													$requete=mysql_query($sql);
												} else{
													$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
													$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
													$requete=mysql_query($sql);
												}							
											//Fin Insertion ou mise à jour de table Nomenclature MP
											
									}
								} else{
									$fz=($tableau_fm[$i]);
									$qte=1;
									if($fz<>''){
											//Test sur l'existance de référence
													$idmp = 0;
													$req="select * from erp_fab_mp where code='".$fz."'";
													$query=mysql_query($req);
													if(mysql_num_rows($query)>0){
														while($enreg=mysql_fetch_array($query)){
															$idmp = $enreg['id'];
														}
													} else{ //Insertion d'un nouvelle mp
														$reqmax="select max(id) as maxID from erp_fab_mp";
														$querymax=mysql_query($reqmax);
														while($enregmax=mysql_fetch_array($querymax)){
															$idmp = $enregmax['maxID']+1;
														}
														$sql="INSERT INTO `erp_fab_mp`(`id`,`code`) VALUES ('".$idmp."','".$fz."')";
														$requete=mysql_query($sql);
													}							
											//Fin Test sur l'existance de référence
											//Insertion ou mise à jour de table Nomenclature MP
												$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
												$queryverif=mysql_query($reqverif);
												if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
													$sql="update erp_fab_nomenclature set quantite=".$qte." where idservice=".$id." and idproduit=".$idproduit." and idmp=".$idmp;
													$requete=mysql_query($sql);
												} else{
													$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
													$sql=$sql."('".$idproduit."','".$idservice."','".$idmp."','".$qte."') ";
													$requete=mysql_query($sql);
												}							
											//Fin Insertion ou mise à jour de table Nomenclature MP
									}			
								}						
							}						

					}//Fin test sur une seule référence de FZ
				}  //fin FZ					

			} // Fin Insertion d'une ligne
			
		}
	}	
	

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="nomenclature_service.php?ID='.$id.'&suc=1" </SCRIPT>';
}
	?>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <a href="nomenclature_sf_service.php"
                                class="btn btn-primary waves-effect waves-light">Retour</a>
                            <a href="modele_nomenclature.php" class="btn btn-primary waves-effect waves-light"
                                style="background-color: orange">Modèle Viérge </a>
                            <?php if(isset($_GET['suc'])){ ?>
                            <?php if($_GET['suc']=='1'){ ?>
                            <font color="green" style="background-color:#FFFFFF;">
                                <center>Enregistrement effectué avec succès</center>
                            </font><br /><br />
                            <?php } ?>
                            <?php }?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="" class="control-label">Fichier (.xls) :<span
                                            class='require'>*</span></label>
                                    <input type="file" class="form-control input-lg" name="fileAimporter"
                                        style="height:60px;" required>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <br>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Mise à jours nomenclature
                                        </button>
                                        <input class="form-control" type="hidden" name="enregistrer_mail">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
$reqCode="";
$code="";
if(isset($_POST['code'])){
	if(($_POST['code'])<>""){
		$code			=	$_POST['code'];
		$reqCode		=	" and idproduit=".$code;
	}
}

?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Nomenclature</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des codes</b>
                                            <select class="form-control select2" name="code">
                                                <option value=""> Sélectionner un code produit</option>
                                                <?php
												$req="select * from erp_fab_produits where semi=0 order by code";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                                <option value="<?php echo $enreg['id']; ?>"
                                                    <?php if($code==$enreg['id']) {?> selected <?php } ?>>
                                                    <?php echo $enreg['code']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xl-2">
                                            <form name="SubmitContact" class="" method="post" action="">
                                                <b>Affichage par</b>
                                                <select class="form-control select2" name="limit-records"
                                                    id="limit-records">
                                                    <option value="20"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==20){ ?>
                                                        selected <?php }} ?>>20 produits</option>
                                                    <option value="50"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==50){ ?>
                                                        selected <?php }} ?>>50 produits</option>
                                                    <option value="100"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==100){ ?>
                                                        selected <?php }} ?>>100 produits</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-xl-4">
                                            <b></b><br>
                                            <input name="SubmitContact" type="submit" id="submit"
                                                class="btn btn-primary btn-sm " value="Filtrer">

                                        </div>
                                        <div class="col-xl-8">
                                            <b></b><br>
                                            <a href="modele_nomenclature_pf.php"
                                                class="btn btn-primary waves-effect waves-light"
                                                style="background-color: orange">Modèle Nomenclature Viérge </a>
                                            <a href="nomenclature_pf_sf.php"
                                                class="btn btn-primary waves-effect waves-light"
                                                style="background-color: blue">Mise à jours Nomenclature </a>
                                            <a href="exportation/export_nomenclature_service.php?ID=<?php echo $_GET['ID'] ?>"
                                                class="btn btn-success waves-effect waves-light ">
                                                Exporter Excel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>Produit</b></th>
                                        <th><b>Comp</b></th>
                                        <th><b>Color</b></th>
                                        <th><b>Cliche</b></th>
                                        <th><b>Box Qty</b></th>
                                        <th><b>Jig</b></th>
                                        <th><b>Mold</b></th>
                                        <th><b>Net Weight</b></th>
                                        <th><b>Gross Weight</b></th>
                                        <th><b>Cavity</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
	$req="select * from erp_fab_produits_service where idservice=".$_GET['ID'].$reqCode;
	$query=mysql_query($req);
	$total=mysql_num_rows($query);
	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	} else{
		$page = 1;
	}
	if(isset($_POST['limit-records'])){
		$limit = $_POST['limit-records'];
	} else{
		$limit = 20;
	}
	if(isset($_GET['limit'])){
		$limit = $_GET['limit'];
	}											
	$start		 = ($page - 1) * $limit;
	$page 		 = ceil( $total / $limit );						
	$Previous    = $page - 1;
	$Next 		 = $page + 1;	


	$service 			=	'';
	$temps_execution 	=	0;
	$couleur		 	=	0;
	$cliche			 	=	'';
	$jig			 	=	'';
	$poids_net		 	=	'';
	$poids_brute	 	=	0;
	$box_qty			=	"";
	$cavity				=	0;
	$moule				=	0;
	$req="select * from erp_fab_produits_service where idservice=".$_GET['ID'].$reqCode."  LIMIT $start, $limit";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$service 			=	$enreg['idservice'];
		$temps_execution 	=	$enreg['temps_execution'];
		$couleur		 	=	$enreg['couleur'];
		$cliche			 	=	$enreg['cliche'];
		$jig			 	=	$enreg['jig'];
		$poids_net		 	=	$enreg['poids_net'];
		$poids_brute	 	=	$enreg['poids_brute'];
		$cavity			 	=	$enreg['cavity'];
		$box_qty			=	$enreg['box_qty'];
		$moule				=	$enreg['moule'];

		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enreg["idproduit"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}
		
		$reqser="select * from erp_fab_service where id=".$service;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$service 			=	$enregser['service'];
		}
		
		$reqser="select * from erp_fab_couleurs where id=".$couleur;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$couleur 			=	$enregser['couleur'].'-'.$enregser['designation'];
		}		

		$reqser="select * from erp_fab_cliches where id=".$cliche;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$cliche 			=	$enregser['cliche'];
		}

		$reqser="select * from erp_fab_jig where id=".$jig;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$jig 			=	$enregser['jig'];
		}	

		$reqser="select * from erp_fab_moules where id=".$moule;
		$queryser=mysql_query($reqser);
		while($enregser=mysql_fetch_array($queryser)){
			$moule 			=	$enregser['moule'];
		}			

	?>
                                    <tr>
                                        <td><?php echo $sproduit; ?></td>
                                        <td><?php echo $temps_execution; ?></td>
                                        <td><?php echo $couleur; ?></td>
                                        <td><?php echo $cliche; ?></td>
                                        <td><?php echo $box_qty; ?></td>
                                        <td><?php echo $jig; ?></td>
                                        <td><?php echo $moule; ?></td>
                                        <td><?php echo $poids_net; ?></td>
                                        <td><?php echo $poids_brute; ?></td>
                                        <td><?php echo $cavity; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="nomenclature_service.php?ID=<?php echo $_GET['ID'];?>&page=<?php echo $Previous; ?>&limit=<?php echo $limit;?>">Précédente</a>
                                </li>
                                <?php 
												for($i=1;$i<=$page;$i++){
											?>
                                <li class="page-item"><a class="page-link"
                                        href="nomenclature_service.php?ID=<?php echo $_GET['ID'];?>&page=<?php echo $i; ?>&limit=<?php echo $limit;?>"><?php echo $i; ?></a>
                                </li>
                                <?php } ?>
                                <li class="page-item"><a class="page-link"
                                        href="nomenclature_service.php?ID=<?php echo $_GET['ID'];?>&page=<?php echo $Next; ?>&limit=<?php echo $limit;?>">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include ("menu_footer/footer.php"); ?>