<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Génération d'un Ordre de fabrication</h4>
				<br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
			</div>
		</div>
	</div>
  </div>
 <?php

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
		$reference_of	=	"";
		$reference_ofPF	=	"";
		$date = date("Y");
		$max="01";
		$reqm="SELECT * from  erp_fab_compteur_of  where date='".$date ."'" ;
		$querym=mysql_query($reqm);
		$numc=mysql_num_rows($querym);
			if($numc>0){
				$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_of  where date='".$date ."'";
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
			
			$reference_of= "OF_SF_".$date."_".$max;	
			$reference_ofPF= "OF_PF_".$date."_".$max;			
	}else{
		$id 		= "0";	
	}

	if(isset($_GET['IDD'])){
		$idd = $_GET['IDD'];
	}else{
		$idd = "0";
	}

if(isset($_POST['enregistrer_mail'])){	

	$idutilisateur		=	$_SESSION['erp_fab_IDUSER'] ;
	$remarque			=	addslashes($_POST["remarque"]) ;
	$date				=	addslashes($_POST["date"]) ;
	$dateheure			= 	date("Y-m-d H:i:s");	
	if(isset($_POST["emballage_sf"])){
			$emballage_sf=1;
	} else{
			$emballage_sf=0;
	}
	//Insertion entête
		$idof="0";
		$reqMax="select max(id) as idbc from erp_fab_of";
		$queryMax=mysql_query($reqMax);
		if(mysql_num_rows($queryMax)>0){
			while($enregMax=mysql_fetch_array($queryMax)){
				$idof	=	$enregMax['idbc'] + 1;
			}
		} else{
				$idof	=	"1";
		}
		$sql="INSERT INTO `erp_fab_of`(`id`, `reference`, `idbc`, `date`, `statut`, `dateheure`, `observation`, `idutilisateur`, `emballage_sf`) VALUES 
		('".$idof."','".$reference_of."','".$id."' ,'".$date."', '1' ,'".$dateheure."' ,'".$remarque."','".$idutilisateur."','".$emballage_sf."')";
		$req=mysql_query($sql);

		//Mise à jour compteur référence
		$date1 = date("Y");
		$max="";
		$reqm="SELECT * from  erp_fab_compteur_bc  where date='".$date1 ."'" ;
		$querym=mysql_query($reqm);
		$numc=mysql_num_rows($querym);
			if($numc>0){
				$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_of  where date='".$date1 ."'";
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
			$sql="INSERT INTO `erp_fab_compteur_of`(`date`, `compteur`, `iddoc`) VALUES ('".$date1."' ,'".$max."','".$idof."')";
			$req=mysql_query($sql);	
					
					
	//Order de fabrication SF
	$req="select * from erp_bc_det_bc where idbc=".$id." 
	and exists(select * from erp_fab_nomenclature_pf where erp_fab_nomenclature_pf.idproduit = erp_bc_det_bc.produit and exists(select * from erp_fab_produits where erp_fab_produits.id=erp_fab_nomenclature_pf.idsemi and exists(select * from erp_fab_classe where erp_fab_classe.id=erp_fab_produits.provenance and classe like'TN%')))	order by id asc ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{		//Début parcours table 	erp_bc_det_bc	TN	
	  $qte=$enreg['quantite'];		
	  //Insertion dans la table détail OF
	    $iddet = 0;
		$reqMax="select max(id) as idbc from erp_fab_detof";
		$queryMax=mysql_query($reqMax);
		if(mysql_num_rows($queryMax)>0){
			while($enregMax=mysql_fetch_array($queryMax)){
				$iddet	=	$enregMax['idbc'] + 1;
			}
		} else{
				$iddet	=	"1";
		}	  
		$sql="INSERT INTO `erp_fab_detof`(`id`, `idof`, `produit`, `prix_unitaire`, `quantite`, `prix_total`) VALUES";
		$sql=$sql." ('".$iddet."' ,'".$idof."' ,'".$enreg['produit']."' ,'".$enreg['prix_unitaire']."' ,'".$enreg['quantite']."','".$enreg['prix_total']."' ) ";
		$requete=mysql_query($sql);
	//FIN Insertion dans la table détail OF
	
	
		$reqservice="select * from erp_fab_service where id<4 order by ordre";
		$queryservice=mysql_query($reqservice);
		while($enregservice=mysql_fetch_array($queryservice)){	//Parcours de table service
			$req1="select * from erp_fab_nomenclature_pf where idproduit=".$enreg['produit']." 
			and exists(select * from erp_fab_produits_service where erp_fab_produits_service.idproduit=erp_fab_nomenclature_pf.idsemi and
			idservice=".$enregservice['id'].")";
			$query1=mysql_query($req1);
			while($enreg1=mysql_fetch_array($query1)){	//Parcours de table erp_fab_nomenclature_pf
				//Insertion dans la table erp_fab_detof_sf
				$sql="INSERT INTO `erp_fab_detof_sf`(`idof`, `iddet`, `produit`, `quantite`, `idsemi`, `iservice`) VALUES";
				$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."' ,'".$enreg1['quantite']*$qte."' ,'".$enreg1['idsemi']."','".$enregservice['id']."' ) ";
				$requete=mysql_query($sql);
				//Fin Insertion dans la table erp_fab_detof_sf
				
				$req2="select * from erp_fab_nomenclature where idproduit=".$enreg1['idsemi']." and idservice=".$enregservice['id'];
				$query2=mysql_query($req2);
				while($enreg2=mysql_fetch_array($query2)){ //Parcours de table erp_fab_nomenclature
					
					$sql="INSERT INTO `erp_fab_detof_mp`(`idof`, `iddet`, `produit`, `idsemi`, `quantite`, `idmp`, `iservice`) VALUES";
					$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."' ,'".$enreg1['idsemi']."'
					,'".$enreg2['quantite']."' ,'".$enreg2['idmp']."' ,'".$enregservice['id']."' ) ";
					$requete=mysql_query($sql);					
					
					
					
				} //Fin de table erp_fab_nomenclature

			}	//Fin Parcours de table erp_fab_nomenclature_pf
		} //Fin Parcours de table service		
		
	
		if($emballage_sf==1){ //Dans le cas d'emballage
			$req1="select * from erp_fab_nomenclature_pf where idproduit=".$enreg['produit']." 
			and exists(select * from erp_fab_produits_service where erp_fab_produits_service.idproduit=erp_fab_nomenclature_pf.idsemi)";
			$query1=mysql_query($req1);
			while($enreg1=mysql_fetch_array($query1)){	//Parcours de table erp_fab_nomenclature_pf			
				$req2="select * from erp_fab_nomenclature_emballage where idsemi=".$enreg1['idsemi'];
				$query2=mysql_query($req2);
				while($enreg2=mysql_fetch_array($query2)){ //Parcours de table erp_fab_nomenclature_emballage					
					$sql="INSERT INTO `erp_fab_detof_mp_emballage`(`idof`, `iddet`, `produit`, `idsemi`, `quantite`, `idmp`, `iservice`) VALUES";
					$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."' ,'".$enreg1['idsemi']."'
					,'".$enreg2['quantite']."' ,'".$enreg2['idmp']."' ,'5' ) ";
					$requete=mysql_query($sql);					
				
				} //Fin de table erp_fab_nomenclature_emballage			
			} //Parcours de table erp_fab_nomenclature_pf			
		
		} //Fin Dans le cas d'emballage
	
					
	}	//Fin parcours table erp_bc_det_bc TN
					
	$req="select * from erp_bc_det_bc where idbc=".$id." 
	and exists(select * from erp_fab_nomenclature_pf where erp_fab_nomenclature_pf.idproduit = erp_bc_det_bc.produit and exists(select * from erp_fab_produits where erp_fab_produits.id=erp_fab_nomenclature_pf.idsemi and exists(select * from erp_fab_classe where erp_fab_classe.id=erp_fab_produits.provenance and classe like'MT%')))	order by id asc ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{	//Début parcours table erp_bc_det_bc MT				
			 $qte=$enreg['quantite'];				
		  //Insertion dans la table détail OF
			$iddet = 0;
			$reqMax="select max(id) as idbc from erp_fab_detof";
			$queryMax=mysql_query($reqMax);
			if(mysql_num_rows($queryMax)>0){
				while($enregMax=mysql_fetch_array($queryMax)){
					$iddet	=	$enregMax['idbc'] + 1;
				}
			} else{
					$iddet	=	"1";
			}	  
			$sql="INSERT INTO `erp_fab_detof`(`id`, `idof`, `produit`, `prix_unitaire`, `quantite`, `prix_total`) VALUES";
			$sql=$sql." ('".$iddet."' ,'".$idof."' ,'".$enreg['produit']."' ,'".$enreg['prix_unitaire']."' ,'".$enreg['quantite']."','".$enreg['prix_total']."' ) ";
			$requete=mysql_query($sql);
		//FIN Insertion dans la table détail OF					
					
					
		$reqs="select * from erp_fab_nomenclature_pf WHERE idproduit=".$enreg['produit']."
		and exists(select * from erp_fab_produits where erp_fab_produits.id=erp_fab_nomenclature_pf.idsemi and  exists(select * from erp_fab_classe where erp_fab_classe.id=erp_fab_produits.provenance and classe like'MT%'))"
		;
		$querys=mysql_query($reqs);
		while($enregs=mysql_fetch_array($querys)){	//Début parcours table erp_fab_nomenclature_pf MT				
		
			$reqservice="select * from erp_fab_service where id<4 order by ordre";
			$queryservice=mysql_query($reqservice);
			while($enregservice=mysql_fetch_array($queryservice)){//Début parcours table erp_fab_service
				$aff="ser-".$enregs['idsemi']."-".$enregservice['id'];
				
				if(isset($_POST[$aff])){	
					//Insertion dans la table erp_fab_detof_sf
					$sql="INSERT INTO `erp_fab_detof_sf`(`idof`, `iddet`, `produit`, `quantite`, `idsemi`, `iservice`) VALUES";
					$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."' ,'".$enregs['quantite']*$qte."' ,'".$enregs['idsemi']."','".$enregservice['id']."' ) ";
					$requete=mysql_query($sql);
					//Fin Insertion dans la table erp_fab_detof_sf
					
					$req2="select * from erp_fab_nomenclature where idproduit=".$enregs['idsemi']." and idservice=".$enregservice['id'];
					$query2=mysql_query($req2);
					while($enreg2=mysql_fetch_array($query2)){ //Parcours de table erp_fab_nomenclature
						
						$sql="INSERT INTO `erp_fab_detof_mp`(`idof`, `iddet`, `produit`, `idsemi`, `quantite`, `idmp`, `iservice`) VALUES";
						$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."' ,'".$enregs['idsemi']."'
						,'".$enreg2['quantite']."' ,'".$enreg2['idmp']."' ,'".$enregservice['id']."' ) ";
						$requete=mysql_query($sql);					
						
					} //Fin de table erp_fab_nomenclature					
				
					if($emballage_sf==1){ //Dans le cas d'emballage		
							$req2="select * from erp_fab_nomenclature_emballage where idsemi=".$enregs['idsemi'];
							$query2=mysql_query($req2);
							while($enreg2=mysql_fetch_array($query2)){ //Parcours de table erp_fab_nomenclature_emballage					
								$sql="INSERT INTO `erp_fab_detof_mp_emballage`(`idof`, `iddet`, `produit`, `idsemi`, `quantite`, `idmp`, `iservice`) VALUES";
								$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."' ,'".$enregs['idsemi']."'
								,'".$enreg2['quantite']."' ,'".$enreg2['idmp']."' ,'5' ) ";
								$requete=mysql_query($sql);					
							
							} //Fin de table erp_fab_nomenclature_emballage									
					} //Fin Dans le cas d'emballage				
				}
				
			} //Fin parcours table erp_fab_service
			
		}//Fin parcours table erp_fab_nomenclature_pf MT				
					
	}	//Fin parcours table erp_bc_det_bc MT							
	
//Mise à jour montant total de OF
	$total="0";
	$reqTot="select sum(prix_total) as total from erp_fab_detof where idof=".$idof;
	$queryTot=mysql_query($reqTot);
	while($enregTot=mysql_fetch_array($queryTot)){
		$total	=	$enregTot['total'];
	}
	
	$sql="UPDATE erp_fab_of set montant='".$total."',observation='".$remarque."' where id=".$idof;
	$req=mysql_query($sql);		
	
	//Insertion OF_PF
	//Insertion entête
		$idof="0";
		$reqMax="select max(id) as idbc from erp_fab_of";
		$queryMax=mysql_query($reqMax);
		if(mysql_num_rows($queryMax)>0){
			while($enregMax=mysql_fetch_array($queryMax)){
				$idof	=	$enregMax['idbc'] + 1;
			}
		} else{
				$idof	=	"1";
		}
		$sql="INSERT INTO `erp_fab_of`(`id`, `reference`, `idbc`, `date`, `statut`, `dateheure`, `observation`, `idutilisateur`, `emballage_sf`) VALUES 
		('".$idof."','".$reference_ofPF."','".$id."' ,'".$date."', '1' ,'".$dateheure."' ,'".$remarque."','".$idutilisateur."','".$emballage_sf."')";
		$req=mysql_query($sql);	
		
		$req="select * from erp_bc_det_bc where idbc=".$id." order by id asc ";
		$query=mysql_query($req);
		while($enreg=mysql_fetch_array($query))
		{	//Parcours de table erp_bc_det_bc
		$qte=$enreg['quantite'];		
			  //Insertion dans la table détail OF
				$iddet = 0;
				$reqMax="select max(id) as idbc from erp_fab_detof";
				$queryMax=mysql_query($reqMax);
				if(mysql_num_rows($queryMax)>0){
					while($enregMax=mysql_fetch_array($queryMax)){
						$iddet	=	$enregMax['idbc'] + 1;
					}
				} else{
						$iddet	=	"1";
				}	  
				$sql="INSERT INTO `erp_fab_detof`(`id`, `idof`, `produit`, `prix_unitaire`, `quantite`, `prix_total`) VALUES";
				$sql=$sql." ('".$iddet."' ,'".$idof."' ,'".$enreg['produit']."' ,'".$enreg['prix_unitaire']."' ,'".$enreg['quantite']."','".$enreg['prix_total']."' ) ";
				$requete=mysql_query($sql);
			//FIN Insertion dans la table détail OF		
			$req1="select * from erp_fab_nomenclature_pf where idproduit=".$enreg['produit']." 
			and exists(select * from erp_fab_produits_service where erp_fab_produits_service.idproduit=erp_fab_nomenclature_pf.idsemi)";
			$query1=mysql_query($req1);
			while($enreg1=mysql_fetch_array($query1)){	//Parcours de table erp_fab_nomenclature_pf
			
				//Insertion dans la table erp_fab_detof_sf
				$sql="INSERT INTO `erp_fab_detof_sf`(`idof`, `iddet`, `produit`, `quantite`, `idsemi`) VALUES";
				$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."' ,'".$enreg1['quantite']*$qte."' ,'".$enreg1['idsemi']."') ";
				$requete=mysql_query($sql);

			}//Fin de table erp_fab_nomenclature_pf
			
			$req2="select * from erp_fab_nomenclature_emballage where idproduit=".$enreg['produit'];
			$query2=mysql_query($req2);
			while($enreg2=mysql_fetch_array($query2)){ //Parcours de table erp_fab_nomenclature_emballage					
				$sql="INSERT INTO `erp_fab_detof_mp_emballage_pf`(`idof`, `iddet`, `produit`, `quantite`, `idmp`, `iservice`) VALUES";
				$sql=$sql." ('".$idof."' ,'".$iddet."' ,'".$enreg['produit']."','".$enreg2['quantite']."' ,'".$enreg2['idmp']."' ,'5' ) ";
				$requete=mysql_query($sql);					
			
			} //Fin de table erp_fab_nomenclature_emballage				
			
			
	
		}  //Fin Parcours de table erp_bc_det_bc

		//Clôture de la table erp_fab_bc
		$sql="update erp_fab_bc set etat=1 where id=".$id;
		$query=mysql_query($sql);

		//Mise à jour montant total de OF
			$total="0";
			$reqTot="select sum(prix_total) as total from erp_fab_detof where idof=".$idof;
			$queryTot=mysql_query($reqTot);
			while($enregTot=mysql_fetch_array($queryTot)){
				$total	=	$enregTot['total'];
			}
			
			$sql="UPDATE erp_fab_of set montant='".$total."',observation='".$remarque."' where id=".$idof;
			$req=mysql_query($sql);	
		
		
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="gest_of.php" </SCRIPT>';

}
	$client				=	"1";
	$remarque			=	"";
	$produit			=	"0";
	$date_livraison		=	"0";
	$prix_unitaire		=	"0";
	$prix_total			=	"0";
	$quantite			=	"1";
	$type				=	0;
	$date				=	date("Y-m-d");
	
	$req="select * from erp_fab_bc where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$client				=	$enreg["client"] ;
		$date				=	$enreg["date"] ;
		$reference			=	$enreg["reference"] ;
		$remarque			=	$enreg["observation"] ;
	}

	?> 
  <div class="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<a href="gest_bc.php" class="btn btn-primary waves-effect waves-light">Retour</a> 
							<?php if(isset($_GET['suc'])){ ?>
								<?php if($_GET['suc']=='1'){ ?>
								<font color="green" style="background-color:#FFFFFF;"><center>Enregistrement effectué avec succès</center></font><br /><br />
							<?php } }?>		
							<form action="" method="POST">    
								<div class="form-group row">
									<div class="col-sm-2">
									<b>Référence (*)</b>
										<input class="form-control" type="text" placeholder="Référence" value="<?php echo $reference; ?>" 
										 name="reference" id="reference" readonly required>
									</div>	
									<div class="col-sm-2">
									<b>Date (*)</b>
										<input class="form-control" type="date" placeholder="Date" value="<?php echo $date; ?>" id="example-text-input" name="date" required readonly>
									</div>	
									<div class="col-sm-3">
									<b>Liste des clients (*)</b>
										<select class="form-control select2" name="client" required>
											<option value=""> Sélectionner un client </option>
											<?php
											$req="select * from erp_fab_clients order by raisonsocial";
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
											<option value="<?php echo $enreg['id']; ?>" <?php if($client==$enreg['id']) {?> selected <?php } ?>>
												<?php echo $enreg['raisonsocial']; ?>
											</option>
											<?php } ?>
										</select>										
									</div>										
									<div class="col-sm-3">	
										<b>Observation</b>
										<textarea class="form-control" id="remarque" name="remarque"><?php echo $remarque; ?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
								<h4 style="color:green">Produit Semi-finis fabriquait à Tunisie</h4>
                                   <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th><b>Produit Finis </b></th>
											<?php
												$reqservice="select * from erp_fab_service where id<4 order by ordre";
												$queryservice=mysql_query($reqservice);
												while($enregservice=mysql_fetch_array($queryservice)){
											?>
												<th></th>
											<?php } ?>
										</tr>
										<tr>
											<th></th>
											<?php
												$reqservice="select * from erp_fab_service where id<4 order by ordre";
												$queryservice=mysql_query($reqservice);
												while($enregservice=mysql_fetch_array($queryservice)){
											?>
												<th><b><?php echo $enregservice['service']; ?></b></th>
											<?php } ?>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php

	$produit			=	"";
	$qte				=	"0";
	$iddet				=	0;

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
	}else{
		$id = 0;
	}
	$req="select * from erp_bc_det_bc where idbc=".$id." 
	and exists(select * from erp_fab_nomenclature_pf where erp_fab_nomenclature_pf.idproduit = erp_bc_det_bc.produit and exists(select * from erp_fab_produits where erp_fab_produits.id=erp_fab_nomenclature_pf.idsemi and exists(select * from erp_fab_classe where erp_fab_classe.id=erp_fab_produits.provenance and classe like'TN%')))	order by id asc ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$iddet				=	$enreg["id"] ;	
		$qte				=	$enreg["quantite"] ;
	
		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enreg["produit"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}
		
			
	?>
			<tr>
				<td><?php echo $sproduit.' <br><i style="color:orange">QTE: '.$qte.'</i>'; ?></td>
			<?php 
				$reqservice="select * from erp_fab_service where id<4 order by ordre";
				$queryservice=mysql_query($reqservice);
				while($enregservice=mysql_fetch_array($queryservice)){
			?>
				<td></td>
				<?php } ?>
			</tr>
			<tr>
				<td></td>
			<?php 
				$i=0;
				$reqservice="select * from erp_fab_service where id<4 order by ordre";
				$queryservice=mysql_query($reqservice);
				while($enregservice=mysql_fetch_array($queryservice)){
					$i++;
			?>
				<td>
					<table>
					<?php
					$req1="select * from erp_fab_nomenclature_pf where idproduit=".$enreg['produit']." 
					and exists(select * from erp_fab_produits_service where erp_fab_produits_service.idproduit=erp_fab_nomenclature_pf.idsemi and
					idservice=".$enregservice['id'].")";
					$query1=mysql_query($req1);
					while($enreg1=mysql_fetch_array($query1)){
						$semi="";
						$reqfm="select * from erp_fab_produits where id=".$enreg1["idsemi"];
						$queryfm=mysql_query($reqfm);
						while($enregfm=mysql_fetch_array($queryfm)){
							$semi		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
						}
					?>					
					<tr>
						<td></td>		
						<td><?php echo $semi; ?><br><i style="color:orange"><?php echo 'Besoin Stock: '.$enreg1['quantite']*$qte; ?></i></td>	
					</tr>
				<?php } ?>		
					</table>
				</td>
			<?php } ?>	
			</tr>			
	<?php } ?>
                                        </tbody>
                                    </table>	
									<h4 style="color:green">Produit Semi-finis fabriquait à Malta</h4>
                                   <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th><b>Produit Finis </b></th>
										</tr>
										<tr>
											<th></th>
											<th><b>Produit Semi-Finis</b></th>
											<?php
												$reqservice="select * from erp_fab_service where id<4 order by ordre";
												$queryservice=mysql_query($reqservice);
												while($enregservice=mysql_fetch_array($queryservice)){
											?>
												<th><b><?php echo $enregservice['service']; ?></b></th>
											<?php } ?>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php

	$produit			=	"";
	$qte				=	"0";
	$iddet				=	0;

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
	}else{
		$id = 0;
	}
	$req="select * from erp_bc_det_bc where idbc=".$id." 
	and exists(select * from erp_fab_nomenclature_pf where erp_fab_nomenclature_pf.idproduit = erp_bc_det_bc.produit and exists(select * from erp_fab_produits where erp_fab_produits.id=erp_fab_nomenclature_pf.idsemi and exists(select * from erp_fab_classe where erp_fab_classe.id=erp_fab_produits.provenance and classe like'MT%')))	order by id asc ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$iddet				=	$enreg["id"] ;	
		$qte				=	$enreg["quantite"] ;
	
		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enreg["produit"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}
		
			
	?>		
		<tr>
			<td><?php echo $sproduit.' <br><i style="color:orange">QTE: '.$qte.'</i>'; ?></td>
		</tr>
		<?php 
			$reqs="select * from erp_fab_nomenclature_pf WHERE idproduit=".$enreg['produit']."
			and exists(select * from erp_fab_produits where erp_fab_produits.id=erp_fab_nomenclature_pf.idsemi and  exists(select * from erp_fab_classe where erp_fab_classe.id=erp_fab_produits.provenance and classe like'MT%'))"
			;
			$querys=mysql_query($reqs);
			while($enregs=mysql_fetch_array($querys)){
				$semi="";
				$reqfm="select * from erp_fab_produits where id=".$enregs["idsemi"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$semi		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
				}				
		?>		
			<tr>
				<td></td>
				<td><?php echo $semi; ?></td>
				<?php
					$reqservice="select * from erp_fab_service where id<4 order by ordre";
					$queryservice=mysql_query($reqservice);
					while($enregservice=mysql_fetch_array($queryservice)){
				?>				
					<td>
						<input type="checkbox" id="ser-<?php echo $enregs["idsemi"];?>-<?php echo $enregservice['id']; ?>" name="ser-<?php echo $enregs["idsemi"];?>-<?php echo $enregservice['id']; ?>" value="1">
					</td>
				<?php } ?>	
			</tr>
		<?php } ?>	
		
		
	<?php } ?>	
										
                                        </tbody>
                                    </table>											
									
									<div class="col-sm-4">	
										<br>
										<input type="checkbox" id="emballage_sf" name="emballage_sf" value="1"  checked>
										<label for="emballage_sf"> Avec Emballage Semi-Finis</label><br>									
									</div>	
									
									<div class="col-sm-2">	
										<br>
										<button type="submit" class="btn btn-primary waves-effect waves-light">
											Enregistrer
										</button>
										<input class="form-control" type="hidden" name="enregistrer_mail">										
									</div>													
								</div>
	
							</form>   
						</div>

					</div>
				 </div> 
			</div> 	
			
		 </div> 
  </div>
 </div>

<?php include ("menu_footer/footer.php"); ?>
<script>
	$('.qte').on("change", function(){
		var id = $(this).data('id');
		var qte=$("#quantite"+id).val();
		var qte_bc=$("#qte"+id).val();
		
		if(qte>qte_bc){
			alert('La quantité à fabriquer est supérieur à la quantité commandée');
			$("#quantite"+id).val('');
			return false;
		}
		var prix_unitaire = $("#prix_unitaire"+id).val();
		var total = prix_unitaire * qte;
		$("#prix_total"+id).val(total);
		
		
	});	
	$('.qte').on("keyup", function(){
		var id = $(this).data('id');
		var qte=$("#quantite"+id).val();
		var qte_bc=$("#qte"+id).val();
		
		if(qte>qte_bc){
			alert('La quantité à fabriquer est supérieur à la quantité commandée');
			$("#quantite"+id).val('');
			return false;
		}
		var prix_unitaire = $("#prix_unitaire"+id).val();
		var total = prix_unitaire * qte;
		$("#prix_total"+id).val(total);
		
		
	});	
	$(".qte").on("keypres", function(){
		var id = $(this).data('id');
		var qte=$("#quantite"+id).val();		
		var prix_unitaire = $("#prix_unitaire"+id).val();
		var total = prix_unitaire * qte;
		
		$("#prix_total"+id).val(total);
	});		

</script>