<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Gestion des produits finis</h4>
				<br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
			</div>
		</div>
	</div>
  </div>
  <script>
		function Supprimer(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/supprimersf.php?ID="+id ;
			}			    
	  }	
	function Archiver(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/archiversf.php?ID="+id ;
			}			    
	  }		  
	function Unarchiver(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/unarchiversf.php?ID="+id ;
			}			    
	  }	
  </script>
 <?php

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
	}else{
		$id = "0";
	}


if(isset($_POST['enregistrer_mail'])){	


	$code				=	addslashes($_POST["code"]) ;
	$code_barre			=	addslashes($_POST["code_barre"]) ;
	$designation		=	addslashes($_POST["designation"]) ;
	$prix				=	addslashes($_POST["prix"]) ;
	$type				=	addslashes($_POST["type"]) ;
	
	if($id=="0")
		{
			//Vérification de code
			$req="select * from erp_fab_produits where semi=0 and code='".$code."'";
			$query=mysql_query($req);
			if(mysql_num_rows($query)>0){
				echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?err=1" </SCRIPT>';
				exit;
			}
			
			 $sql="INSERT INTO `erp_fab_produits`(`code`, `code_barre`, `designation`, `prix`, `semi`, `type`) VALUES
			 ('".$code."','".$code_barre."' ,'".$designation."' ,'".$prix."' ,'1' ,'".$type."' )";
		}
	else{
			$sql="UPDATE `erp_fab_produits` SET `code`='".$code."',`code_barre`='".$code_barre."',
			`designation`='".$designation."', `prix`='".$prix."' , `type`='".$type."'  WHERE id=".$id;
			
		}
		$requete=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$code				=	"" ;
	$code_barre			=	"" ;	
	$designation		=	"" ;		
	$prix				=	"0" ;
	$type				=	"" ;	
	$req="select * from erp_fab_produits where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$prix				=	$enreg["prix"] ;
		$type				=	$enreg["type"] ;
	}
	
	?> 
  <div class="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<?php if(isset($_GET['suc'])){ ?>
								<?php if($_GET['suc']=='1'){ ?>
								<font color="green" style="background-color:#FFFFFF;"><center>Enregistrement effectué avec succès</center></font><br /><br />
							<?php } }?>		
							<?php if(isset($_GET['err'])){ ?>
								<?php if($_GET['err']=='1'){ ?>
								<font color="red" style="background-color:#FFFFFF;"><center>Ce code a déjà été utilisé</center></font><br /><br />
							<?php } }?>								
							<form action="" method="POST">    
								<div class="form-group row">
									<div class="col-sm-3">
									<b>Code (*)</b>
										<input class="form-control" type="text" placeholder="Code Interne" value="<?php echo $code; ?>" id="example-text-input" name="code" required>
									</div>										
									<div class="col-sm-3">
									<b>Désignation (*)</b>
										<input class="form-control" type="text"  placeholder="Désignation" value="<?php echo $designation; ?>" id="example-text-input" name="designation" required>
									</div>
									<div class="col-sm-2">
									<b>Code à barre</b>
										<input class="form-control"  type="text"  placeholder="Code à barre" value="<?php echo $code_barre; ?>" id="example-text-input" name="code_barre" >
									</div>		
									<div class="col-sm-2">
									<b>Px vente par défaut</b>
										<input class="form-control"  type="number"  placeholder="Prix vente" value="<?php echo $prix; ?>" id="example-text-input" name="prix" >
									</div>										
									<div class="col-sm-2">
									<b>Type d'emballage </b>
										<select name="type" id="type" class="form-control" >
											<option value="">Sélectionner le type d'emballage</option>
											<option value="0">Emballage par pièce </option>
											<option value="1">Emballage par séparation  </option>
										</select>
									</div>		
																	
								</div>

								<div class="form-group m-b-0">
									<div>
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
			
			
<?php
$reqCode="";
$code="";
if(isset($_POST['code'])){
	if(($_POST['code'])<>""){
		$code			=	$_POST['code'];
		$reqCode		=	" and  id=".$code;
	}
}

$reqProven="";
$prov="";
if(isset($_POST['prov'])){
	if(($_POST['prov'])<>""){
		$prov			=	$_POST['prov'];
		$reqProven		=	" and  provenance=".$prov;
	}
}
?>	        		
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h3>Liste des produits PF</h3>			
								<form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
									<div class="col-xl-12">
										<div class="row">
											<div class="col-xl-3">
											<b>Liste des codes</b>
											<select class="form-control select2" name="code">
												<option value=""> Sélectionner un code </option>
												<?php
												$req="select * from erp_fab_produits where semi=1 order by code";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($code==$enreg['id']) {?> selected <?php } ?>><?php echo $enreg['code']; ?></option>
												<?php } ?>
											</select>
											</div>
											<div class="col-xl-3">
											<b>Liste des provenances</b>
											<select class="form-control select2" name="prov">
												<option value=""> Sélectionner une provenance </option>
												<?php
												$req="select * from erp_fab_classe order by classe";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($prov==$enreg['id']) {?> selected <?php } ?>><?php echo $enreg['classe']; ?></option>
												<?php } ?>
											</select>
											</div>											
											<div class="col-xl-2">
												<form name="SubmitContact" class="" method="post" action="">
																<b>Affichage par</b>
																<select class="form-control select2" name="limit-records" id="limit-records">
																	<option value="20" <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==20){ ?> selected <?php }} ?>>20 produits</option>	
																	<option value="50" <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==50){ ?> selected <?php }} ?>>50 produits</option>	
																	<option value="100" <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==100){ ?> selected <?php }} ?>>100 produits</option>
																</select>	
												</form>	
											</div>	
											<div class="col-xl-4">
											  <b></b><br>
												<input name="SubmitContact" type="submit" id="submit" class="btn btn-primary btn-sm " value="Filtrer">
														
											</div>											
											<div class="col-xl-8">
											  <b></b><br>
												<a href="modele_nomenclature_pf.php" class="btn btn-primary waves-effect waves-light" style="background-color: orange">Modèle Nomenclature Viérge </a> 		
												<a href="nomenclature_pf_sf.php" class="btn btn-primary waves-effect waves-light" style="background-color: blue">Mise à jours Nomenclature  </a> 		
											</div>
																					
										</div>	
									</div>
								</form>
								<br>
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th><b>#</b></th>
                                            <th><b>Code</b></th>
                                            <th><b>Désignation</b></th>
											<th><b>Code à barre</b></th>
											<th><b>Prix de vente</b></th>
											<th><b>Type d'emballage</b></th>
											<th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
	$req="select * from erp_fab_produits where semi=1 ".$reqCode.$reqProven." order by code";
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


	$code				=	"" ;
	$code_barre			=	"" ;	
	$designation		=	"" ;		
	$prix				=	"0" ;
	$type				=	"" ;	
	$i					=	0;
	$req="select * from erp_fab_produits where semi=1 ".$reqCode.$reqProven." order by code  LIMIT $start, $limit" ;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$prix				=	$enreg["prix"] ;
		
		if($enreg["type"==0]){
			$type				=	'Emballage par pièce';
		} else{
			$type				=	'Emballage par séparation';
		}
		$i++;
		
		$nomenclature = 0;
		$reqcom="select * from erp_fab_nomenclature_pf where idproduit=".$id." and idsemi>0";
		$querycom=mysql_query($reqcom);
		$nomenclature=mysql_num_rows($querycom);	
	
		$nm=0;
		$reqcom="select * from erp_fab_nomenclature_emballage where idproduit=".$id;
		$querycom=mysql_query($reqcom);
		$nm=mysql_num_rows($querycom);			
	
	?>
										<tr>
											 <td><?php echo $i; ?></td>
											 <td><?php echo $code; ?></td>
											 <td><?php echo $designation; ?></td>
											 <td><?php echo $code_barre; ?></td>
											 <td><?php echo $prix; ?></td>
											 <td><?php echo $type; ?></td>
											 <td>
												<a href="gest_pf.php?ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">Modifier</a>
											<?php if($enreg['archive']==0){ ?>
											<a href="Javascript:Archiver('<?php echo $id; ?>')"class="btn btn-danger waves-effect waves-light" style="background-color:red">Archiver</a>	
											<?php } else{ ?>
											<a href="Javascript:Unarchiver('<?php echo $id; ?>')"class="btn btn-danger waves-effect waves-light" style="background-color:green">Unarchiver</a>													
											<?php } ?>
											<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
													data-target=".bs-example-modal-lg<?php echo $enreg['id']; ?>" id="<?php echo $enreg['id']; ?>">
													Nomenclature SF(<?php echo $nomenclature; ?>)
											</button>
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg<?php echo $enreg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"><?php echo $code; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                           
														   <div class="col-md-12 row">
																<div class="col-md-5" id="selectMP<?php echo $enreg['id']; ?>">
																	
																</div>
																<div class="col-md-3">
																	<b>Quantité (par unité)</b>
																	<input id="qte<?php echo $enreg['id']; ?>" name="qte<?php echo $enreg['id']; ?>" class="form-control" >
																</div>
																<div class="col-md-3">
																	<br>
																	<input type="button" id="<?php echo $enreg['id']; ?>" value="Enregistrer" class="btn btn-primary btn-sm btnmp" >
																</div>															
														   </div>
														   
														   <div class="col-md-12 row" style="margin-top:20px" id="listeMP<?php echo $enreg['id']; ?>" >
	
														   </div>
														   
														   
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->	

												<button type="button" class="btn_1 btn-primary waves-effect waves-light" data-toggle="modal" 
														data-target=".bs-example-modal-lg1<?php echo $enreg['id']; ?>" id="<?php echo $enreg['id']; ?>">
														Nomenclature Emballage (<?php echo $nm; ?>)
												</button>												
												<!--  Modal content for the above example -->
												<div class="modal fade bs-example-modal-lg1<?php echo $enreg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title mt-0" id="myLargeModalLabel"><?php echo $code; ?></h5>
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
															</div>
															<div class="modal-body">
															   
															   <div class="col-md-12 row">
																	<div class="col-md-5">
																		<b>Liste des MPs emballage</b>
																		<select class="form-control select2" id="selectMP1<?php echo $enreg['id']; ?>">
																			<option value="0">Sélectionner un MP</option>
																			<?php
																			$reqnom="select * from erp_fab_mp_emballage where not exists(
																			select * from erp_fab_nomenclature_emballage where erp_fab_nomenclature_emballage.idmp=erp_fab_mp_emballage.id and idproduit=".$id.")";
																			$querynom=mysql_query($reqnom);
																			while($enregnom=mysql_fetch_array($querynom)){
																			?>
																				<option value="<?php echo $enregnom['id']; ?>">
																					<?php echo $enregnom['code']; ?>
																				</option>
																			<?php } ?>
																		</select>
																	</div>
																	<div class="col-md-3">
																		<br>
																		<input type="button" id="<?php echo $enreg['id']; ?>" value="Enregistrer" class="btn btn-primary btn-sm btnmp_1" >
																	</div>															
															   </div>
															   
															   <div class="col-md-12 row" style="margin-top:20px" id="listeMP1<?php echo $enreg['id']; ?>" >
		
															   </div>
															   
															   
															</div>
														</div><!-- /.modal-content -->
													</div><!-- /.modal-dialog -->
												</div><!-- /.modal -->								
											
										 </td>
										</tr>
	<?php } ?>
                                        </tbody>
                                    </table>								
						</div> 
									<nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="gest_pf.php?page=<?php echo $Previous; ?>&limit=<?php echo $limit;?>">Précédente</a></li>
											<?php 
												for($i=1;$i<=$page;$i++){
											?>
                                            <li class="page-item"><a class="page-link" href="gest_pf.php?page=<?php echo $i; ?>&limit=<?php echo $limit;?>"><?php echo $i; ?></a></li>
												<?php } ?>
                                            <li class="page-item"><a class="page-link" href="gest_pf.php?page=<?php echo $Next; ?>&limit=<?php echo $limit;?>">Suivant</a></li>
                                        </ul>
                                    </nav>								
					</div> 
					
				</div> 
			</div> 	
			
			
		 </div> 
  </div>
 </div>

<?php include ("menu_footer/footer.php"); ?>
<script>
	$(".btn").on("click", function(){
		var idproduit	= $(this).attr('id');
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps.onreadystatechange=function(){
			
			if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
				
				$('#listeMP'+idproduit).html(xmlhttp_listemps.responseText);
			}	
		}
		xmlhttp_listemps.open("POST","page_json/json_liste_sf.php",true);
		xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps.send("idproduit="+idproduit);

		//Refraiche la liste des MPs
			if (window.XMLHttpRequest)
			{
			  xmlhttp_selectmps=new XMLHttpRequest();
			}else{
			  xmlhttp_selectmps=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_selectmps.onreadystatechange=function(){
				
				if(xmlhttp_selectmps.status==200 && xmlhttp_selectmps.readyState==4){
					
					$('#selectMP'+idproduit).html(xmlhttp_selectmps.responseText);
				}	
			}
			xmlhttp_selectmps.open("POST","page_json/json_selectsf.php",true);
			xmlhttp_selectmps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_selectmps.send("idproduit="+idproduit);	
		//Fin refraiche liste des MPs
	});	

	$(".btnmp").on("click", function(){
		var idproduit	= $(this).attr('id');
		var mp			= $("#sf"+idproduit).val();
		var qte			= $("#qte"+idproduit).val();
				
		if(mp=="0"){
			alert("Sélectionner un produit semi finis SVP !");
			return false;
		}
		
		if(qte==""){
			alert("Saisir la quantité SVP !");
			return false;
		}		
		
		var variable="idproduit="+idproduit+"&mp="+mp+"&qte="+qte;
		$.post("page_ajax/ajax_nomenclature_pf.php", variable, function (data, status) {
			if (status == "success") {	
					if (window.XMLHttpRequest)
					{
					  xmlhttp_selectmps11=new XMLHttpRequest();
					}else{
					  xmlhttp_selectmps11=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_selectmps11.onreadystatechange=function(){
						
						if(xmlhttp_selectmps11.status==200 && xmlhttp_selectmps11.readyState==4){
							
							$('#listeMP'+idproduit).html(xmlhttp_selectmps11.responseText);
						}	
					}
					xmlhttp_selectmps11.open("POST","page_json/json_liste_sf.php",true);
					xmlhttp_selectmps11.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_selectmps11.send("idproduit="+idproduit+"&idproduit="+idproduit);	
					
					//Refraiche la liste des MPs
						if (window.XMLHttpRequest)
						{
						  xmlhttp_selectmps1=new XMLHttpRequest();
						}else{
						  xmlhttp_selectmps1=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_selectmps1.onreadystatechange=function(){
							
							if(xmlhttp_selectmps1.status==200 && xmlhttp_selectmps1.readyState==4){
								
								$('#selectMP'+idproduit).html(xmlhttp_selectmps1.responseText);
							}	
						}
						xmlhttp_selectmps1.open("POST","page_json/json_selectsf.php",true);
						xmlhttp_selectmps1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_selectmps1.send("idproduit="+idproduit+"&idproduit="+idproduit);	
					//Fin refraiche liste des MPs					

					$('#qte'+idproduit).val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
	});	
	
	
	
	$(".btn1").on("click", function(){
		var idproduit	= $(this).attr('id');
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps1=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps1=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps1.onreadystatechange=function(){
			
			if(xmlhttp_listemps1.status==200 && xmlhttp_listemps1.readyState==4){
				
				$('#listeMP1'+idproduit).html(xmlhttp_listemps1.responseText);
			}	
		}
		xmlhttp_listemps1.open("POST","page_json/json_liste_mp_pf.php",true);
		xmlhttp_listemps1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps1.send("idproduit="+idproduit);

		//Refraiche la liste des MPs
			if (window.XMLHttpRequest)
			{
			  xmlhttp_selectmps2=new XMLHttpRequest();
			}else{
			  xmlhttp_selectmps2=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_selectmps2.onreadystatechange=function(){
				
				if(xmlhttp_selectmps2.status==200 && xmlhttp_selectmps2.readyState==4){
					
					$('#selectMP1'+idproduit).html(xmlhttp_selectmps2.responseText);
				}	
			}
			xmlhttp_selectmps2.open("POST","page_json/json_selectmp_pf.php",true);
			xmlhttp_selectmps2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_selectmps2.send("idproduit="+idproduit);	
		//Fin refraiche liste des MPs
	});	

	$(".btnmp1").on("click", function(){
		var idproduit	= $(this).attr('id');
		var mp			= $("#mp"+idproduit).val();
		var qte			= $("#qte1"+idproduit).val();
				
		if(mp=="0"){
			alert("Sélectionner un produit semi finis SVP !");
			return false;
		}
		
		if(qte==""){
			alert("Saisir la quantité SVP !");
			return false;
		}		
		
		var variable="idproduit="+idproduit+"&mp="+mp+"&qte="+qte;
		$.post("page_ajax/ajax_nomenclature_pf1.php", variable, function (data, status) {
			if (status == "success") {	
					if (window.XMLHttpRequest)
					{
					  xmlhttp_selectmps111=new XMLHttpRequest();
					}else{
					  xmlhttp_selectmps111=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_selectmps111.onreadystatechange=function(){
						
						if(xmlhttp_selectmps111.status==200 && xmlhttp_selectmps111.readyState==4){
							
							$('#listeMP1'+idproduit).html(xmlhttp_selectmps111.responseText);
						}	
					}
					xmlhttp_selectmps111.open("POST","page_json/json_liste_mp_pf.php",true);
					xmlhttp_selectmps111.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_selectmps111.send("idproduit="+idproduit+"&idproduit="+idproduit);	
					
					//Refraiche la liste des MPs
						if (window.XMLHttpRequest)
						{
						  xmlhttp_selectmps100=new XMLHttpRequest();
						}else{
						  xmlhttp_selectmps100=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_selectmps100.onreadystatechange=function(){
							
							if(xmlhttp_selectmps100.status==200 && xmlhttp_selectmps100.readyState==4){
								
								$('#selectMP1'+idproduit).html(xmlhttp_selectmps100.responseText);
							}	
						}
						xmlhttp_selectmps100.open("POST","page_json/json_selectmp_pf.php",true);
						xmlhttp_selectmps100.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_selectmps100.send("idproduit="+idproduit+"&idproduit="+idproduit);	
					//Fin refraiche liste des MPs					

					$('#qte'+idproduit).val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
	});		
	
	$(".btn_1").on("click", function(){
		var idproduit	= $(this).attr('id');
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps.onreadystatechange=function(){
			
			if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
				
				$('#listeMP1'+idproduit).html(xmlhttp_listemps.responseText);
			}	
		}
		xmlhttp_listemps.open("POST","page_json/json_liste_mpsemballagePF.php",true);
		xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps.send("idproduit="+idproduit);

	});	
	$(".btnmp_1").on("click", function(){
		var idproduit	= $(this).attr('id');
		var mp			= $("#selectMP1"+idproduit).val();
		var qte			= 1;
				
		if(mp=="0"){
			alert("Sélectionner une matière première SVP !");
			return false;
		}
		
		if(qte==""){
			alert("Saisir la quantité SVP !");
			return false;
		}		
		
		var variable="idproduit="+idproduit+"&mp="+mp+"&qte="+qte;
		$.post("page_ajax/ajax_nomenclature_mpemballagePF.php", variable, function (data, status) {
			if (status == "success") {	
					if (window.XMLHttpRequest)
					{
					  xmlhttp_selectmps101=new XMLHttpRequest();
					}else{
					  xmlhttp_selectmps101=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_selectmps101.onreadystatechange=function(){
						
						if(xmlhttp_selectmps101.status==200 && xmlhttp_selectmps101.readyState==4){
							
							$('#listeMP1'+idproduit).html(xmlhttp_selectmps101.responseText);
						}	
					}
					xmlhttp_selectmps101.open("POST","page_json/json_liste_mpsemballagePF.php",true);
					xmlhttp_selectmps101.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_selectmps101.send("idproduit="+idproduit);			

					$('#qte'+idsf).val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
	});	
	
	
	
	
</script>