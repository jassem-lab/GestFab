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
		$reference	=	"";
		$date = date("Y");
		$max="01";
		$reqm="SELECT * from  erp_fab_compteur_inventaire  where date='".$date ."'" ;
		$querym=mysql_query($reqm);
		$numc=mysql_num_rows($querym);
			if($numc>0){
				$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_inventaire  where date='".$date ."'";
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
			
			$reference= "Inventaire_".$date."_".$max;			
	}


if(isset($_POST['enregistrer_mail'])){	

					
$extension = end(explode(".", $_FILES["fileAimporter"]["name"])); 
$allowed_extension = array("xls", "xlsx", "csv"); 
if(in_array($extension, $allowed_extension)) 
{
	$file = $_FILES["fileAimporter"]["tmp_name"]; 
	include("Classes/PHPExcel/IOFactory.php"); 
	$objPHPExcel = PHPExcel_IOFactory::load($file); 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	{
		$highestRow = $worksheet->getHighestRow();	
		for($row=2; $row<=$highestRow; $row++)
		{
			$idservice  = $id;
			$code   			    = mysql_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue());
			$des 			    	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue());
			$temps_execution 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue());
			$couleur		 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(3, $row)->getValue());
			$couleur_tag	 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(4, $row)->getValue());
			$cliche 				= mysql_real_escape_string($worksheet->getCellByColumnAndRow(5, $row)->getValue());
			$box_qty		 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(6, $row)->getValue());
			$jig			 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(7, $row)->getValue());
			$moule			 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(8, $row)->getValue());
			$poids_net		 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(9, $row)->getValue());
			$poids_brute	 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(10, $row)->getValue());
			$cavity			 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(11, $row)->getValue());
			$fm				 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(12, $row)->getValue());
			$fa				 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(13, $row)->getValue());
			$fz				 		= mysql_real_escape_string($worksheet->getCellByColumnAndRow(14, $row)->getValue());

			if($code<>"" and $code<>"Reference"){
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
					$sql="INSERT INTO `erp_fab_produits`(`id`,`code`,`designation`,`semi`,`provenance`) VALUES ('".$idproduit."','".$code."','".$des."','1','1')";
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
				if($fm<>""){
					$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=1";
					$queryverif=mysql_query($reqverif);
					if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
						$sql="update erp_fab_nomenclature set quantite=".$fm." where idservice=".$id." and idproduit=".$idproduit." and idmp=1";
						$requete=mysql_query($sql);
					} else{
						$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
						$sql=$sql."('".$idproduit."','".$idservice."','1','".$fm."') ";
						$requete=mysql_query($sql);
					}
				}
				
				if($fa<>""){
					$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=2";
					$queryverif=mysql_query($reqverif);
					if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
						$sql="update erp_fab_nomenclature set quantite=".$fa." where idservice=".$id." and idproduit=".$idproduit." and idmp=2";
						$requete=mysql_query($sql);
					} else{
						$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
						$sql=$sql."('".$idproduit."','".$idservice."','2','".$fa."') ";
						$requete=mysql_query($sql);
					}
				}
				
				if($fz<>""){
					$reqverif="select * from erp_fab_nomenclature where idservice=".$id." and idproduit=".$idproduit." and idmp=3";
					$queryverif=mysql_query($reqverif);
					if(mysql_num_rows($queryverif)>0){//Mise à jour de nomenclature
						$sql="update erp_fab_nomenclature set quantite=".$fz." where idservice=".$id." and idproduit=".$idproduit." and idmp=3";
						$requete=mysql_query($sql);
					} else{
						$sql="INSERT INTO `erp_fab_nomenclature`(`idproduit`, `idservice`, `idmp`, `quantite`) VALUES ";
						$sql=$sql."('".$idproduit."','".$idservice."','3','".$fz."') ";
						$requete=mysql_query($sql);
					}				
				}
			}
			
		}
	}	
}

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="nomenclature_service.php?ID='.$id.'&suc=1" </SCRIPT>';
}
	$type="";
	$req="select * from erp_fab_inventaire where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$type		=	$enreg['type'];
		$reference	=	$enreg['reference'];
	}

	?> 
  <div class="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
						<a href="nomenclature_sf_service.php" class="btn btn-primary waves-effect waves-light">Retour</a> 	
						<a href="modele_nomenclature.php" class="btn btn-primary waves-effect waves-light" style="background-color: orange">Modèle Viérge </a> 
							<?php if(isset($_GET['suc'])){ ?>
								<?php if($_GET['suc']=='1'){ ?>
								<font color="green" style="background-color:#FFFFFF;"><center>Enregistrement effectué avec succès</center></font><br /><br />
								<?php } ?>
							<?php }?>								  
								<form action="" method="POST"  enctype="multipart/form-data">  
									<div class="form-group">
										<label for="" class="control-label">Fichier (.xls) :<span class='require'>*</span></label>
										<input type="file" class="form-control input-lg" name="fileAimporter" style="height:60px;" required>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Nomenclature</h3>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>Services</b></th>
										<th><b>Comp</b></th>
										<th><b>Color</b></th>
										<th><b>Cliche</b></th>
										<th><b>Box Qty</b></th>
										<th><b>Jig</b></th>
										<th><b>Mold</b></th>
										<th><b>Net Weight</b></th>
										<th><b>Gross Weight</b></th>
										<th><b>Cavity</b></th>
										<th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php

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
	$req="select * from erp_fab_produits_service where idservice=".$_GET['ID'];
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
                    </div>

                </div>
            </div>				 
  </div>
 </div>

<?php include ("menu_footer/footer.php"); ?>