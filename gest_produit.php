<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des produits finis</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerproduit.php?ID=" + id;
        }
    }



    function Archiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/archiverproduit.php?ID=" + id;
        }
    }

    function Unarchiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/unarchiverproduit.php?ID=" + id;
        }
    }

    function Imprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            var myMODELE_A4 = window.open("print/nomenclatures_pf.php?ID=" + id, "_blank",
                "toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=700, height=600");
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
	$prix		    	=	addslashes($_POST["prix"]) ;	
	$emballage		    	=	addslashes($_POST["emballage"]) ;	
	
	if($id=="0")
		{
		 $sql="INSERT INTO `erp_bc_produits`(`code_interne`, `code_barre`, `designation`, `prix` ,`emballage`) VALUES
			('".$code."','".$code_barre."','".$designation."' ,'".$prix."' , '".$emballage."')";
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - Produit fini";
			$action="Création d'un Produit  finis :".($code);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);			
		}
	else{
			$sql="UPDATE `erp_bc_produits` SET `code_interne`='".$code."',`designation`='".$designation."',`code_barre`='".$code_barre."',`prix`='".$prix."' , `emballage`='".$emballage."' WHERE id=".$id;
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - PF";
			$action="Modification d'un Produit  finis :".($code);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);			
		}
		$req=mysql_query($sql);

		// echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	
	$code				=	"";
	$code_barre			=	"";
	$designation		=	"";
	$prix		    	=	"";
    $emballage          =   "" ; 
	
	$req="select * from erp_bc_produits where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code				=	$enreg["code_interne"] ;
		$designation		=	$enreg["designation"] ;
		$prix		    	=	$enreg["prix"] ;
        $code_barre			=	$enreg["code_barre"] ;
        $emballage          =   $enreg["emballage"] ; 
	}
	
	?>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
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
                            <form action="" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <b>Code interne (*)</b>
                                        <input class="form-control" type="text" placeholder="Code interne"
                                            value="<?php echo $code; ?>" name="code" id="code" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Code à barre (*)</b>
                                        <input class="form-control" type="text" placeholder="Code à barre"
                                            value="<?php echo $code_barre; ?>" name="code_barre" id="code_barre"
                                            required>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Désignation (*)</b>
                                        <input class="form-control" type="text" placeholder="Désignation"
                                            value="<?php echo $designation; ?>" id="example-text-input"
                                            name="designation" required>
                                    </div>
                                    <div class="col-xl-3">
                                        <b>Type d'emballage</b>
                                        <select class="form-control select2" name="emballage">
                                            <option value=""> Sélectionner un type d'emballage </option>
                                            <?php
												$req="select * from erp_bc_emballage order by type";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                            <option value="<?php echo $enreg['id']; ?>"
                                                <?php if($emballage==$enreg['id']) {?> selected <?php } ?>>
                                                <?php echo $enreg['type']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Prix de vente par défaut (*)</b>
                                        <input class="form-control" type="number" placeholder="Prix de vente par défaut"
                                            value="<?php echo $prix; ?>" id="example-text-input" name="prix" required>
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
            <?php } ?>

            <?php
$reqMp="";
$mp="";
if(isset($_POST['mp'])){
	if(is_numeric($_POST['mp'])){
		$mp				=	$_POST['mp'];
		$reqMp			=	" and  id=".$mp;
	}
}

?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Liste des produits</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des produits finis</b>
                                            <select class="form-control select2" name="mp">
                                                <option value=""> Sélectionner un produit fini </option>
                                                <?php
												$req="select * from erp_bc_produits order by code_interne";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                                <option value="<?php echo $enreg['id']; ?>"
                                                    <?php if($mp==$enreg['id']) {?> selected <?php } ?>>
                                                    <?php echo $enreg['designation']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                        <div class="col-xl-3">
                                            <b></b><br>
                                            <input name="SubmitContact" type="submit" id="submit"
                                                class="btn btn-primary btn-sm " value="Filtrer">
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <br>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>Code (Code interne)</b></th>
                                        <th><b>Code à barre</b></th>
                                        <th><b>Designation</b></th>
                                        <th><b>Prix</b></th>
                                        <th><b>Type d'emballage</b></th>
                                        <th><b>Etat</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	
	$code				=	"";
	$designation		=	"";
	$prix  		    	=	"" ; 
	$code_barre			=	"";
    $emballage          = "" ; 


	$req="select * from erp_bc_produits where 1=1 ".$reqMp." order by code_interne ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$code				=	$enreg["code_interne"] ;
		$designation		=	$enreg["designation"] ;
		$code_barre			=	$enreg["code_barre"] ;
        $prix	        	=	$enreg["prix"] ;
        $emballage	        =	$enreg["emballage"] ;
	
	?>
                                    <tr>
                                        <td><?php echo $code; ?></td>
                                        <td><?php echo $code_barre; ?></td>
                                        <td><?php echo $designation; ?></td>
                                        <td><?php echo $prix ?></td>
                                        <td><?php 
                                        $reqE = "select * from erp_bc_emballage where id=".$emballage ; 
                                        $queryE = mysql_query($reqE) ; 
                                        while($enregE = mysql_fetch_array($queryE)){
                                            echo $enregE["type"] ; 
                                        }
                                        ?></td>



                                        <td>
                                            <?php if($enreg['archive']==0){ ?>
                                            <b style="color:green"> Actif </b>
                                            <?php } else{ ?>
                                            <b style="color:red"> Inactif </b>
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                            <a href="gest_produit.php?ID=<?php echo $id; ?>"
                                                class="btn btn-warning waves-effect waves-light">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <?php if ($enreg["archive"]=="0"){ ?>
                                            <a href="Javascript:Archiver('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light">Archiver</a>
                                            <?php } else {?>
                                            <a href="Javascript:Unarchiver('<?php echo $id; ?>')"
                                                class="btn btn-dark waves-effect waves-light">Unarchiver</a>
                                            <?php }?>
                                            <?php } ?>

                                            <a href="Javascript:Supprimer('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light"
                                                style="background-color:brown">Supprimer</a>
                                            <a href="nomenclatures_produit.php?ID=<?php echo $id; ?>"
                                                class="btn btn-success waves-effect waves-light">Nomenclature
                                                semi-fini</a>
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