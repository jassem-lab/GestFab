<?php include ("menu_footer/menu.php"); ?>

<script>
function Supprimer(id, idd) {
    if (confirm('Confirmez-vous cette action?')) {
        document.location.href = "page_js/supprimernomenclature.php?ID=" + id + "&IDD=" + idd;
    }
}
</script>
<div class="wrapper">

    <?php
	$produit="";
	$reqprd="select * from erp_bc_produits where id=".$_GET['ID'];
	$queryprd=mysql_query($reqprd);
	while($enregprd=mysql_fetch_array($queryprd)){
		$produit	=	$enregprd['id'];
		$codeProduit	=	$enregprd['code_interne'];
	}
	?>

    <?php

if(isset($_POST['enregistrer_mail'])){	

	$mp					=	addslashes($_POST["mp_fini"]) ;
	$quantite			=	addslashes($_POST["quantite"]) ;


	$req="select * from erp_bc_nomenclatures_fini where mp_fini=".$mp." and code_produit=".$produit;
	$query=mysql_query($req);
	if(mysql_num_rows($query)>0){
		$sql="UPDATE erp_bc_nomenclatures_fini set quantite=".$quantite." where mp_fini=".$mp." and code_produit=".$produit;
	} else{
		$sql="INSERT INTO `erp_bc_nomenclatures_fini`(`mp_fini`, `quantite`, `code_produit`) VALUES ('".$mp."','".$quantite."' ,'".$produit."')";
	}

		$req=mysql_query($sql);

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



	$quantite = 0;
	$mp		  = 0;
	$req="select * from erp_bc_nomenclatures_fini where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$quantite = $enreg['quantite'];
		$mp		  = $enreg['mp_fini'];	
	}


if(isset($_POST['enregistrer_mail1'])){	

	$produit_sf					=	addslashes($_POST["produit_sf"]) ;


	$req="select * from erp_bc_nomenclatures_fini where produit_sf=".$produit_sf;
	$query=mysql_query($req);
	if(mysql_num_rows($query)>0){
		$sql="UPDATE erp_bc_nomenclatures_fini set produit_sf=".$produit_sf." where mp_fini=".$mp." and code_produit=".$produit;
	} else{
		$sql="INSERT INTO `erp_bc_nomenclatures_fini`(`produit_sf`) VALUES ('".$produit_sf."')";
	}

		$req=mysql_query($sql);

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





	
	$produit_sf		  = 0;
	$req="select * from erp_bc_nomenclatures_fini where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$produit_sf = $enreg['produit_sf'];
	}


if(isset($_POST['enregistrer_mail2'])){	

	$mp					=	addslashes($_POST["mp_fini"]) ;
	$quantite			=	addslashes($_POST["quantite"]) ;


	$req="select * from erp_bc_nomenclatures_fini where mp_fini=".$mp." and code_produit=".$produit;
	$query=mysql_query($req);
	if(mysql_num_rows($query)>0){
		$sql="UPDATE erp_bc_nomenclatures_fini set service=".$service." where mp_fini=".$mp." and code_produit=".$produit;
	} else{
		$sql="INSERT INTO `erp_bc_nomenclatures_fini`(`service`) VALUES ('".$service."')";
	}

		$req=mysql_query($sql);

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



	$service = 0;

	$req="select * from erp_bc_nomenclatures_fini where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$service = $enreg['service'];
			
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
                            <a href="gest_produit.php" class="btn btn-primary waves-effect waves-light">Retour</a>
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
                                    <select name="mp_fini" id="mp" class="form-control select2" required>
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
                                            <?php } ?>
                                        </option>



                                    </select>
                                </div>

                                <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>

                                <div class="col-lg-3">
                                    <b>Quantité correspondante</b>
                                    <input type="text" class="form-control" placeholder="quantité" name="quantite"
                                        value="<?php
											echo $quantite ?>">
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
                        <th><b>Action</b></th>
                    </tr>
                </thead>

                <?php 
				$req ="select * from erp_bc_nomenclatures_fini" ; 
					$query = mysql_query($req) ; 
					while($enreg = mysql_fetch_array($query)){
						$mp  			= 	$enreg["mp_fini"] ; 
						$quantite  		= 	$enreg["quantite"] ; 
						$idNm 			=   $enreg["id"] ; 
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
                        <td>
                            <!-- <a href="nomenclatures_produit.php?ID=<?php echo $_GET['ID']; ?>&IDD=<?php echo $enreg["id"]; ?>"
                                class="btn btn-warning waves-effect waves-light">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="Javascript:Supprimer('<?php echo $_GET['ID']; ?>','<?php echo $enreg["id"]; ?>')"
                                class="btn btn-danger waves-effect waves-light"
                                style="background-color:brown">Supprimer</a> -->
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            <form action="">


                <div class="col-lg-3">
                    <b>Produits semi-finis</b>
                    <select name="produit_sf" id="produit_sf" class="form-control select2" required>
                        <option value="">Sélectionner un produit semi-fini</option>
                        <?php
                        $reqmp="select * from erp_bc_produitsf";
                        $querymp=mysql_query($reqmp);
                        while($enregmp=mysql_fetch_array($querymp)) {
                            $code = $enregmp["code_interne"];  
                        ?>
                        <option value="<?php echo $enregmp['id']; ?>" <?php if($enregmp['id'] == $mp){ ?> selected
                            <?php } ?>>
                            <?php 
                              echo $code ; 
                            ?>
                            <?php } ?>
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light mt-4">
                    Enregistrer
                </button>
                <input class="form-control" type="hidden" name="enregistrer_mail1">

            </form>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th><b>produit semi fini</b></th>

                    </tr>
                </thead>

                <?php 
				$req ="select * from erp_bc_nomenclatures_fini" ; 
					$query = mysql_query($req) ; 
					while($enreg = mysql_fetch_array($query)){
						$produit_sf  			= 	$enreg["produit_sf"] ; 
					
					?>
                <tbody>
                    <tr>

                        <td><?php echo $produit_sf ?></td>
                        <td>
                            <!-- <a href="nomenclatures.php?ID=<?php echo $_GET['ID']; ?>&IDD=<?php echo $enreg["id"]; ?>"
                                class="btn btn-warning waves-effect waves-light">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="Javascript:Supprimer('<?php echo $_GET['ID']; ?>','<?php echo $enreg["id"]; ?>')"
                                class="btn btn-danger waves-effect waves-light"
                                style="background-color:brown">Supprimer</a> -->
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>

            <form action="">
                <div class="col-lg-3">
                    <b>Liste des services </b>
                    <select name="service" id="service" class="form-control select2" required>
                        <option value="">Sélectionner un service</option>
                        <?php
											$reqmp="select * from erp_bc_services";
											$querymp=mysql_query($reqmp);
											while($enregmp=mysql_fetch_array($querymp)) {
												$code = $enregmp["code"];  
											?>
                        <option value="<?php echo $enregmp['id']; ?>" <?php if($enregmp['id'] == $mp){ ?> selected
                            <?php } ?>>
                            <?php 
											echo $code ; 
												?>
                            <?php } ?>
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light mt-4">
                    Enregistrer
                </button>
                <input class="form-control" type="hidden" name="enregistrer_mail2">

            </form>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th><b>Service supplémentaire</b></th>

                    </tr>
                </thead>

                <?php 
				$req ="select * from erp_bc_nomenclatures_fini" ; 
					$query = mysql_query($req) ; 
					while($enreg = mysql_fetch_array($query)){
						$service  			= 	$enreg["service"] ; 
					
					?>
                <tbody>
                    <tr>

                        <td><?php echo $service ?></td>
                        <td>
                            <!-- <a href="nomenclatures.php?ID=<?php echo $_GET['ID']; ?>&IDD=<?php echo $enreg["id"]; ?>"
                                class="btn btn-warning waves-effect waves-light">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="Javascript:Supprimer('<?php echo $_GET['ID']; ?>','<?php echo $enreg["id"]; ?>')"
                                class="btn btn-danger waves-effect waves-light"
                                style="background-color:brown">Supprimer</a> -->
                        </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php include ("menu_footer/footer.php"); ?>