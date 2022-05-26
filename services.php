<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des services (Phase de fabrication) </h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
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


	$service		=	addslashes($_POST["service"]) ;

	if($id=="0")
		{
			$sql="INSERT INTO `erp_fab_service`(`service`) VALUES
			('".$service."' )";			
		}
	else{
			$sql="UPDATE `erp_fab_service` SET `service`='".$service."' WHERE id=".$id;				
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$service		=	"" ;

	$req="select * from erp_fab_service where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$service	=	$enreg["service"] ;
	}
	
	?>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <?php if($_SESSION['erp_fab_PROFIL']==1){ ?>
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
                                        <b>Services (*)</b>
                                        <input class="form-control" type="text" placeholder="service (Phase de fabrication)"
                                            value="<?php echo $service; ?>" id="example-text-input" name="service" required>
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
                            <h3>Liste des services</h3>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th><b>Services</b></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$nom	=	"" ;
	$id		=	"0" ;		
	$i		=	"0" ;
	$req="select * from erp_fab_service where 1=1 order by service ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$nom	=	$enreg["service"] ;
		$id		=	$enreg["id"] ;			
		$i++;
	
	?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $nom; ?></td>
                                        <?php if($_SESSION['erp_fab_PROFIL']==1){ ?>
                                        <td>
                                            <a href="services.php?ID=<?php echo $id; ?>"
                                                class="btn btn-warning waves-effect waves-light">Modifier</a>

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