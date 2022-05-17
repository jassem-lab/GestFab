<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des classes matière première</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerclasse.php?ID=" + id;
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


	$classe		=	addslashes($_POST["classe"]) ;

	if($id=="0")
		{
			$sql="INSERT INTO `erp_bc_classe`(`classe`) VALUES
			('".$classe."' )";
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - Classe ";
			$action="Création d'une Classe:".($classe);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);			
		}
	else{
			$sql="UPDATE `erp_bc_classe` SET `classe`='".$classe."' WHERE id=".$id;
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_bc_IDUSER'];
			$document="Table de base - classe matiere ";
			$action="Modification d'une classe matiere :".($classe);
			
			$sql1="INSERT INTO `erp_bc_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);				
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$classe		=	"" ;

	$req="select * from erp_bc_classe where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$classe	=	$enreg["classe"] ;
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
                                        <b>Classe de matière (*)</b>
                                        <input class="form-control" type="text" placeholder="classe matiere "
                                            value="<?php echo $classe; ?>" id="example-text-input" name="classe" required>
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
$reqClasse="";
$classe_mp="";
if(isset($_POST['moule_mp'])){
	if(is_numeric($_POST['classe_mp'])){
		$classe_mp		=	$_POST['classe_mp'];
		$reqClasse	=	" and  id=".$classe_mp;
	}
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Liste des classes des matières</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des classes matières</b>
                                            <select class="form-control select2" name="classe_mp">
                                                <option value=""> Sélectionner une classe de matière </option>
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
                                        <th><b>Classe de matière</b></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$nom	=	"" ;
	$id		=	"0" ;		
	$i		=	"0" ;
	$req="select * from erp_bc_classe where 1=1 ".$reqClasse." order by classe ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$nom	=	$enreg["classe"] ;
		$id		=	$enreg["id"] ;			
		$i++;
	
	?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $nom; ?></td>
                                        <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                        <td>
                                            <a href="gest_classe.php?ID=<?php echo $id; ?>"
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