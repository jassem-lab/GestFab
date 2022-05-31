<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des matières premières </h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimermp.php?ID=" + id;
        }
    }

    function Archiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/archivermp.php?ID=" + id;
        }
    }

    function Unarchiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/unarchivermp.php?ID=" + id;
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
	$provenance			=	addslashes($_POST["provenance"]) ;
	$unite				=	addslashes($_POST["unite"]) ;
	$designation		=	addslashes($_POST["designation"]) ;
	$px_achat			=	addslashes($_POST["px_achat"]) ;
	$seuil				=	addslashes($_POST["seuil"]) ;
	$emplacement		=	addslashes($_POST["emplacement"]) ;
	$consommable		=	'0';	
	if($id=="0")
		{			
			 $sql="INSERT INTO `erp_fab_mp`(`code`, `designation`, `code_barre`, `provenance`, `unite`, `px_achat`, `seuil`, `consommable`, emplacement)  VALUES
			 ('".$code."','".$designation."' ,'".$code_barre."' ,'".$provenance."' ,'".$unite."' ,'".$px_achat."' ,'".$seuil."','".$emplacement."','".$consommable."' )";
		}
	else{
			$sql="UPDATE `erp_fab_mp` SET `code`='".$code."',`code_barre`='".$code_barre."',
			`designation`='".$designation."', `unite`='".$unite."', `provenance`='".$provenance."' , `px_achat`='".$px_achat."', `seuil`='".$seuil."', `consommable`='".$consommable."',emplacement='".$emplacement."'  WHERE id=".$id;
			
		}
		$requete=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$code				=	"" ;
	$code_barre			=	"" ;	
	$designation		=	"" ;		
	$px_achat			=	"0" ;
	$unite				=	"" ;	
	$provenance			=	"" ;
	$seuil				=	"0" ;
	$consommable		=	"0";
	$emplacement		=	0;
	$req="select * from erp_fab_mp where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$px_achat			=	$enreg["px_achat"] ;
		$unite				=	$enreg["unite"] ;
		$provenance			=	$enreg["provenance"] ;
		$seuil				=	$enreg["seuil"] ;
		$consommable		=	$enreg["consommable"] ;
		$emplacement		=	$enreg["emplacement"] ;
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
                            <font color="green" style="background-color:#FFFFFF;">
                                <center>Enregistrement effectué avec succès</center>
                            </font><br /><br />
                            <?php } }?>
                            <?php if(isset($_GET['err'])){ ?>
                            <?php if($_GET['err']=='1'){ ?>
                            <font color="red" style="background-color:#FFFFFF;">
                                <center>Ce code a déjà été utilisé</center>
                            </font><br /><br />
                            <?php } }?>
                            <form action="" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <b>Code (*)</b>
                                        <input class="form-control" type="text" placeholder="Code Interne"
                                            value="<?php echo $code; ?>" id="example-text-input" name="code" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <b>Désignation (*)</b>
                                        <input class="form-control" type="text" placeholder="Désignation"
                                            value="<?php echo $designation; ?>" id="example-text-input"
                                            name="designation" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Code à barre</b>
                                        <input class="form-control" type="text" placeholder="Code à barre"
                                            value="<?php echo $code_barre; ?>" id="example-text-input"
                                            name="code_barre">
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Unité</b>
                                        <input class="form-control" type="text" placeholder="Unité"
                                            value="<?php echo $unite; ?>" id="example-text-input" name="unite">
                                    </div>
                                    <div class="col-sm-3">
                                        <b>Px d'achat par défaut</b>
                                        <input class="form-control" type="number" placeholder="Prix d'achat"
                                            value="<?php echo $px_achat; ?>" id="example-text-input" name="px_achat">
                                    </div>
                                    <div class="col-sm-3" style="">
                                        <b>Provenance </b>
                                        <select name="type" name="provenance" id="provenance" class="form-control"
                                            required>
                                            <option value="">Sélectionner un provenance</option>
                                            <?php 
												$re="select * from erp_fab_classe";
												$qu=mysql_query($re);
												while($enreg=mysql_fetch_array($qu)){
											?>
                                            <option value="<?php echo $enreg['id']; ?>"
                                                <?php if($enreg['id']==$provenance){ ?> selected <?php } ?>>
                                                <?php echo $enreg['classe']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Seuil </b>
                                        <input class="form-control" type="number"
                                            placeholder="Seuil d’approvisionnement " value="<?php echo $seuil; ?>"
                                            id="example-text-input" name="seuil">
                                    </div>
                                    <div class="col-sm-3" style="">
                                        <b>Liste des emplacements </b>
                                        <select name="type" name="emplacement" id="emplacement" class="form-control">

                                            <option value="">Sélectionner un emplacement</option>
                                            <?php 
												$re="select * from erp_fab_emplacements";
												$qu=mysql_query($re);
												while($enreg=mysql_fetch_array($qu)){
											?>
                                            <option value="<?php echo $enreg['id']; ?>"
                                                <?php if($enreg['id']==$emplacement){ ?> selected <?php } ?>>
                                                <?php echo $enreg['emplacement']; ?>
                                            </option>
                                            <?php } ?>
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

        if(isset($_POST['import_mail'])){	

        $file = $_FILES["FileAImporter"]["tmp_name"]; // getting temporary source of excel file
        include("Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
        $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
                
            {


            $highestRow = $worksheet->getHighestRow();	
            for($row=2; $row<=$highestRow; $row++)
            {
                $code           = mysql_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue());
                $des 	        = mysql_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $code_barre 	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $provenance 	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                $unite       	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                $prix          	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(5, $row)->getValue());
                $seuil      	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(6, $row)->getValue());
                $stock      	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(7, $row)->getValue());
                $emplacement 	= mysql_real_escape_string($worksheet->getCellByColumnAndRow(8, $row)->getValue());
              

                $req1="select * from erp_fab_mp where code='".$code."'";    
                $query1 = mysql_query($req1) ; 
                if(mysql_num_rows($query1)<1){
                    
                    $sql="INSERT INTO `erp_fab_mp`(`code`, `designation`, `code_barre`, `provenance`, `unite`, `px_achat`, `seuil`, `stock` , `emplacement`) VALUES 
                    ('".$code."','".$des."','".$code_barre."','".$provenance."','".$unite."','".$prix."','".$seuil."','".$stock."','".$emplacement."')";
                    $requete = mysql_query($sql);
                
            } else {
    			$sql=" UPDATE `erp_fab_mp` SET `code`='".$code."',`code_barre`='".$code_barre."',
			    `designation`='".$designation."', `unite`='".$unite."', `provenance`='".$provenance."' , `px_achat`='".$px_achat."', `seuil`='".$seuil."', `consommable`='".$consommable."',emplacement='".$emplacement."'  WHERE code='".$code."'";   
                
                
                $sql="update erp_fab_mp set code='".$code."', code_barre='".$code_barre."', designation='".$designation."', unite='".$unite."', provenance='".$provenance."', unite='".$unite."', px_achat='".$prix."', seuil='".$seuil."', emplacement='".$emplacement."' where code='".$code"'";   
                $requete = mysql_query($sql);
                       }
                    }
                }	
            }
            ?>
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
                            <h3>Liste des matières premières</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des codes</b>
                                            <select class="form-control select2" name="code">
                                                <option value=""> Sélectionner un code </option>
                                                <?php
												$req="select * from erp_fab_mp order by code";
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
                                                        selected <?php }} ?>>20 MPs</option>
                                                    <option value="50"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==50){ ?>
                                                        selected <?php }} ?>>50 MPs</option>
                                                    <option value="10"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==100){ ?>
                                                        selected <?php }} ?>>100 MPs</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-xl-3">
                                            <b></b><br>
                                            <input name="SubmitContact" type="submit" id="submit"
                                                class="btn btn-primary btn-sm " value="Filtrer">
                                            <a href="exportation/export_mp.php"
                                                class="btn btn-success waves-effect waves-light">
                                                Exporter Excel
                                            </a>
                                        </div>
                                        <div class="col-xl-3">
                                            <form action="" method="POST" id="form" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Fichier (.xls) :<span
                                                            class='require'>*</span></label>
                                                    <input type="file" class="form-control input-lg" id="FileAImporter"
                                                        name="FileAImporter" style="height:60px;" required>
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
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            Importer
                                                        </button>
                                                        <input class="form-control" type="hidden" name="import_mail">
                                                    </div>
                                                </div>
                                            </form>
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
                                        <th><b>Provenance</b></th>
                                        <th><b>Unité</b></th>
                                        <th><b>Prix d'achat</b></th>
                                        <th><b>Seuil d’approvisionnement </b></th>
                                        <th><b>Emplacement </b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $req="select * from erp_fab_mp where 1=1 ".$reqCode." order by code";
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
                                    $req="select * from erp_fab_mp where 1=1 ".$reqCode." order by code  LIMIT $start, $limit";
                                    $query=mysql_query($req);
                                    while($enreg=mysql_fetch_array($query))
                                    {
                                        $id					=	$enreg["id"] ;	
                                        $code				=	$enreg["code"] ;
                                        $code_barre			=	$enreg["code_barre"] ;
                                        $designation		=	$enreg["designation"] ;		
                                        $prix				=	$enreg["px_achat"] ;
                                        $unite				=	$enreg["unite"] ;
                                        $i++;
                                        
                                        $provenance="";
                                        $req1="select * from erp_fab_classe where id=".$enreg['provenance'];
                                        $query1=mysql_query($req1);
                                        while($enreg1=mysql_fetch_array($query1)){
                                            $provenance	=	$enreg1['classe'];
                                        }
                                        
                                        $emplacement		=	"" ;
                                        $req1="select * from erp_fab_emplacements where id=".$enreg['emplacement'];
                                        $query1=mysql_query($req1);
                                        while($enreg1=mysql_fetch_array($query1)){
                                            $emplacement	=	$enreg1['emplacement'];
                                        }
                                        
                                        if($enreg['consommable']==1){
                                            $consommable 	=	'Oui';
                                        } else{
                                            $consommable 	=	'Non';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $code; ?></td>
                                        <td><?php echo $designation; ?></td>
                                        <td><?php echo $code_barre; ?></td>
                                        <td><?php echo $provenance; ?></td>
                                        <td><?php echo $unite; ?></td>
                                        <td><?php echo $prix; ?></td>
                                        <td><?php echo $enreg['seuil']; ?></td>
                                        <td><?php echo $emplacement; ?></td>
                                        <td>
                                            <a href="mps.php?ID=<?php echo $id; ?>"
                                                class="btn btn-warning waves-effect waves-light">Modifier</a>
                                            <?php if($enreg['archive']==0){ ?>
                                            <a href="Javascript:Archiver('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light"
                                                style="background-color:red">Archiver</a>
                                            <?php } else{ ?>
                                            <a href="Javascript:Unarchiver('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light"
                                                style="background-color:green">Unarchiver</a>
                                            <?php } ?>


                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="mps.php?page=<?php echo $Previous; ?>&limit=<?php echo $limit;?>">Précédente</a>
                                </li>
                                <?php 
												for($i=1;$i<=$page;$i++){
											?>
                                <li class="page-item"><a class="page-link"
                                        href="mps.php?page=<?php echo $i; ?>&limit=<?php echo $limit;?>"><?php echo $i; ?></a>
                                </li>
                                <?php } ?>
                                <li class="page-item"><a class="page-link"
                                        href="mps.php?page=<?php echo $Next; ?>&limit=<?php echo $limit;?>">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

<?php include ("menu_footer/footer.php"); ?>