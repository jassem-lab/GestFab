<?php include ("menu_footer/menu.php"); ?>

<script>
function SupprimerMP(id, idd) {
    if (confirm('Confirmez-vous cette action?')) {
        document.location.href = "page_js/supprimer_nomenclature_MP.php?ID=" + id + "&IDD=" + idd;
    }
}

function SupprimerSF(id, idd) {
    if (confirm('Confirmez-vous cette action?')) {
        document.location.href = "page_js/supprimer_nomenclature_SF.php?ID=" + id + "&IDD=" + idd;
    }
}

function SupprimerService(id, idd) {
    if (confirm('Confirmez-vous cette action?')) {
        document.location.href = "page_js/supprimer_nomenclature_service.php?ID=" + id + "&IDD=" + idd;
    }
}

function Imprimer(id) {
    if (confirm('Confirmez-vous cette action?')) {
        var myMODELE_A4 = window.open("print/imprimerproduit.php?ID=" + id, "_blank",
            "toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=700, height=600");
    }
}

function ImprimerDetail(id) {
    if (confirm('Confirmez-vous cette action?')) {
        var myMODELE_A4 = window.open("print/imprimerdetailproduit.php?ID=" + id, "_blank",
            "toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=700, height=600");
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


    <?php

if(isset($_POST['enregistrer_mail'])){	

	$mp					=	addslashes($_POST["mp"]) ;
	$quantite			=	addslashes($_POST["quantite"]) ;


	 $req="select * from erp_bc_nomenclatures_fini   where mp_fini=".$mp." and code_produit=".$produit;
	$query=mysql_query($req);
	if(mysql_num_rows($query)>0){
		$sql="UPDATE erp_bc_nomenclatures_fini set quantite=".$quantite." where mp_fini=".$mp." and code_produit=".$produit;
	} else{
		$sql="INSERT INTO `erp_bc_nomenclatures_fini`(`mp_fini`, `quantite`, `code_produit`) VALUES ('".$mp."','".$quantite."' ,'".$produit."')";
	}

		$req=mysql_query($sql);


        //Calcul coût PF
        $cout=0;
        $req=" select * from erp_bc_nomenclatures_fini where code_produit=".$produit;
        $query=mysql_query($req);
        while($enreg=mysql_fetch_array($query)){

            if($enreg['mp_fini']<>0){

                $reqPrix = "select * from erp_bc_mp where id=".$enreg['mp_fini'] ; 
                $queryPrix=mysql_query($reqPrix) ;
                while($enregPrix = mysql_fetch_array($queryPrix)){
                    $cout =  $cout + ($enregPrix["prix"]*$enreg['quantite']) ; 
                }

            }

            if($enreg['produit_sf']<>0){

                $reqPrix = "select * from erp_bc_produitsf where id=".$enreg['produit_sf'] ; 
                $queryPrix=mysql_query($reqPrix) ;
                while($enregPrix = mysql_fetch_array($queryPrix)){
                    $cout =  $cout + ($enregPrix["prix"]*$enreg['quantite_sf']) ; 
                }
                
            }
        }

        $sql="update erp_bc_produits set prix_unitaire=".$cout." where id=".$produit;
        $requete=mysql_query($sql);




        $id=$_GET['ID'];
        echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="nomenclatures_produit.php?ID='.$id.'&suc=1" </SCRIPT>';     
	}
    if(isset($_POST['enregistrer_mail_sf'])){	

        $sf					=	addslashes($_POST["sf"]) ;
        $quantite_sf		=	addslashes($_POST["quantite_sf"]) ;
    
    
        $req="select * from erp_bc_nomenclatures_fini   where produit_sf=".$sf." and code_produit=".$produit;
        $query=mysql_query($req);
        if(mysql_num_rows($query)>0){
            $sql="UPDATE erp_bc_nomenclatures_fini set quantite_sf=".$quantite_sf." where produit_sf=".$sf." and code_produit=".$produit;
        } else{
            $sql="INSERT INTO `erp_bc_nomenclatures_fini`(`produit_sf`, `quantite_sf`, `code_produit`) VALUES ('".$sf."','".$quantite_sf."' ,'".$produit."')";
        }
    
            $req=mysql_query($sql);



        //Calcul coût PF
        $cout=0;
        $req=" select * from erp_bc_nomenclatures_fini where code_produit=".$produit;
        $query=mysql_query($req);
        while($enreg=mysql_fetch_array($query)){

            if($enreg['mp_fini']<>0){

                $reqPrix = "select * from erp_bc_mp where id=".$enreg['mp_fini'] ; 
                $queryPrix=mysql_query($reqPrix) ;
                while($enregPrix = mysql_fetch_array($queryPrix)){
                    $cout =  $cout + ($enregPrix["prix"]*$enreg['quantite']) ; 
                }

            }

            if($enreg['produit_sf']<>0){

                $reqPrix = "select * from erp_bc_produitsf where id=".$enreg['produit_sf'] ; 
                $queryPrix=mysql_query($reqPrix) ;
                while($enregPrix = mysql_fetch_array($queryPrix)){
                    $cout =  $cout + ($enregPrix["prix"]*$enreg['quantite_sf']) ; 
                }
                
            }
        }

        $sql="update erp_bc_produits set prix_unitaire=".$cout." where id=".$produit;
        $requete=mysql_query($sql);


            $id=$_GET['ID'];
            echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="nomenclatures_produit.php?ID='.$id.'&suc=1" </SCRIPT>';        
    
        }

        if(isset($_POST['enregistrer_mail_service'])){	

            $service					=	addslashes($_POST["service"]) ;
            $quantite_service           =   addslashes($_POST["quantite_service"]) ; 
        
            $req="select * from erp_bc_nomenclatures_fini where service=".$service."  and code_produit=".$produit;
            $query=mysql_query($req);
            if(mysql_num_rows($query)>0){
               //
            } else{
                $sql="INSERT INTO `erp_bc_nomenclatures_fini`(`service`,`quantite_service` , `code_produit`) VALUES ('".$service."' ,'".$quantite_service."','".$produit."')";
                $req=mysql_query($sql);
        
            }

            $id=$_GET['ID'];
            echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="nomenclatures_produit.php?ID='.$id.'&suc=1" </SCRIPT>';     
      }
       

    ?>





    <?php
    $quantite = 0;
    $mp = 0;
    $sf = 0;
    $quantite_sf =0;
    $service = 0;
    $quantite_service = 0 ;
	if(isset($_GET['IDD'])){
		$idd = $_GET['IDD'];
	}else{
		$idd = "0";
	}

	if(isset($_GET['IDSF'])){
		$idsf = $_GET['IDSF'];
	}else{
		$idsf = "0";
	}

	if(isset($_GET['IDService'])){
		$idse = $_GET['IDService'];
	}else{
		$idse = "0";
	}

    $req="select * from erp_bc_nomenclatures_fini where id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$quantite = $enreg['quantite'];
		$mp		  = $enreg['mp_fini'];	
	}   

    $req="select * from erp_bc_nomenclatures_fini where id=".$idsf;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$quantite_sf = $enreg['quantite_sf'];
		$sf		  = $enreg['produit_sf'];	
	} 
    

    $req="select * from erp_bc_nomenclatures_fini where id=".$idse;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$service = $enreg['service'];
        $quantite_service = $enreg["quantite_service"] ; 
	}  
?>

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <a href="gest_produit.php" class="btn btn-primary waves-effect waves-light">Retour</a>
                            <a href="javascript:Imprimer('<?php echo $produit; ?>')"
                                class="btn btn-warning waves-effect waves-light"
                                style="background-color: blue;color: white;">
                                <span class="glyphicon glyphicon-print"></span>
                            </a>
                            <a href="javascript:ImprimerDetail('<?php echo $produit; ?>')"
                                class="btn btn-warning waves-effect waves-light"
                                style="background-color: blue;color: white;">
                                <span class="glyphicon glyphicon-print"> Imprimer Detail </span>
                            </a>

                            <div class="col-md-12 row">

                                <div class="col-md-4">
                                    <h4><b>Nomenclature par MP </b></h4>
                                    <div class="col-md-12 row">
                                        <form action="" method="POST">

                                            <div class="col-md-8">
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
                                                        <?php echo $code ; ?>
                                                    </option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                            <div class="col-md-4">
                                                <b>Quantité</b>
                                                <input type="text" class="form-control" placeholder="quantité"
                                                    name="quantite" value="<?php echo $quantite ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <br>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Enregistrer
                                                </button>
                                                <input class="form-control" type="hidden" name="enregistrer_mail">
                                            </div>

                                            <?php } ?>
                                        </form>
                                    </div>

                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th><b>Matiere premiere</b></th>
                                                <th><b>Quantité </b></th>
                                                <th><b>Action</b></th>
                                            </tr>
                                        </thead>

                                        <?php 
                                        $req ="select * from erp_bc_nomenclatures_fini where mp_fini>0 and code_produit=".$_GET['ID'] ; 
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
                                                    <a href="nomenclatures_produit.php?ID=<?php echo $_GET['ID']; ?>&IDD=<?php echo $enreg["id"]; ?>"
                                                        class="btn btn-warning waves-effect waves-light">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="Javascript:SupprimerMP('<?php echo $_GET['ID']; ?>','<?php echo $enreg["id"]; ?>')"
                                                        class="btn btn-danger waves-effect waves-light"
                                                        style="background-color:brown">Supprimer</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>





                                </div>

                                <div class="col-md-4">
                                    <h4><b>Nomenclature par Produit SF</b></h4>
                                    <div class="col-md-12 row">
                                        <form action="" method="POST">

                                            <div class="col-md-8">
                                                <b>Produit SF</b>
                                                <select name="sf" id="sf" class="form-control select2" required>
                                                    <option value="">Sélectionner un produit SF</option>
                                                    <?php
                                                            $reqmp="select * from 	erp_bc_produitsf";
                                                            $querymp=mysql_query($reqmp);
                                                            while($enregmp=mysql_fetch_array($querymp)) {
                                                                $code = $enregmp["code_interne"];  
                                                            ?>
                                                    <option value="<?php echo $enregmp['id']; ?>"
                                                        <?php if($enregmp['id'] == $sf){ ?> selected <?php } ?>>
                                                        <?php echo $code ; ?>
                                                    </option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                            <div class="col-md-4">
                                                <b>Quantité</b>
                                                <input type="text" class="form-control" placeholder="quantité"
                                                    name="quantite_sf" value="<?php echo $quantite_sf ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <br>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Enregistrer
                                                </button>
                                                <input class="form-control" type="hidden" name="enregistrer_mail_sf">
                                            </div>

                                            <?php } ?>
                                        </form>
                                    </div>

                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th><b>Produit SF</b></th>
                                                <th><b>Quantité </b></th>
                                                <th><b>Action</b></th>
                                            </tr>
                                        </thead>

                                        <?php 
                                        $req ="select * from erp_bc_nomenclatures_fini where produit_sf>0  and code_produit=".$_GET['ID'] ; 
                                        $query = mysql_query($req) ; 
                                        while($enreg = mysql_fetch_array($query)){
                                            $sf  			= 	$enreg["produit_sf"] ; 
                                            $quantite  		= 	$enreg["quantite_sf"] ; 
                                            $idNm 			=   $enreg["id"] ; 
					                    ?>
                                        <tbody>
                                            <tr>
                                                <td><?php 
                                                $semif = "" ; 
                                                $reqNom = "select * from erp_bc_produitsf where id=".$sf ; 
                                                $queryNom = mysql_query($reqNom) ; 
                                                while($enregNom = mysql_fetch_array($queryNom)){
                                                   $semif= $enregNom["code_interne"];
                                                 }
						
						                        ?>
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target=".bs-example-modal-lg<?php echo $sf; ?>"
                                                        id="<?php echo $sf ?>">
                                                        <?php echo $semif; ?>
                                                    </button>
                                                    <!--  Modal content for the above example -->
                                                    <div class="modal fade bs-example-modal-lg<?php echo $sf ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="myLargeModalLabel">
                                                                        <?php echo $semif; ?></h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-hidden="true">X</button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="col-md-12 row">
                                                                        <table class="table mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th><b>Matiere premiere</b></th>
                                                                                    <th><b>Quantité</b></th>
                                                                                </tr>
                                                                            </thead>

                                                                            <?php 
                                                                            $req1 ="select * from erp_bc_nomenclatures where code_produit=".$sf ; 
                                                                                $query1 = mysql_query($req1) ; 
                                                                                while($enreg1 = mysql_fetch_array($query1)){
                                                                                    $mp  			= 	$enreg1["code_interne"] ; 
                                                                                    $idNm 			=   $enreg1["id"] ; 
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
                                                                                    <td><?php echo $enreg1["quantite"] ; ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                            <?php } ?>
                                                                        </table>
                                                                    </div>



                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->

                                                </td>





                                                <td><?php echo $quantite ?></td>
                                                <td>
                                                    <a href="nomenclatures_produit.php?ID=<?php echo $_GET['ID']; ?>&IDSF=<?php echo $enreg["id"]; ?>"
                                                        class="btn btn-warning waves-effect waves-light">
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                    </a>
                                                    <a href="Javascript:SupprimerSF('<?php echo $_GET['ID']; ?>','<?php echo $enreg["id"]; ?>')"
                                                        class="btn btn-danger waves-effect waves-light"
                                                        style="background-color:brown">Supprimer</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <h4><b>Nomenclature par Service </b></h4>
                                    <div class="col-md-12 row">
                                        <form action="" method="POST">

                                            <div class="col-md-8">
                                                <b>Liste des services</b>
                                                <select name="service" id="service" class="form-control select2"
                                                    required>
                                                    <option value="">Sélectionner un service</option>
                                                    <?php
                                                            $reqmp="select * from 		erp_bc_services";
                                                            $querymp=mysql_query($reqmp);
                                                            while($enregmp=mysql_fetch_array($querymp)) {
                                                                $code = $enregmp["code"];  
                                                            ?>
                                                    <option value="<?php echo $enregmp['id']; ?>"
                                                        <?php if($enregmp['id'] == $sf){ ?> selected <?php } ?>>
                                                        <?php echo $code ; ?>
                                                    </option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Quantité</b>
                                                <input type="text" class="form-control" placeholder="quantité"
                                                    name="quantite_service" value="<?php echo $quantite_service ?>">
                                            </div>
                                            <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>

                                            <div class="col-md-4">
                                                <br>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Enregistrer
                                                </button>
                                                <input class="form-control" type="hidden"
                                                    name="enregistrer_mail_service">
                                            </div>

                                            <?php } ?>
                                        </form>
                                    </div>
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th><b>Service</b></th>
                                                <th><b>Quantité </b></th>
                                                <th><b>Action</b></th>
                                            </tr>
                                        </thead>

                                        <?php 
                                        $req ="select * from erp_bc_nomenclatures_fini where service>0 and code_produit=".$_GET['ID'] ; 
                                        $query = mysql_query($req) ; 
                                        while($enreg = mysql_fetch_array($query)){
                                            $service  		           	= 	$enreg["service"] ; 
                                            $quantite_service  			= 	$enreg["quantite_service"] ; 
                                            $idNm 			            =   $enreg["id"] ; 
					                    ?>
                                        <tbody>
                                            <tr>
                                                <td><?php 
                                                $classe = "" ; 
                                                $reqNom = "select * from erp_bc_services where id=".$service ; 
                                                $queryNom = mysql_query($reqNom) ; 
                                                while($enregNom = mysql_fetch_array($queryNom)){
                                                    echo $enregNom["code"];
                                                 }
						
						                        ?></td>
                                                <td><?php echo $quantite_service ?> </td>
                                                <td>

                                                    <a href="Javascript:SupprimerService('<?php echo $_GET['ID']; ?>','<?php echo $enreg["id"]; ?>')"
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
                    </div>
                </div>
            </div>





        </div>
    </div>
</div>

<?php include ("menu_footer/footer.php"); ?>