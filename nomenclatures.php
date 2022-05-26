<?php include ("menu_footer/menu.php"); ?>

<script>
function Supprimer(id, idd) {
    if (confirm('Confirmez-vous cette action?')) {
        document.location.href = "page_js/supprimernomenclature.php?ID=" + id + "&IDD=" + idd;
    }
}

function ImprimerDetail(id) {
    if (confirm('Confirmez-vous cette action?')) {
        var myMODELE_A4 = window.open("print/imprimerpsf.php?ID=" + id, "_blank",
            "toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=700, height=600");
    }
}
</script>
<div class="wrapper">

    <?php
	$produit="";
	$reqprd="select * from erp_bc_produitsf where id=".$_GET['ID'];
	$queryprd=mysql_query($reqprd);
	while($enregprd=mysql_fetch_array($queryprd)){
		$produit	=	$enregprd['id'];
		$codeProduit	=	$enregprd['code_interne'];
	}
	?>

    <?php

if(isset($_POST['enregistrer_mail'])){	

	$mp					=	addslashes($_POST["mp"]) ;
	$quantite			=	addslashes($_POST["quantite"]) ;
	$prix		       	= 0 ; 

    $prixUnitaire = 0 ; 

    $reqPrix = "select * from erp_bc_mp where id=".$mp ; 
    $queryPrix=mysql_query($reqPrix) ;
    while($enregPrix = mysql_fetch_array($queryPrix)){
        $prixUnitaire = $enregPrix["prix"] ; 
    }
    
    $prix = $prixUnitaire * $quantite ; 


	$req="select * from erp_bc_nomenclatures where code_interne=".$mp." and code_produit=".$produit;
	$query=mysql_query($req);
	if(mysql_num_rows($query)>0){
		$sql="UPDATE erp_bc_nomenclatures set quantite=".$quantite." , prix=".$prix." where code_interne=".$mp." and code_produit=".$produit;
	} else{
		$sql="INSERT INTO `erp_bc_nomenclatures`(`code_interne`, `quantite`, `code_produit` ,``prix`) VALUES ('".$mp."','".$quantite."' ,'".$produit."' , '".$prix."')";
       
	}
		$req=mysql_query($sql);
		

        $reqTot = "SELECT sum(prix) as prix_total FROM `erp_bc_nomenclatures` WHERE code_produit=".$produit ; 
        $queryTot= mysql_query($reqTot) ; 
        while($enregTot = mysql_fetch_array($queryTot)){
            $prixTotal = $enregTot["prix_total"] ; 
        }

        $sql2="UPDATE erp_bc_produitsf set prix=".$prixTotal." where code_interne=".$codeProduit;
        $req=mysql_query($sql2);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="nomenclatures.php?ID='.$_GET['ID'].'"?suc=1" </SCRIPT>';

	}

if(isset($_GET['ID'])){
		$id = $_GET['ID'];
	}else{
		$id = "0";
}
	if(isset($_GET['IDD'])){
		$idd = $_GET['IDD'];
	}else{
		$idd = "0";
	}


    $prixTotal = 0 ; 
	$quantite = 0;
	$mp		  = 0;
	$req="select * from erp_bc_nomenclatures where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$quantite = $enreg['quantite'];
		$mp		  = $enreg['code_interne'];	
		$prix		  = $enreg['prix'];	


    
	}

?>
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Nomenclature de produit fini <b style="color:#ffc107">"
                            <?php echo $codeProduit; ?> "</b></h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <a href="gest_produitsf.php" class="btn btn-primary waves-effect waves-light">Retour</a>
                            <a href="javascript:ImprimerDetail('<?php echo $codeProduit; ?>')"
                                class="btn btn-warning waves-effect waves-light"
                                style="background-color: blue;color: white;">
                                <span class="glyphicon glyphicon-print"></span>
                            </a>
                            <h3>Liste des matières premieres </h3>
                            <br>
                            <?php
								$req="select * from erp_bc_produitsf where id=".$_GET['ID']." ";
								$query=mysql_query($req);
								while($enreg=mysql_fetch_array($query))
								{
									$id					=	$_GET['ID'] ;
									$codeProduit		=	$enreg["code_interne"] ; 
								}
								?>

                            <form action="" method="POST">

                                <div class="col-lg-3">
                                    <b>Matiere premiere</b>
                                    <select name="mp" id="mp" class="form-control select2" required>
                                        <option value="">Sélectionner une MP</option>
                                        <?php
											$reqmp="select * from erp_bc_mp";
											$querymp=mysql_query($reqmp);
											while($enregmp=mysql_fetch_array($querymp)) {
												$code = $enregmp["codeinterne"];  
											?>
                                        <option value="<?php echo $enregmp['id']; ?>"
                                            <?php if($enregmp['id'] == $mp){ ?> selected <?php } ?>>
                                            <?php 
											echo $code ; 
												?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                <div class="col-lg-3">
                                    <b>Quantité correspondante</b>
                                    <input type="text" class="form-control" placeholder="quantité" name="quantite"
                                        value="<?php
											echo $quantite ?>">
                                </div>
                                <div class="col-lg-3">
                                    <b>Prix Total</b>
                                    <input readonly type="number" class="form-control" placeholder="Prix" value="<?php
											 echo $prixTotal ; 
                                            ?>">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Enregistrer
                                </button>
                                <input class="form-control" type="hidden" name="enregistrer_mail">
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table mb-0">
                <thead>
                    <tr>
                        <th><b>Matiere premiere</b></th>
                        <th><b>Quantité correspondante</b></th>
                        <th><b>Prix </b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>

                <?php 
				$req ="select * from erp_bc_nomenclatures where code_produit=".$_GET['ID'] ; 
					$query = mysql_query($req) ; 
					while($enreg = mysql_fetch_array($query)){
						$mp  			= 	$enreg["code_interne"] ; 
						$quantite  		= 	$enreg["quantite"] ; 
						$idNm 			=   $enreg["id"] ; 
                        $Prix   =   $enreg["prix"] ; 
					?>
                <tbody>
                    <tr>
                        <td><?php 
						$classe = "" ; 
						$reqNom = "select * from erp_bc_mp where id=".$mp ; 
						$queryNom = mysql_query($reqNom) ; 
						while($enregNom = mysql_fetch_array($queryNom)){
							echo $enregNom["codeinterne"];
							}
						
						?></td>
                        <td><?php echo $quantite ?></td>
                        <td><?php echo $Prix ?></td>
                        <td>
                            <a href="nomenclatures.php?ID=<?php echo $_GET['ID']; ?>&IDD=<?php echo $enreg["id"]; ?>"
                                class="btn btn-warning waves-effect waves-light">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="Javascript:Supprimer('<?php echo $_GET['ID']; ?>','<?php echo $enreg["id"]; ?>')"
                                class="btn btn-danger waves-effect waves-light"
                                style="background-color:brown">Supprimer</a>
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php include ("menu_footer/footer.php"); ?>