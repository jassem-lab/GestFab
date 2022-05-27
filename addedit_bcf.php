<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Gestion des commandes fournisseur</h4>
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
				document.location.href="page_js/supprimerdet_bcf.php?IDD="+idd+"&ID="+id ;
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
		$reqm="SELECT * from  erp_fab_compteur_bcf  where date='".$date ."'" ;
		$querym=mysql_query($reqm);
		$numc=mysql_num_rows($querym);
			if($numc>0){
				$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_bcf  where date='".$date ."'";
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
			
			$reference= "BCF_".$date."_".$max;		
	}

	if(isset($_GET['IDD'])){
		$idd = $_GET['IDD'];
	}else{
		$idd = "0";
	}

if(isset($_POST['enregistrer_mail'])){	


	$reference			=	addslashes($_POST["reference"]) ;
	$fournisseur		=	1 ;
	if(isset($_POST["produit"])){
		$produit			=	addslashes($_POST["produit"]) ;
	} else{
		$produit			=	0 ;
	}
	if(isset($_POST["mp"])){
		$mp			=	addslashes($_POST["mp"]) ;
	} else{
		$mp			=	0 ;
	}	
	$quantite			=	addslashes($_POST["quantite"]) ;	
	$remarque			=	addslashes($_POST["remarque"]) ;
	$date				=	addslashes($_POST["date"]) ;
	$type				=	addslashes($_POST["type"]) ;
	$dateheure			= 	date("Y-m-d H:i:s");	
	$prix_unitaire		=	addslashes($_POST["prix_unitaire"]) ;
	$prix_total			=	addslashes($_POST["prix_total"]) ;
	$idutilisateur		=	$_SESSION['erp_fab_IDUSER'] ;
	$annee				=	date('Y') ;
		
	if($id=="0")
		{		
			//Insertion entête
				$idbc="0";
				$reqMax="select max(id) as idbc from erp_fab_bcf";
				$queryMax=mysql_query($reqMax);
				if(mysql_num_rows($queryMax)>0){
					while($enregMax=mysql_fetch_array($queryMax)){
						$idbc	=	$enregMax['idbc'] + 1;
					}
				} else{
						$idbc	=	"1";
				}
				$id=$idbc;
				$sql="INSERT INTO `erp_fab_bcf`(`id`, `reference`, `fournisseur`, `date`, `statut`, `dateheure`, `idutilisateur`, `observation`) values 
				('".$idbc."','".$reference."','".$fournisseur."' ,'".$date."', '1' ,'".$dateheure."' ,'".$idutilisateur."','".$remarque."')";
				$req=mysql_query($sql);
			
				//Mise à jour compteur référence
				$date1 = date("Y");
				$max="";
				$reqm="SELECT * from  erp_fab_compteur_bcf  where date='".$date1 ."'" ;
				$querym=mysql_query($reqm);
				$numc=mysql_num_rows($querym);
					if($numc>0){
						$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_bcf  where date='".$date1 ."'";
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
					$sql="INSERT INTO `erp_fab_compteur_bcf`(`date`, `compteur`, `iddoc`) VALUES ('".$date1."' ,'".$max."','".$idbc."')";
					$req=mysql_query($sql);	
					
					//Insertion détails
					if($type==1){ //Commander des semi-finis
						$sql="INSERT INTO `erp_bc_det_bcf`(`idbc`, `produit`, `prix_unitaire`, `quantite`, `prix_total`, `type`) VALUES";
						$sql=$sql."('".$idbc."' ,'".$produit."','".$prix_unitaire."','".$quantite."','".$prix_total."','".$type."') ";
					} else{
						$sql="INSERT INTO `erp_bc_det_bcf`(`idbc`, `mp`, `prix_unitaire`, `quantite`, `prix_total`, `type`) VALUES";
						$sql=$sql."('".$idbc."' ,'".$mp."','".$prix_unitaire."','".$quantite."','".$prix_total."','".$type."') ";						
					}
					$req=mysql_query($sql);	
		}
	else{
			$idbc=$id;
			

			if($idd==0){
				//Insertion détails
				if($type==1){ //Commander des semi-finis
					$sql="INSERT INTO `erp_bc_det_bcf`(`idbc`, `produit`, `prix_unitaire`, `quantite`, `prix_total`, `type`) VALUES";
					$sql=$sql."('".$idbc."' ,'".$produit."','".$prix_unitaire."','".$quantite."','".$prix_total."','".$type."') ";
				} else{
					$sql="INSERT INTO `erp_bc_det_bcf`(`idbc`, `mp`, `prix_unitaire`, `quantite`, `prix_total`, `type`) VALUES";
					$sql=$sql."('".$idbc."' ,'".$mp."','".$prix_unitaire."','".$quantite."','".$prix_total."','".$type."') ";						
				}
				$req=mysql_query($sql);									
			} else{
				//MAJ détails
				$sql="update erp_bc_det_bcf set prix_unitaire='".$prix_unitaire."', quantite='".$quantite."', prix_total='".$prix_total."'
				where id=".$idd;
				$req=mysql_query($sql);					
			}
						
		}
		
			//Mise à jour montant total de BC
				$total="0";
				$reqTot="select sum(prix_total) as total from erp_bc_det_bcf where idbc=".$id;
				$queryTot=mysql_query($reqTot);
				while($enregTot=mysql_fetch_array($queryTot)){
					$total	=	$enregTot['total'];
				}
				
				$sql="UPDATE erp_fab_bcf set montant='".$total."',observation='".$remarque."' where id=".$id;
				$req=mysql_query($sql);	
		
		

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="addedit_bcf.php?ID='.$id.'&suc=1" </SCRIPT>';

}
	$fournisseur		=	"1";
	$remarque			=	"";
	$produit			=	"0";
	$mp					=	"0";
	$prix_unitaire		=	"0";
	$prix_total			=	"0";
	$quantite			=	"1";
	$type				=	0;
	$date				=	date("Y-m-d");
	
	$req="select * from erp_fab_bcf where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$fournisseur		=	$enreg["fournisseur"] ;
		$date				=	$enreg["date"] ;
		$reference			=	$enreg["reference"] ;
		$remarque			=	$enreg["observation"] ;
	}

	$req="select * from erp_bc_det_bcf where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$produit			=	$enreg["produit"] ;
		$mp					=	$enreg["mp"] ;
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
							<a href="gest_bcf.php" class="btn btn-primary waves-effect waves-light">Retour</a> 
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
									<div class="col-sm-5">	
										<b>Observation</b>
										<textarea class="form-control" id="remarque" name="remarque"><?php echo $remarque; ?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-3">
										<b>Produit SF ou MP</b>
										<select name="type" id="type" class="form-control" required>
											<option value="">Séléctionner une option</option>
											<option value="1" <?php if($type==1){ ?> selected <?php } ?>>Produit semi-finis</option>
											<option value="2" <?php if($type==2){ ?> selected <?php } ?>>Matières premières </option>
										</select>
									</div>
									
									<div class="col-sm-3" id="divSF" <?php if($type<>1){ ?> style="display:none" <?php } ?>>
										<b>Liste des produits SF</b>
										<select class="form-control select2" name="produit" id="produit">
											<?php
											$req0="select * from erp_fab_produits  where id=".$produit;
											$query0=mysql_query($req0);
											while($enreg0=mysql_fetch_array($query0)){	
											?>
											<option value="<?php echo $enreg0['id']; ?>" <?php if($enreg0['id']==$produit){ ?> selected <?php } ?>>
												<?php echo $enreg0['code']; ?>
											</option>
											<?php } ?>																		
										</select>										
									</div>
									<div class="col-sm-3" id="divMP" <?php if($type<>2){ ?> style="display:none" <?php } ?>>
										<b>Liste des MPs</b>
										<select class="form-control select2" name="mp" id="mp">
											<?php
											$req0="select * from erp_fab_mp where id=".$mp;
											$query0=mysql_query($req0);
											while($enreg0=mysql_fetch_array($query0)){	
											?>
											<option value="<?php echo $enreg0['id']; ?>" <?php if($enreg0['id']==$mp){ ?> selected <?php } ?>>
												<?php echo $enreg0['code']; ?>
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
											<th><b>Type</b></th>
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
	
	 $req="select * from erp_bc_det_bcf where idbc=".$id." order by id desc ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$iddet				=	$enreg["id"] ;	
		$qte				=	$enreg["quantite"] ;
		$type				=	"" ;
		
		if($enreg['type']==1){
			$type 	=	'Produit SF';
		} else{
			$type 	=	'Matières premières ';
		}

		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enreg["produit"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}
		
		$mp					=	"";
		$reqfm="select * from erp_fab_mp where id=".$enreg["mp"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$mp		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}		
	?>
										<tr>
											<td><?php echo $type; ?></td>
											<?php if($enreg['type']==1){ ?>
												<td><?php echo $sproduit; ?></td>
											<?php }else{ ?>
												<td><?php echo $mp; ?></td>
											<?php } ?>
											 <td><?php echo number_format($enreg["prix_unitaire"],'2','.',''); ?></td>
											 <td><?php echo $qte; ?></td>
											 <td><?php echo number_format($enreg["prix_total"],'2','.',''); ?></td>
											 <td>
												<a href="addedit_bcf.php?IDD=<?php echo $iddet; ?>&ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">
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
	$("#type").on("change", function(){
		var type = $("#type").val();
		var id = <?php if(isset($_GET['ID'])){ echo $_GET['ID']; } else{ echo 0 ;} ?>;
		if(type==""){
			$('#divSF').hide();
			$('#divMP').hide();
		}else if(type==1){	
			$('#divMP').hide();		
			if (window.XMLHttpRequest)
			{
			  xmlhttp_listeproduitsf=new XMLHttpRequest();
			}else{
			  xmlhttp_listeproduitsf=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_listeproduitsf.onreadystatechange=function(){
				
				if(xmlhttp_listeproduitsf.status==200 && xmlhttp_listeproduitsf.readyState==4){
					
					$('#divSF').html(xmlhttp_listeproduitsf.responseText);
				}	
			}
			xmlhttp_listeproduitsf.open("POST","page_json/json_select_bcf_produitsf.php",true);
			xmlhttp_listeproduitsf.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_listeproduitsf.send("type="+type+"&id="+id);			
			$('#divSF').show();
		} else{
			$('#divSF').hide();	
			if (window.XMLHttpRequest)
			{
			  xmlhttp_listeproduitmp=new XMLHttpRequest();
			}else{
			  xmlhttp_listeproduitmp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_listeproduitmp.onreadystatechange=function(){
				
				if(xmlhttp_listeproduitmp.status==200 && xmlhttp_listeproduitmp.readyState==4){
					
					$('#divMP').html(xmlhttp_listeproduitmp.responseText);
				}	
			}
			xmlhttp_listeproduitmp.open("POST","page_json/json_select_bcf_mps.php",true);
			xmlhttp_listeproduitmp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_listeproduitmp.send("type="+type+"&id="+id);			
			$('#divMP').show();			
		}
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