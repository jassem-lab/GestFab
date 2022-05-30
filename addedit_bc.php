<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Gestion des commandes client</h4>
				<br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
			</div>
		</div>
	</div>
  </div>
  <script>
		function Supprimer(id,idd)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/supprimerdet_bc.php?IDD="+idd+"&ID="+id ;
			}			    
	  }	
  </script>
 <?php

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
		$reference="";
	}else{
		$id 		= "0";
		$reference	=	"";
		$date = date("Y");
		$max="01";
		$reqm="SELECT * from  erp_fab_compteur_bc  where date='".$date ."'" ;
		$querym=mysql_query($reqm);
		$numc=mysql_num_rows($querym);
			if($numc>0){
				$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_bc  where date='".$date ."'";
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
			
			$reference= "BC_".$date."_".$max;		
	}

	if(isset($_GET['IDD'])){
		$idd = $_GET['IDD'];
	}else{
		$idd = "0";
	}

if(isset($_POST['enregistrer_mail'])){	


	$reference			=	addslashes($_POST["reference"]) ;
	$client				=	addslashes($_POST["client"]) ;
	$produit			=	addslashes($_POST["produit"]) ;
	$date_livraison		=	addslashes($_POST["date_livraison"]) ;
	$quantite			=	addslashes($_POST["quantite"]) ;	
	$remarque			=	addslashes($_POST["remarque"]) ;
	$date				=	addslashes($_POST["date"]) ;
	$dateheure			= 	date("Y-m-d H:i:s");	
	$prix_unitaire		=	addslashes($_POST["prix_unitaire"]) ;
	$prix_total			=	addslashes($_POST["prix_total"]) ;
	$idutilisateur		=	$_SESSION['erp_fab_IDUSER'] ;
	$annee				=	date('Y') ;
		
	if($id=="0")
		{		
			//Insertion entête
				$idbc="0";
				$reqMax="select max(id) as idbc from erp_fab_bc";
				$queryMax=mysql_query($reqMax);
				if(mysql_num_rows($queryMax)>0){
					while($enregMax=mysql_fetch_array($queryMax)){
						$idbc	=	$enregMax['idbc'] + 1;
					}
				} else{
						$idbc	=	"1";
				}
				$id=$idbc;
				$sql="INSERT INTO `erp_fab_bc`(`id`, `reference`, `client`, `date`, `statut`, `dateheure`, `idutilisateur`, `observation`) values 
				('".$idbc."','".$reference."','".$client."' ,'".$date."', '1' ,'".$dateheure."' ,'".$idutilisateur."','".$remarque."')";
				$req=mysql_query($sql);
			
				//Mise à jour compteur référence
				$date1 = date("Y");
				$max="";
				$reqm="SELECT * from  erp_fab_compteur_bc  where date='".$date1 ."'" ;
				$querym=mysql_query($reqm);
				$numc=mysql_num_rows($querym);
					if($numc>0){
						$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_bc  where date='".$date1 ."'";
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
					$sql="INSERT INTO `erp_fab_compteur_bc`(`date`, `compteur`, `iddoc`) VALUES ('".$date1."' ,'".$max."','".$idbc."')";
					$req=mysql_query($sql);	
					
					//Insertion détails
					$sql="INSERT INTO `erp_bc_det_bc`(`idbc`, `produit`, `date_livraison`, `prix_unitaire`, `quantite`, `prix_total`) VALUES";
					$sql=$sql."('".$idbc."' ,'".$produit."','".$date_livraison."','".$prix_unitaire."','".$quantite."','".$prix_total."') ";
					$req=mysql_query($sql);	
		}
	else{
			$idbc=$id;
			

			if($idd==0){
				//Insertion détails
					$sql="INSERT INTO `erp_bc_det_bc`(`idbc`, `produit`, `date_livraison`, `prix_unitaire`, `quantite`, `prix_total`) VALUES";
					$sql=$sql."('".$idbc."' ,'".$produit."','".$date_livraison."','".$prix_unitaire."','".$quantite."','".$prix_total."') ";
					$req=mysql_query($sql);														
			} else{
				//MAJ détails
				$sql="update erp_bc_det_bc set prix_unitaire='".$prix_unitaire."', quantite='".$quantite."', date_livraison='".$date_livraison."', prix_total='".$prix_total."'
				where id=".$idd;
				$req=mysql_query($sql);					
			}
						
		}

			//Mise à jour montant total de BC
				$total="0";
				$reqTot="select sum(prix_total) as total from erp_bc_det_bc where idbc=".$id;
				$queryTot=mysql_query($reqTot);
				while($enregTot=mysql_fetch_array($queryTot)){
					$total	=	$enregTot['total'];
				}
				
				$sql="UPDATE erp_fab_bc set montant='".$total."',observation='".$remarque."' where id=".$id;
				$req=mysql_query($sql);	
		
		

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="addedit_bc.php?ID='.$id.'&suc=1" </SCRIPT>';

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

	$req="select * from erp_bc_det_bc where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$produit			=	$enreg["produit"] ;
		$date_livraison		=	$enreg["date_livraison"] ;
		$type				=	$enreg["type"] ;
		$quantite			=	$enreg["quantite"] ;
		$prix_unitaire		=	$enreg["prix_unitaire"] ;
		$prix_total			=	$enreg["prix_total"] ;
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
										<input class="form-control" type="date" placeholder="Date" value="<?php echo $date; ?>" id="example-text-input" name="date" required>
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
									<div class="col-sm-3" id="divSF">
										<b>Liste des produits</b>
										<select class="form-control select2" name="produit" id="produit" required>
											<option value="">Sélectionner un produit</option>
											<?php
											$req0="select * from erp_fab_produits  where semi=1";
											$query0=mysql_query($req0);
											while($enreg0=mysql_fetch_array($query0)){	
											?>
											<option value="<?php echo $enreg0['id']; ?>" <?php if($enreg0['id']==$produit){ ?> selected <?php } ?>>
												<?php echo $enreg0['code'].' ('.$enreg0['designation'].')'; ?>
											</option>
											<?php } ?>																		
										</select>										
									</div>
																
									
									<div class="col-sm-2">
										<b>Prix unitaire (*)</b>	
										<input type="text" value="<?php echo $prix_unitaire; ?>" id="prix_unitaire" name="prix_unitaire" class="form-control" required>
									</div>																
									<div class="col-sm-2">
										<b>Quantité (*)</b>	
										<input type="number" value="<?php echo $quantite; ?>" id="quantite" name="quantite" class="form-control" required>
									</div>
									<div class="col-sm-2">
										<b>Prix total (*)</b>	
										<input type="text" value="<?php echo $prix_total; ?>" id="prix_total" name="prix_total" class="form-control" readonly>
									</div>	
									<div class="col-sm-2">
										<b>Date Livraison (*)</b>	
										<input type="date" value="<?php echo $date_livraison; ?>" id="date_livraison" name="date_livraison" class="form-control" required>
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
			
   		
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h3>Détail bon de commande</h3>			
								<br>
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th><b>Code - Désingation</b></th>
											<th><b>Prix unitaire</b></th>
											<th><b>Quantite</b></th>
											<th><b>Prix total</b></th>
											<th><b>Action</b></th>
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
	
	 $req="select * from erp_bc_det_bc where idbc=".$id." order by id desc ";
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
											<td><?php echo $sproduit; ?></td>
											 <td><?php echo number_format($enreg["prix_unitaire"],'2','.',''); ?></td>
											 <td><?php echo $qte; ?></td>
											 <td><?php echo number_format($enreg["prix_total"],'2','.',''); ?></td>
											 <td>
												<a href="addedit_bc.php?IDD=<?php echo $iddet; ?>&ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												<a href="Javascript:Supprimer('<?php echo $id; ?>','<?php echo $iddet; ?>')" class="btn btn-danger waves-effect waves-light" style="background-color:brown">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
											 </td>
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
 </div>

<?php include ("menu_footer/footer.php"); ?>
<script>
	$("#produit").on("change", function(){
		var iddet 	  = $("#produit").val();
		var idbc	  = <?php if(isset($_GET['ID'])){ echo $_GET['ID']; } else{ echo 0; }; ?>;
		$("#prix_unitaire").val(0);
		$("#quantite").val(0);
		$("#prix_total").val(0);		
		$("#date_livraison").val('');
		$.getJSON("page_json/json_detailproduitbc.php?ID="+iddet+"&idbc="+idbc, function (data, status) {
			if (status == "success") {		
				prix_unitaire	=	data.prix_unitaire;
				quantite		=	data.quantite;
				prix_total		=	data.prix_tot;
				date_livraison	=	data.date_livraison;
			}	
			$("#prix_unitaire").val(prix_unitaire);
			$("#quantite").val(quantite);
			$("#prix_total").val(prix_total);
			$("#date_livraison").val(date_livraison);
		});	
	});		

	$("#prix_unitaire").on("change", function(){
		var prix_unitaire = $("#prix_unitaire").val();
		var quantite = $("#quantite").val();
		var total = prix_unitaire * quantite;
		
		$("#prix_total").val(total);
	});
	$("#prix_unitaire").on("keyup", function(){
		var prix_unitaire = $("#prix_unitaire").val();
		var quantite = $("#quantite").val();
		var total = prix_unitaire * quantite;
		
		$("#prix_total").val(total);
	});	
	$("#prix_unitaire").on("keypres", function(){
		var prix_unitaire = $("#prix_unitaire").val();
		var quantite = $("#quantite").val();
		var total = prix_unitaire * quantite;
		
		$("#prix_total").val(total);
	});

	$("#quantite").on("change", function(){
		var prix_unitaire = $("#prix_unitaire").val();
		var quantite = $("#quantite").val();
		var total = prix_unitaire * quantite;
		
		$("#prix_total").val(total);
	});
	$("#quantite").on("keyup", function(){
		var prix_unitaire = $("#prix_unitaire").val();
		var quantite = $("#quantite").val();
		var total = prix_unitaire * quantite;
		
		$("#prix_total").val(total);
	});	
	$("#quantite").on("keypres", function(){
		var prix_unitaire = $("#prix_unitaire").val();
		var quantite = $("#quantite").val();
		var total = prix_unitaire * quantite;
		
		$("#prix_total").val(total);
	});		

</script>