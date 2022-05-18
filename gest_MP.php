<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des  matières premières</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerMP.php?ID=" + id;
        }
    }
    </script>
    <?php

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
	}else{
		$id = "0";
	}
    $reqClasse="";
    $classe_mp="";
    if(isset($_POST['moule_mp'])){
        if(is_numeric($_POST['classe_mp'])){
            $classe_mp		=	$_POST['classe_mp'];
            $reqClasse	=	" and  id=".$classe_mp;
        }
    }

if(isset($_POST['enregistrer_mail'])){	


	$classe	        	=	addslashes($_POST["classe_mp"]) ;
	$code_interne		=	addslashes($_POST["code_interne"]) ;
	$code_abarre	    	=	addslashes($_POST["code_abarre"]) ;
	$designation		=	addslashes($_POST["designation"]) ;
	$prix		        =	addslashes($_POST["prix"]) ;

	if($id=="0")
		{
			$sql="INSERT INTO `erp_bc_mp`(`classe` ,`codeinterne` ,`code_abarre` ,`designation` , `prix`) VALUES
			('".$classe."' ,'".$code_interne."' ,'".$code_abarre."' ,'".$designation."' ,'".$prix."')";
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de MP";
			$action="Création d'une MP:".($classe);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);			
		    }
	        else{
			$sql="UPDATE `erp_bc_mp` SET `classe`='".$classe."' , `codeinterne`='".$code_interne."' , `code_abarre` = '".$code_abarre."' , `designation`='".$designation."',`prix`='".$prix."' WHERE id=".$id;
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - MP ";
			$action="Modification d'une MP :".($classe);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);				
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$classe		    = "" ;
    $code_interne   = "" ; 
    $code_abarre    = "" ; 
    $designation    = "" ; 
    $prix           = "" ; 

	$req="select * from erp_bc_mp where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id         	=	$enreg["id"] ;
		$classe     	=	$enreg["classe"] ;
		$code_interne	=	$enreg["codeinterne"] ;
		$code_abarre	=	$enreg["code_abarre"] ;
		$designation	=	$enreg["designation"] ;
		$prix	        =   $enreg["prix"] ;
	}
	
	?>


    <?php
$reqClasse              ="";
$classe_LP              ="";
if(isset($_POST['classe_LP'])){
	if(is_numeric($_POST['classe_LP'])){
		$classe_LP		=	$_POST['classe_LP'];
		$reqClasse  	=	" and classe=".$classe_LP;
	}
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
                                            value="<?php echo $code_interne; ?>" id="example-text-input"
                                            name="code_interne" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Code à barre (*)</b>
                                        <input class="form-control" type="text" placeholder="Code à barre"
                                            value="<?php echo $code_abarre; ?>" id="example-text-input"
                                            name="code_abarre" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Désignation (*)</b>
                                        <input class="form-control" type="text" placeholder="Désignation"
                                            value="<?php echo $designation; ?>" id="example-text-input"
                                            name="designation" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Prix d’achat unitaire (*)</b>
                                        <input class="form-control" type="text" placeholder="Prix d’achat unitaire"
                                            value="<?php echo $prix; ?>" id="example-text-input" name="prix" required>
                                    </div>
                                    <div class="col-xl-3">
                                        <b>Liste des provenances des matières</b>
                                        <select class="form-control select2" name="classe_mp">
                                            <option value=""> Sélectionner une provenance de matière</option>
                                            <?php
												$req="select * from erp_bc_classe order by classe";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                            <option value="<?php echo $enreg['id']; ?>"
                                                <?php if($classe_mp==$enreg['id']) {?> selected <?php } ?>>
                                                <?php echo $enreg['classe']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-3"><br>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Liste des MPs</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des provenances des matières</b>
                                            <select class="form-control select2" name="classe_LP">
                                                <option value=""> Sélectionner une provenance de matière </option>
                                                <?php
												$req="select * from erp_bc_classe order by classe";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                                <option value="<?php echo $enreg['id']; ?>"
                                                    <?php if($classe_LP==$enreg['id']) {?> selected <?php } ?>>
                                                    <?php echo $enreg['classe']; ?></option>
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
                                        <th><b>Provenance de matière</b></th>
                                        <th><b>Code interne</b></th>
                                        <th><b>Code à barre</b></th>
                                        <th><b>Designation</b></th>
                                        <th><b>Prix</b></th>
                                        <th><b>Action</b></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$nom	=	"" ;
	$id		=	"0" ;		
	$i		=	"0" ;
   
    $req="select * from erp_bc_mp where 1=1 ".$reqClasse." order by classe ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$nom	=	$enreg["classe"] ;
		$code_abarre	=	$enreg["code_abarre"] ;
		$code_interne	=	$enreg["codeinterne"] ;
		$designation	=	$enreg["designation"] ;
		$prix	=	$enreg["prix"] ;
		$id		=	$enreg["id"] ;			
		$i++;
	
	?>
                                    <tr>
                                        <td><?php 
                                        $reqC = "select * from erp_bc_classe where id=".$nom ; 
                                        $queryC = mysql_query($reqC) ; 
                                        while($enregC = mysql_fetch_array($queryC)){
                                            echo $enregC["classe"] ; 
                                        }
                                        ?></td>
                                        <td><?php echo $code_interne; ?></td>
                                        <td><?php echo $code_abarre; ?></td>
                                        <td><?php echo $designation; ?></td>
                                        <td><?php echo $prix; ?></td>
                                        <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                        <td>
                                            <a href="gest_MP.php?ID=<?php echo $id; ?>"
                                                class="btn btn-warning waves-effect waves-light">Modifier</a>


                                            <a href="Javascript:Supprimer('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light"
                                                style="background-color:brown">Supprimer</a>

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