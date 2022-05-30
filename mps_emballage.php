<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Matières premières emballage</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimeremplacement.php?ID=" + id;
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
	$designation		=	addslashes($_POST["designation"]) ;
	$quantite			=	addslashes($_POST["quantite"]) ;

	if($id=="0")
		{
			$sql="INSERT INTO `erp_fab_mp_emballage`(`code`, `designation`, `quantite`) VALUES 
			('".$code."','".$designation."','".$quantite."' )";
				
		}
	else{
			$sql="UPDATE `erp_fab_mp_emballage` SET code='".$code."',designation='".$designation."',quantite='".$quantite."' WHERE id=".$id;
				
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$code				=	"" ;
	$designation		=	"" ;
	$quantite			=	"" ;
	
	$req="select * from `erp_fab_mp_emballage` where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code			=	$enreg["code"] ;
		$designation	=	$enreg["designation"] ;
		$quantite		=	$enreg["quantite"] ;
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
                                    <div class="col-sm-3">
                                        <b>Code(*)</b>
                                        <input class="form-control" type="text" placeholder="Référence  "
                                            value="<?php echo $code; ?>" id="example-text-input" name="code" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <b>Désignation(*)</b>
                                        <input class="form-control" type="text" placeholder="Désignation  "
                                            value="<?php echo $designation; ?>" id="example-text-input" name="designation" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <b>Quantité nécessaire(*)</b>
                                        <input class="form-control" type="number" placeholder="Quantité"
                                            value="<?php echo $quantite; ?>" id="example-text-input" name="quantite" required>
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
                            <br>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th><b>Code</b></th>
										<th><b>Désignation</b></th>
										<th><b>Quantité nécessaire</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$code	=	"";
	$des	=	"" ;
	$qte	=	0 ;
	$id		=	"0" ;		
	$i		=	"0" ;
	$req="select * from erp_fab_mp_emballage order by code ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$code	=	$enreg["code"] ;
		$des	=	$enreg["designation"] ;
		$qte	=	$enreg["quantite"] ;
		$id		=	$enreg["id"] ;			
		$i++;
	
	?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $code; ?></td>
										 <td><?php echo $des; ?></td>
										<td><?php echo $qte; ?></td>
                                        <?php if($_SESSION['erp_bc_PROFIL']==1){ ?>
                                        <td>
                                            <a href="mps_emballage.php?ID=<?php echo $id; ?>"
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