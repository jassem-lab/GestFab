<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des moules semi-finis</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimermoule.php?ID=" + id;
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


	$moule		=	addslashes($_POST["moule"]) ;

	if($id=="0")
		{
			$sql="INSERT INTO `erp_bc_moule`(`moule`) VALUES
			('".$moule."' )";
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - Moule SF ";
			$action="Création d'une Moule SF :".($moule);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);			
		}
	else{
			$sql="UPDATE `erp_bc_moule` SET `moule`='".$moule."' WHERE id=".$id;
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - Moule PF ";
			$action="Modification d'une Moule SF :".($moule);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);				
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$moule		=	"" ;

	$req="select * from erp_bc_moule where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$moule	=	$enreg["moule"] ;
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
                                    <div class="col-sm-4">
                                        <b>moules semi-finis (*)</b>
                                        <input class="form-control" type="text" placeholder="moule semi-finis "
                                            value="<?php echo $moule; ?>" id="example-text-input" name="moule" required>
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

            <?php
$reqMoule="";
$moule_mp="";
if(isset($_POST['moule_mp'])){
	if(is_numeric($_POST['moule_mp'])){
		$moule_mp		=	$_POST['moule_mp'];
		$reqMoule	=	" and  id=".$moule_mp;
	}
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Liste des moules SF</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des moules</b>
                                            <select class="form-control select2" name="moule_mp">
                                                <option value=""> Sélectionner une moule </option>
                                                <?php
												$req="select * from erp_bc_moule order by moule";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                                <option value="<?php echo $enreg['id']; ?>"
                                                    <?php if($moule_mp==$enreg['id']) {?> selected <?php } ?>>
                                                    <?php echo $enreg['moule']; ?></option>
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
                                        <th><b>#</b></th>
                                        <th><b>Moule</b></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$nom	=	"" ;
	$id		=	"0" ;		
	$i		=	"0" ;
	$req="select * from erp_bc_moule where 1=1 ".$reqMoule." order by moule ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$nom	=	$enreg["moule"] ;
		$id		=	$enreg["id"] ;			
		$i++;
	
	?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $nom; ?></td>
                                        <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                        <td>
                                            <a href="gest_moule.php?ID=<?php echo $id; ?>"
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