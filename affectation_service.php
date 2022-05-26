<?php include ("menu_footer/menu.php"); ?>
<div class="wrapper">
    <script>
    function Supprimer(id,idd) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimer_affectation.php?IDP="+id+"&ID="+idd;
        }
    }
    </script>
    <?php
	$produit="";
	$reqprd="select * from erp_fab_produits where id=".$_GET['IDP'];
	$queryprd=mysql_query($reqprd);
	while($enregprd=mysql_fetch_array($queryprd)){
		$produit		=	$enregprd['id'];
		$codeProduit	=	$enregprd['code'];
	}
	?>
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Afféctation de service au produit <b style="color:#ffc107">"
                            <?php echo $codeProduit; ?> "</b></h4>
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

		$idproduit		 	=	$_GET['IDP'];
		$service			=	addslashes($_POST["service"]) ;
		$idservice 			=	addslashes($_POST["service"]) ;
		$temps_execution 	=	addslashes($_POST["temps_execution"]) ;
		$couleur		 	=	addslashes($_POST["couleur"]) ;
		$cliche			 	=	addslashes($_POST["cliche"]) ;
		$jig			 	=	addslashes($_POST["jig"]) ;
		$poids_net		 	=	addslashes($_POST["poids_net"]) ;
		$poids_brute	 	=	addslashes($_POST["poids_brute"]) ;
		$box_qty			=	addslashes($_POST["box_qty"]) ;
		$cavity				=	addslashes($_POST["cavity"]) ;		
		$moule				=	addslashes($_POST["moule"]) ;	

		if($id==0){
			$sql="INSERT INTO `erp_fab_produits_service`(`idproduit`, `idservice`, `temps_execution`, `couleur`, `cliche`, `jig`, `moule`, `box_qty`, `poids_net`, `poids_brute`, `cavity`) VALUES 
			('".$idproduit."','".$idservice."','".$temps_execution."','".$couleur."','".$cliche."','".$jig."','".$moule."','".$box_qty."','".$poids_net."','".$poids_brute."','".$cavity."')";			
			$req=mysql_query($sql);
		} else{
			$sql="UPDATE erp_fab_produits_service set temps_execution=".$temps_execution.", couleur=".$couleur.", cliche=".$cliche.", jig=".$jig.", moule=".$moule.", box_qty=".$box_qty.", poids_net=".$poids_net.", poids_brute=".$poids_brute.", cavity=".$cavity." where id=".$id;
			$req=mysql_query($sql);
		}
			echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?IDP='.$_GET['IDP'].'&suc=1" </SCRIPT>';
	}	
	
	
	
	
	
		$service 			=	0;
		$temps_execution 	=	0;
		$couleur		 	=	0;
		$cliche			 	=	'';
		$jig			 	=	'';
		$poids_net		 	=	'';
		$poids_brute	 	=	0;
		$cavity			 	=	0;
		$box_qty			=	"";
		$cavity				=	0;
		$moule				=	0;
		$req="select * from erp_fab_produits_service where idproduit=".$_GET['IDP']." and id=".$id;
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

		}
		$pourcentage_brute	=	'';
		$req="select * from erp_fab_parametre";
		$query=mysql_query($req);
		while($enreg=mysql_fetch_array($query)){
			$pourcentage_brute = $enreg['pourcentage_brute'];
		}
	?>
	
	

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <a href="gest_sf.php" class="btn btn-primary waves-effect waves-light">Retour</a>
                            <div class="col-md-12 row">
							<?php if(isset($_GET['suc'])){ ?>
								<?php if($_GET['suc']=='1'){ ?>
								<font color="green" style="background-color:#FFFFFF;"><center>Enregistrement effectué avec succès</center></font><br /><br />
							<?php } }?>		
							
							<form action="" method="POST">    
								<div class="form-group row">
									<div class="col-sm-2">
									<b>Type de service </b>
										<select name="service" id="service" class="form-control" >
											<option value="">Sélectionner un service</option>
											<?php
											if($service>0){
												$req="select * from	erp_fab_service where id=".$service;
											} else{
												$req="select * from	erp_fab_service where not exists(select * from erp_fab_produits_service where erp_fab_produits_service.idservice=erp_fab_service.id and idproduit=".$_GET['IDP'].")";
											}
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($service==$enreg['id']){ ?> selected <?php } ?>>
													<?php echo $enreg['service']; ?>
												</option>
											<?php } ?>
										</select>
									</div>									
									<div class="col-sm-2">
									<b>Temps d'éxection (Comp) (*)</b>
										<input class="form-control" type="number" placeholder="Temps d'éxection (Comp)" value="<?php echo $temps_execution; ?>" id="example-text-input" name="temps_execution" required>
									</div>										
									<div class="col-sm-2">
									<b>Couleur (Color)</b>
										<select name="couleur" id="couleur" class="form-control" >
											<option value="">Sélectionner un couleur</option>
											<?php
											$req="select * from	erp_fab_couleurs order by couleur";
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($couleur==$enreg['id']){ ?> selected <?php } ?>>
													<?php echo $enreg['couleur'].'-'.$enreg['designation']; ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-2">
									<b>Cliché (Cliche)</b>
										<select name="cliche" id="cliche" class="form-control" >
											<option value="">Sélectionner une cliche</option>
											<?php
											$req="select * from	erp_fab_cliches order by cliche";
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($cliche==$enreg['id']){ ?> selected <?php } ?>>
													<?php echo $enreg['cliche']; ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-2">
									<b>Box Qty (*)</b>
										<input class="form-control" type="number" placeholder="Box Qty" value="<?php echo $box_qty; ?>" id="example-text-input" name="box_qty" >
									</div>										
									<div class="col-sm-2">
									<b>Jig (Gigue)</b>
										<select name="jig" id="jig" class="form-control" >
											<option value="">Sélectionner jig</option>
											<?php
											$req="select * from	erp_fab_jig order by jig";
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($jig==$enreg['id']){ ?> selected <?php } ?>>
													<?php echo $enreg['jig']; ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-2">
									<b>Moule (Mold)</b>
										<select name="moule" id="moule" class="form-control" >
											<option value="">Sélectionner un Moule</option>
											<?php
											$req="select * from	erp_fab_moules order by moule";
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($moule==$enreg['id']){ ?> selected <?php } ?>>
													<?php echo $enreg['moule']; ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-2">
									<b>Poids Net(Net Weight) (*)</b>
										<input class="form-control" type="number" step="0.1" placeholder="Net Weight" value="<?php echo $poids_net; ?>" id="poids_net" name="poids_net" required>
										<input type="hidden" id="pourcentage_brute" name="pourcentage_brute" value="<?php echo $pourcentage_brute; ?>">
									</div>									
									<div class="col-sm-2">
									<b>Poids brute(Gross Weight) (*)</b>
										<input class="form-control" type="number"  step="0.1" placeholder="Gross Weight" value="<?php echo $poids_brute; ?>" id="poids_brute" name="poids_brute" readonly>
									</div>									
									<div class="col-sm-2">
									<b>Cavity (Cavité) (*)</b>
										<input class="form-control" type="number" placeholder="cavity" value="<?php echo $cavity; ?>" id="cavity" name="cavity" required>
									</div>										
									
                                    <div class="col-sm-3"><br>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Enregistrer
                                        </button>
                                        <input class="form-control" type="hidden" name="enregistrer_mail">
                                    </div>									
								</div>
                        </div>
                    </div>
                </div>
             </div>
		</div>
		
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Liste des services pour le produit <?php echo $codeProduit; ?></h3>
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
	$req="select * from erp_fab_produits_service where idproduit=".$_GET['IDP'];
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
		
		$nomenclature = 0;
		$reqcom="select * from erp_fab_nomenclature where idproduit=".$_GET['IDP']." and idservice=".$enreg['idservice'];
		$querycom=mysql_query($reqcom);
		$nomenclature=mysql_num_rows($querycom);
	?>
                                    <tr>
                                        <td><?php echo $service; ?></td>
										<td><?php echo $temps_execution; ?></td>
										<td><?php echo $couleur; ?></td>
										<td><?php echo $cliche; ?></td>
										<td><?php echo $box_qty; ?></td>
										<td><?php echo $jig; ?></td>
										<td><?php echo $moule; ?></td>
										<td><?php echo $poids_net; ?></td>
										<td><?php echo $poids_brute; ?></td>
                                        <td><?php echo $cavity; ?></td>
										
										
                                        <?php if($_SESSION['erp_fab_PROFIL']==1){ ?>
                                        <td>
                                            <a href="affectation_service.php?IDP=<?php echo $_GET['IDP']; ?>&ID=<?php echo $enreg['id'];?>" class="btn btn-warning waves-effect waves-light">Modifier</a>
											<a href="Javascript:Supprimer('<?php echo $_GET['IDP']; ?>','<?php echo $enreg['id'];?>')"class="btn btn-danger waves-effect waves-light" style="background-color:red">Supprimer</a>
											<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
													data-target=".bs-example-modal-lg<?php echo $enreg['idservice']; ?>" id="<?php echo $enreg['idservice']; ?>">
													Nomenclature (<?php echo $nomenclature; ?>)
											</button>
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg<?php echo $enreg['idservice']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"><?php echo $service; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                           
														   <div class="col-md-12 row">
																<div class="col-md-5" id="selectMP<?php echo $enreg['idservice']; ?>">
																	
																</div>
																<div class="col-md-3">
																	<b>Quantité (par unité)</b>
																	<input id="qte<?php echo $enreg['idservice']; ?>" name="qte<?php echo $enreg['idservice']; ?>" class="form-control" >
																</div>
																<div class="col-md-3">
																	<br>
																	<input type="button" id="<?php echo $enreg['idservice']; ?>" value="Enregistrer" class="btn btn-primary btn-sm btnmp" >
																</div>															
														   </div>
														   
														   <div class="col-md-12 row" style="margin-top:20px" id="listeMP<?php echo $enreg['idservice']; ?>" >
	
														   </div>
														   
														   
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->												
                                        </td>
                                        <?php } ?>
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
	$("#poids_net").on("change", function(){
		var poids_net= parseInt($(this).val());
		var pr_brute = parseInt($("#pourcentage_brute").val());
		var x=((poids_net*pr_brute)/100);
		var prix=(x+poids_net);		
		$("#poids_brute").val(prix);
		
	});
	$(".btn").on("click", function(){
		var idservice	= $(this).attr('id');
		var idproduit	= <?php echo $_GET['IDP']; ?>;
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps.onreadystatechange=function(){
			
			if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
				
				$('#listeMP'+idservice).html(xmlhttp_listemps.responseText);
			}	
		}
		xmlhttp_listemps.open("POST","page_json/json_liste_mps.php",true);
		xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps.send("idproduit="+idproduit+"&idservice="+idservice);

		//Refraiche la liste des MPs
			if (window.XMLHttpRequest)
			{
			  xmlhttp_selectmps=new XMLHttpRequest();
			}else{
			  xmlhttp_selectmps=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_selectmps.onreadystatechange=function(){
				
				if(xmlhttp_selectmps.status==200 && xmlhttp_selectmps.readyState==4){
					
					$('#selectMP'+idservice).html(xmlhttp_selectmps.responseText);
				}	
			}
			xmlhttp_selectmps.open("POST","page_json/json_selectmp.php",true);
			xmlhttp_selectmps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_selectmps.send("idproduit="+idproduit+"&idservice="+idservice);	
		//Fin refraiche liste des MPs
	});	
	
	$(".btnmp").on("click", function(){
		var idservice	= $(this).attr('id');
		var idproduit	= <?php echo $_GET['IDP']; ?>;
		var mp			= $("#mp"+idservice).val();
		var qte			= $("#qte"+idservice).val();
				
		if(mp=="0"){
			alert("Sélectionner une matière première SVP !");
			return false;
		}
		
		if(qte==""){
			alert("Saisir la quantité SVP !");
			return false;
		}		
		
		var variable="idservice="+idservice+"&idproduit="+idproduit+"&mp="+mp+"&qte="+qte;
		$.post("page_ajax/ajax_nomenclature.php", variable, function (data, status) {
			if (status == "success") {	
					if (window.XMLHttpRequest)
					{
					  xmlhttp_selectmps1=new XMLHttpRequest();
					}else{
					  xmlhttp_selectmps1=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_selectmps1.onreadystatechange=function(){
						
						if(xmlhttp_selectmps1.status==200 && xmlhttp_selectmps1.readyState==4){
							
							$('#listeMP'+idservice).html(xmlhttp_selectmps1.responseText);
						}	
					}
					xmlhttp_selectmps1.open("POST","page_json/json_liste_mps.php",true);
					xmlhttp_selectmps1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_selectmps1.send("idproduit="+idproduit+"&idservice="+idservice);	
					
					//Refraiche la liste des MPs
						if (window.XMLHttpRequest)
						{
						  xmlhttp_selectmps1=new XMLHttpRequest();
						}else{
						  xmlhttp_selectmps1=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_selectmps1.onreadystatechange=function(){
							
							if(xmlhttp_selectmps1.status==200 && xmlhttp_selectmps1.readyState==4){
								
								$('#selectMP'+idservice).html(xmlhttp_selectmps1.responseText);
							}	
						}
						xmlhttp_selectmps1.open("POST","page_json/json_selectmp.php",true);
						xmlhttp_selectmps1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_selectmps1.send("idproduit="+idproduit+"&idservice="+idservice);	
					//Fin refraiche liste des MPs					

					$('#qte'+idservice).val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
	});	
</script>