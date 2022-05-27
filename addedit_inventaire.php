<?php include ("menu_footer/menu.php"); ?>
<?php ini_set('memory_limit', '256M'); ?>
<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Création/Modification d'un inventaire de stock</h4>
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
	$reference		=	addslashes($_POST["reference"]) ;
	$type			=	addslashes($_POST["type"]) ;
	$date 			= 	date("Y-m-d");	
	$dateheure		= 	date("Y-m-d H:i:s");		
	
	
	if($id==0){
			//Insertion entête
				
				$idinv="0";
				$reqMax="select max(id) as idinv from erp_fab_inventaire";
				$queryMax=mysql_query($reqMax);
				if(mysql_num_rows($queryMax)>0){
					while($enregMax=mysql_fetch_array($queryMax)){
						$idinv	=	$enregMax['idinv'] + 1;
					}
				} else{
						$idinv	=	"1";
				}				
			
				$sql="INSERT INTO `erp_fab_inventaire`(`id`,`reference`, `date`, `dateheure`, `type`, `idutilisateur`) VALUES "; 
				$sql=$sql." ('".$idinv."','".$reference."','".$date."','".$dateheure."','".$type."','".$_SESSION['erp_fab_IDUSER']."')";
				$req=mysql_query($sql);
				
				//Mise à jour compteur référence
					$date1 = date("Y");
					$max="";
					$reqm="SELECT * from  erp_fab_compteur_inventaire  where date='".$date1 ."'" ;
					$querym=mysql_query($reqm);
					$numc=mysql_num_rows($querym);
						if($numc>0){
							$reqmax="SELECT max(compteur)+1 as MaxID from  erp_fab_compteur_inventaire  where date='".$date1 ."'";
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
						$sql="INSERT INTO `erp_fab_compteur_inventaire`(`date`, `compteur`, `iddoc`) VALUES ('".$date1."' ,'".$max."','".$idinv."')";
						$req=mysql_query($sql);
					
						$extension = end(explode(".", $_FILES["fileAimporter"]["name"])); // For getting Extension of selected file
						$allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
						if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
						{
							$file = $_FILES["fileAimporter"]["tmp_name"]; // getting temporary source of excel file
							include("Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
							$objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file
							foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
						
										{
								$highestRow = $worksheet->getHighestRow();	
								for($row=2; $row<=$highestRow; $row++)
								{
									$code   = mysql_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue());
									$des 	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue());
									$qte 	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue());
									echo 'hello world' ; 
									if($type==1){
										$idproduit="0";
										$req="select * from erp_fab_produits where code='".$code."'";
										$query=mysql_query($req);
										if(mysql_num_rows($query)>0){
											while($enreg=mysql_fetch_array($query)){
												$idproduit	=	$enreg['id'];
											}
											
											$sql="INSERT INTO `erp_bc_det_inventaire`(`idinventaire`, `produit`, `type`, `quantite`) VALUES 
											('".$idinv."','".$idproduit."','".$type."','".$qte."')";
											$requete = mysql_query($sql);
										}
									} else{
										$idmp="0";
										$req="select * from erp_fab_mp where code='".$code."'";
										$query=mysql_query($req);
										if(mysql_num_rows($query)>0){
											while($enreg=mysql_fetch_array($query)){
												$idmp	=	$enreg['id'];
											}
											
											$sql="INSERT INTO `erp_bc_det_inventaire`(`idinventaire`, `mp`, `type`, `quantite`) VALUES 
											('".$idinv."','".$idmp."','".$type."','".$qte."')";
											$requete = mysql_query($sql);
										}										
									}
									
								}
							}	
						}

					
			
	}
	echo "<script type=\"text/javascript\">
	alert(\"Stock has been successfully Imported.\");
	</script>";
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="gest_inv.php" </SCRIPT>';

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
                            <a href="gest_inv.php" class="btn btn-primary waves-effect waves-light">Retour</a>
                            <a href="modele_sf.php" class="btn btn-primary waves-effect waves-light"
                                style="background-color: orange">Modèle Produit finis et semis-finis </a>
                            <a href="modele_mp.php" class="btn btn-primary waves-effect waves-light"
                                style="background-color: pink">Matières premières </a>
                            <?php if(isset($_GET['suc'])){ ?>
                            <?php if($_GET['suc']=='1'){ ?>
                            <font color="green" style="background-color:#FFFFFF;">
                                <center>Enregistrement effectué avec succès</center>
                            </font><br /><br />
                            <?php } ?>
                            <?php }?>
                            <form action="" method="POST" id="form" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <b>Référence (*)</b>
                                        <input class="form-control" type="text" placeholder="Référence"
                                            value="<?php echo $reference; ?>" id="example-text-input" name="reference"
                                            required readonly>
                                    </div>
                                    <div class="col-sm-3">
                                        <b>Type (*)</b>
                                        <select class="form-control select2" id="type" name="type" required>
                                            <option value=""> Sélectionner le type d'inventaire </option>
                                            <option value="1" <?php if($type=="1"){ ?> selected <?php } ?>>Produit
                                                semis-finis</option>
                                            <option value="2" <?php if($type=="2"){ ?> selected <?php } ?>>Matières
                                                premières</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label">Fichier (.xls) :<span
                                            class='require'>*</span></label>
                                    <input type="file" class="form-control input-lg" id="file" name="fileAimporter"
                                        style="height:60px;" required>
                                </div>
                                <style>
                                #progress {
                                    display: none;
                                    margin-top: 50px;
                                }

                                #success,
                                #error {
                                    display: none;
                                }
                                </style>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <br>
                                        <div id="success" class="alert alert-success"></div>
                                        <div id="error" class="alert alert-danger"></div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Importer
                                        </button>
                                        <input class="form-control" type="hidden" name="enregistrer_mail">
                                    </div>
                                    <div id="progress" class="progress">
                                        <div class="progress-bar"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
		 alert("hello world") ; 
        let progress = $('#progress');
        let bar = $(progress).find('.progress-bar');
        let form = $('#form');
        let success = $('#success');
        let error = $('#error');
        console.log(form)
        $(form).on('submit', function(e) {
            e.preventDefault();
            if ($(form).find('#file').val()) {
                console.log($(form).find('#file').val());
                var data = new FormData();
                data.append('file', $('#file').get(0).files[0]);
                $(progress).show();
                var config = {
                    onUploadProgress: function(e) {
                        let percent Completed = Math.round((e.loaded 180) / e.total);
                        if (percent Completed < 100)(
                            $(bar).text(percent Completed + '').width(percent Completed +
                                '%');
                        )
                        else {
                            $(bar).text('Done').width('100%');
                            headers: {
                                "X-Requested-With": "XMLHttpRequest"
                            },
                        }
                    }
                }
            }
        })
    });
    </script>
    <?php include ("menu_footer/footer.php"); ?>