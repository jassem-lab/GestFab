<?php include ("menu_footer/menu.php"); ?>
<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Nomenclature Produit Finis par rapport les produits semis finis</h4>			
				<br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
			</div>
		</div>
	</div>
  </div>
  
 <?php

if(isset($_POST['enregistrer_mail'])){	
	$file = $_FILES["fileAimporter"]["tmp_name"]; 
	include("Classes/PHPExcel/IOFactory.php"); 
	$objPHPExcel = PHPExcel_IOFactory::load($file); 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
	{
		
		
		$highestRow = $worksheet->getHighestRow();	
		for($row=2; $row<=$highestRow; $row++)
		{

			$code_pf   			    = trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
			$des_pf 		    	= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
			$code_sf		 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
			$des_sf			 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(3, $row)->getValue()));
			$qte 					= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(4, $row)->getValue()));
			$location		 		= trim(mysql_real_escape_string($worksheet->getCellByColumnAndRow(5, $row)->getValue()));

			if($code_pf<>""){ // Début Insertion d'une ligne
			
				//Provenance
				if($location==''){
					$idloc = 0;
				} else{
					$idloc = 0;
					$req="select * from erp_fab_classe where classe='".$location."'";
					$query=mysql_query($req);
					if(mysql_num_rows($query)>0){
						while($enreg=mysql_fetch_array($query)){
							$idloc = $enreg['id'];
						}					
					} else{
						$reqmax="select max(id) as maxID from erp_fab_classe";
						$querymax=mysql_query($reqmax);
						while($enregmax=mysql_fetch_array($querymax)){
							$idloc = $enregmax['maxID']+1;
						}
						$sql="INSERT INTO `erp_fab_classe`(`id`,`classe`) VALUES ('".$idloc."','".$location."')";
						if($location<>""){
							$requete=mysql_query($sql);	
						}
					}					
					
				}

				//Fin Provenance
				
				//Produit Finis
					$idproduit = 0;
					$req="select * from erp_fab_produits where code='".$code_pf."'";
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
						$sql="INSERT INTO `erp_fab_produits`(`id`,`code`,`designation`,`semi`) VALUES ('".$idproduit."','".$code_pf."','".$des_pf."','1')";
						$requete=mysql_query($sql);
					}				
				//Fin Produit Finis
				
				//Produit Finis
					$idsproduit = 0;
					$req="select * from erp_fab_produits where code='".$code_sf."'";
					$query=mysql_query($req);
					if(mysql_num_rows($query)>0){
						while($enreg=mysql_fetch_array($query)){
							$idsproduit = $enreg['id'];
						}
					} else{ //Insertion d'un nouvelle produit
						$reqmax="select max(id) as maxID from erp_fab_produits";
						$querymax=mysql_query($reqmax);
						while($enregmax=mysql_fetch_array($querymax)){
							$idsproduit = $enregmax['maxID']+1;
						}
						$sql="INSERT INTO `erp_fab_produits`(`id`,`code`,`designation`,`semi`,`provenance`) VALUES ('".$idsproduit."','".$code_sf."','".$des_sf."','0','".$idloc."')";
						$requete=mysql_query($sql);
					}				
				//Fin Produit Finis		

	
				$req="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit." and idsemi=".$idsproduit;
				$query=mysql_query($req);
				if(mysql_num_rows($query)>0){ //Mise à jours
					$sql="UPDATE erp_fab_nomenclature_pf SET quantite=".$qte.", provenance=".$idloc." where idproduit=".$idproduit." and idsemi=".$idsproduit;
					$requete=mysql_query($sql);
				} else{//Insertion
					$sql="INSERT INTO `erp_fab_nomenclature_pf`(`idproduit`, `idsemi`, `provenance`, `quantite`) VALUES ";
					$sql=$sql." ('".$idproduit."','".$idsproduit."','".$idloc."','".$qte."') ";
					$requete=mysql_query($sql);
				}
				

			} // Fin Insertion d'une ligne
			
		}
	}	
	
	

	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="gest_pf.php?suc=1" </SCRIPT>';
}

?> 
  <div class="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
						<a href="gest_pf.php" class="btn btn-primary waves-effect waves-light">Retour</a> 	
						<a href="modele_nomenclature_pf.php" class="btn btn-primary waves-effect waves-light" style="background-color: orange">Modèle Viérge </a> 
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
       		 
  </div>
 </div>

<?php include ("menu_footer/footer.php"); ?>