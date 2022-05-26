<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des produits semi-finis</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerpf.php?ID=" + id;
        }
    }

    function Dupliquer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/dupliquerpf.php?ID=" + id;
        }
    }

    function Archiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/archiverpf.php?ID=" + id;
        }
    }

    function Unarchiver(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/unarchiverpf.php?ID=" + id;
        }
    }

    function Imprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            var myMODELE_A4 = window.open("print/imprimerpsf.php?ID=" + id, "_blank",
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
	$moule		    	=	addslashes($_POST["moule"]) ;	
	
	if($id=="0")
		{
                $reqverif="select * from erp_bc_produitsf where code_barre =".$code_barre;
                $queryverif=mysql_query($reqverif);
                if(mysql_num_rows($queryverif)>0){
                    $Emp = "0" ; 
                    while($enregEC = mysql_fetch_array($queryverif)){
                        $Emp = $enregEC["code_interne"] ; 
                    }
                    echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="gest_MP.php?Emp='.$Emp.'&err=1" </SCRIPT>';  
                    exit;
                }
                
                $sql="INSERT INTO `erp_bc_produitsf`(`code_interne`, `code_barre`, `designation`, `moule`) VALUES
			('".$code."','".$code_barre."','".$designation."' ,'".$moule."')";
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - Psf";
			$action="Création d'un Produit semi finis :".($code);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);			
		}
	else{
			$sql="UPDATE `erp_bc_produits` SET `code_interne`='".$code."',`designation`='".$designation."',`code_barre`='".$code_barre."',`moule`='".$moule."' WHERE id=".$id;
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - FP";
			$action="Modification d'un Produit semi finis :".($code);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);			
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	
	$code				=	"";
	$code_barre			=	"";
	$designation		=	"";
	$moule		    	=	"";

	
	$req="select * from erp_bc_produitsf where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
        $id                 =   $enreg["id"] ; 
		$code				=	$enreg["code_interne"] ;
		$designation		=	$enreg["designation"] ;
		$moule		    	=	$enreg["moule"] ;
        $code_barre			=	$enreg["code_barre"] ;

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
                            <?php if(isset($_GET['err'])){ ?>
                            <?php if($_GET['err']=='1'){ ?>
                            <font color="red" style="background-color:#FFFFFF;">
                                <center>Enregistrement n'est pas effectué car le Code a barre existe déja dans la
                                    matiere premiere : <?php echo $_GET["Emp"] ; ?></center>
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
                                    <div class="col-md-3">
                                        <b>Moule (*)</b>
                                        <select name="moule" id="moule" class="form-control select2" required>
                                            <option value="">Sélectionner une moule</option>
                                            <?php
											$reqfam="select * from erp_bc_moule";
											$queryfam=mysql_query($reqfam);
											while($enregfam=mysql_fetch_array($queryfam)) {
											?>
                                            <option value="<?php echo $enregfam['id']; ?>"
                                                <?php if($enregfam['id']==$moule){ ?> selected <?php } ?>>
                                                <?php echo $enregfam['moule']; ?>
                                            </option>


                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <br>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Enregistrer
                                        </button>
                                        <input class="form-control" type="hidden" name="enregistrer_mail">
                                        <a href="javascript:Imprimer('<?php echo $code; ?>')"
                                            class="btn btn-warning waves-effect waves-light"
                                            style="background-color: blue;color: white;">
                                            <span class="glyphicon glyphicon-print"></span>
                                        </a>
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
                            <h3>Liste des produits semi-finis</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des produits semi-finis</b>
                                            <select class="form-control select2" name="mp">
                                                <option value=""> Sélectionner un produit semi-fini </option>
                                                <?php
												$req="select * from erp_bc_produitsf order by code_interne";
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
                                        <th><b>Moule</b></th>
                                        <th><b>Prix Unitaire</b></th>
                                        <th><b>Etat</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	
	$code				=	"";
	$designation		=	"";
	$moule  			=	"";
	$code_barre			=	"";
    $prix               =   ""; 

	$req="select * from erp_bc_produitsf where 1=1 ".$reqMp." order by code_interne ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$code				=	$enreg["code_interne"] ;
		$designation		=	$enreg["designation"] ;
		$moule	        	=	$enreg["moule"] ;
		$code_barre			=	$enreg["code_barre"] ;
        $prix               =   $enreg["prix"] ; 
	$reqP="select * from erp_bc_nomenclatures where 1=1 and code_produit=".$id ; 
    $queryP = mysql_query($reqP);
    while($enregP= mysql_fetch_array($queryP)){
        $quantite   =  $enregP["quantite"]  ;
    }

    
	?>
                                    <tr>
                                        <td><?php echo $code; ?></td>
                                        <td><?php echo $code_barre; ?></td>
                                        <td><?php echo $designation; ?></td>
                                        <td><?php
                                        $reqM = "select * from erp_bc_moule where id =".$moule ;
                                        $queryM = mysql_query($reqM) ; 
                                        while($enregM = mysql_fetch_array($queryM)){
                                            echo $enregM["moule"] ; 
                                        }
                                        ?></td>
                                        <td><?php echo $prix ?></td>
                                        <td>
                                            <?php if($enreg['archive']==0){ ?>
                                            <b style="color:green"> Actif </b>
                                            <?php } else{ ?>
                                            <b style="color:red"> Inactif </b>
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                            <a href="gest_produitsf.php?ID=<?php echo $id; ?>"
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


                                            <a href="nomenclatures.php?ID=<?php echo $id; ?>"
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