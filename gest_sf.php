<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Gestion des produits semi-finis</h4>
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
	$provenance			=	addslashes($_POST["provenance"]) ;
	$seuil				=	addslashes($_POST["seuil"]) ;
	if($id=="0")
		{
			//Vérification de code
			$req="select * from erp_fab_produits where semi=0 and code='".$code."'";
			$query=mysql_query($req);
			if(mysql_num_rows($query)>0){
				echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?err=1" </SCRIPT>';
				exit;
			}
			
			 $sql="INSERT INTO `erp_fab_produits`(`code`, `code_barre`, `designation`, `prix`, `semi`, `type`, `provenance`, `seuil`) VALUES
			 ('".$code."','".$code_barre."' ,'".$designation."' ,'".$prix."' ,'0' ,'".$type."' ,'".$provenance."','".$seuil."' )";
		}
	else{
			$sql="UPDATE `erp_fab_produits` SET `code`='".$code."',`code_barre`='".$code_barre."',
			`designation`='".$designation."', `prix`='".$prix."' , `type`='".$type."' , `provenance`='".$provenance."' , `seuil`='".$seuil."'  WHERE id=".$id;
			
		}
		$requete=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$code				=	"" ;
	$code_barre			=	"" ;	
	$designation		=	"" ;		
	$prix				=	"0" ;
	$type				=	"" ;	
	$provenance			=	"" ;	
	$seuil				=	0;
	$req="select * from erp_fab_produits where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$prix				=	$enreg["prix"] ;
		$type				=	$enreg["type"] ;
		$provenance			=	$enreg["provenance"] ;
		$seuil				=	$enreg["seuil"] ;
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
									<div class="col-sm-2">
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
									<div class="col-sm-3" style="display:none ">
									<b>Type d'emballage </b>
										<select name="type" id="type" class="form-control" >
											<option value="">Sélectionner le type d'emballage</option>
											<option value="0">Emballage par pièce </option>
											<option value="1">	Emballage par séparation  </option>
										</select>
									</div>		
									<div class="col-sm-3">
									<b>Liste des provenances</b>
									<select class="form-control select2" name="provenance">
										<option value=""> Sélectionner une provenance</option>
										<?php
											$req="select * from erp_fab_classe order by classe";
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
										<option value="<?php echo $enreg['id']; ?>"
											<?php if($provenance==$enreg['id']) {?> selected <?php } ?>>
											<?php echo $enreg['classe']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-3">
								<b>Seuil d’approvisionnement </b>
									<input class="form-control"  type="number"  placeholder="	Seuil d’approvisionnement " value="<?php echo $seuil; ?>" id="example-text-input" name="seuil" >
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

?>	        		
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h3>Liste des produits SF</h3>			
								<form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
									<div class="col-xl-12">
										<div class="row">
											<div class="col-xl-3">
											<b>Liste des codes</b>
											<select class="form-control select2" name="code">
												<option value=""> Sélectionner un code </option>
												<?php
												$req="select * from erp_fab_produits where semi=0 order by code";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($code==$enreg['id']) {?> selected <?php } ?>><?php echo $enreg['code']; ?></option>
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
											<div class="col-xl-3">
											  <b></b><br>
												<input name="SubmitContact" type="submit" id="submit" class="btn btn-primary btn-sm " value="Filtrer">											
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
											<th><b>Provenance</b></th>
											<th><b>Seuil d’approvisionnement </b></th>
											<th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
	$req="select * from erp_fab_produits where semi=0 ".$reqCode." order by code";
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
	

	$req="select * from erp_fab_produits where semi=0 ".$reqCode." order by code  LIMIT $start, $limit";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$prix				=	$enreg["prix"] ;
		$type				=	$enreg["type"] ;
		$i++;
		
		$provenance="";
		$req1="select * from erp_fab_classe where id=".$enreg['provenance'];
		$query1=mysql_query($req1);
		while($enreg1=mysql_fetch_array($query1)){
			$provenance	=	$enreg1['classe'];
		}		
		
		$nomenclature = 0;
		$reqcom="select * from erp_fab_nomenclature where idproduit=".$id." group by idservice";
		$querycom=mysql_query($reqcom);
		$nomenclature=mysql_num_rows($querycom);		
	?>
										<tr>
											 <td><?php echo $i; ?></td>
											 <td><?php echo $code; ?></td>
											 <td><?php echo $designation; ?></td>
											 <td><?php echo $code_barre; ?></td>
											 <td><?php echo $prix; ?></td>
											 <td><?php echo $provenance; ?></td>
											 <td><?php echo $enreg['seuil']; ?></td>
											 <td>
												<a href="gest_sf.php?ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">Modifier</a>
											<?php if($enreg['archive']==0){ ?>
											<a href="Javascript:Archiver('<?php echo $id; ?>')"class="btn btn-danger waves-effect waves-light" style="background-color:red">Archiver</a>	
											<?php } else{ ?>
											<a href="Javascript:Unarchiver('<?php echo $id; ?>')"class="btn btn-danger waves-effect waves-light" style="background-color:green">Unarchiver</a>													
											<?php } ?>
												<a href="affectation_service.php?IDP=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light"  style="background-color:brown">Afféctation des service (<?php echo $nomenclature; ?>)</a>
																							
											 </td>
										</tr>
	<?php 
	} 
	
?>	

                                        </tbody>
                                    </table>								
						</div> 
									<nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="gest_sf.php?page=<?php echo $Previous; ?>&limit=<?php echo $limit;?>">Précédente</a></li>
											<?php 
												for($i=1;$i<=$page;$i++){
											?>
                                            <li class="page-item"><a class="page-link" href="gest_sf.php?page=<?php echo $i; ?>&limit=<?php echo $limit;?>"><?php echo $i; ?></a></li>
												<?php } ?>
                                            <li class="page-item"><a class="page-link" href="gest_sf.php?page=<?php echo $Next; ?>&limit=<?php echo $limit;?>">Suivant</a></li>
                                        </ul>
                                    </nav>						
					</div> 
					
				</div> 
			</div> 	
			
			
		 </div> 
  </div>
 </div>

<?php include ("menu_footer/footer.php"); ?>