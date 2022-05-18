<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des phases de fabrications</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerphases.php?ID=" + id;
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


	$description		=	addslashes($_POST["description"]) ;
	$code	        	=	addslashes($_POST["code"]) ;
	
	if($id=="0")
		{
			$sql="INSERT INTO `erp_bc_services`(`code`,`description`) VALUES
			('".$description."','".$code."' )";
		}
	else{
			$sql="UPDATE `erp_bc_services` SET `code`='".$code."',`description`='".$description."' WHERE id=".$id;
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$description		=	"" ;
	$code       		=	"" ;
	$req="select * from erp_bc_services where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code       	=	$enreg["code"] ;
		$description	=	$enreg["description"] ;
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

                                    <div class="col-lg-2" id="" style="">
                                        <b>Code</b>
                                        <br>
                                        <input name="code" type="text" id="code" class="form-control"
                                            value="<?php echo $code ?>" placeholder="Code..." />
                                    </div>
                                    <div class="col-lg-3" id="" style="">
                                        <b>Description</b>
                                        <br>
                                        <input name="description" type="text" id="description" class="form-control"
                                            placeholder="Description ..." value="<?php echo $description ?>" />
                                    </div>
                                    <div class="col-sm-2"><br>
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
            <?php }?>

            <?php
$reqphase="";
$phase_mp="";
if(isset($_POST['phase_mp'])){
	if(is_numeric($_POST['phase_mp'])){
		$phase_mp		=	$_POST['phase_mp'];
		$reqphase		=	" and  id=".$phase_mp;
	}
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Liste des services supplémentaires</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des services</b>
                                            <select class="form-control select2" name="phase_mp">
                                                <option value=""> Sélectionner un service </option>
                                                <?php
												$req="select * from erp_bc_services order by code";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                                <option value="<?php echo $enreg['id']; ?>"
                                                    <?php if($phase_mp==$enreg['id']) {?> selected <?php } ?>>
                                                    <?php echo $enreg['code']; ?></option>
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
                                        <th><b>Code</b></th>
                                        <th><b>Description</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$description	=	"" ;
	$code		=	""  ;		

	
	$req="select * from erp_bc_services where 1=1 ".$reqphase;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$description	=	$enreg["description"] ;
		$code		=	$enreg["code"] ;			
        $id         =   $enreg["id"] ; 
	
		
	?>
                                    <tr>
                                        <td><?php echo $description ; ?></td>
                                        <td><?php echo $code ; ?></td>
                                        <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                        <td>
                                            <a href="gest_services.php?ID=<?php echo $id; ?>"
                                                class="btn btn-warning waves-effect waves-light">Modifier</a>
                                            <?php 
												/*$reqc='select * from telec_requete where idclient='.$id;
												$queryc=mysql_query($reqc);
												$numc=mysql_num_rows($queryc);
												if($numc=='0'){ ?>
                                            <a href="Javascript:Supprimer('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light"
                                                style="background-color:brown">Supprimer</a>
                                            <?php }*/ ?>
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