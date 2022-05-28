<?php include('menu_footer/menu.php') ?>

<script>
function Imprimer() {
    if (confirm('Confirmez-vous cette action?')) {
        var myMODELE_A4 = window.open("print/imprimer_MPC.php",
            "toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=700, height=600");
    }
}
</script>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">MPs à Commmander</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
$reqCode="";
$code="";
if(isset($_POST['code'])){
	if(($_POST['code'])<>""){
		$code			=	$_POST['code'];
		$reqCode		=	" and  id=".$code;
	}
}

?> <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Liste des matières premières</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Liste des codes</b>
                                            <select class="form-control select2" name="code">
                                                <option value=""> Sélectionner un code </option>
                                                <?php
												$req="select * from erp_fab_mp order by code";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
                                                <option value="<?php echo $enreg['id']; ?>"
                                                    <?php if($code==$enreg['id']) {?> selected <?php } ?>>
                                                    <?php echo $enreg['code']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-xl-2">
                                            <form name="SubmitContact" class="" method="post" action="">
                                                <b>Affichage par</b>
                                                <select class="form-control select2" name="limit-records"
                                                    id="limit-records">
                                                    <option value="20"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==20){ ?>
                                                        selected <?php }} ?>>20 MPs</option>
                                                    <option value="50"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==50){ ?>
                                                        selected <?php }} ?>>50 MPs</option>
                                                    <option value="10"
                                                        <?php if (isset($_POST['limit-records'])){ if($_POST['limit-records']==100){ ?>
                                                        selected <?php }} ?>>100 MPs</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-xl-3">
                                            <b></b><br>
                                            <input name="SubmitContact" type="submit" id="submit"
                                                class="btn btn-primary btn-sm " value="Filtrer">
                                            <a href="javascript:Imprimer()"
                                                class="btn btn-warning waves-effect waves-light"
                                                style="background-color: blue;color: white;">
                                                <span class="glyphicon glyphicon-print"></span>
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </form>
                            <br>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th><b>Code</b></th>
                                        <th><b>Désignation</b></th>
                                        <th><b>Code à barre</b></th>
                                        <th><b>Provenance</b></th>
                                        <th><b>Unité</b></th>
                                        <th><b>Prix d'achat</b></th>
                                        <th><b>Seuil d’approvisionnement </b></th>
                                        <th><b>MP Consommable </b></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
	$req="select * from erp_fab_mp where 1=1 ".$reqCode." order by code";
	$query=mysql_query($req);
	$total=mysql_num_rows($query);
	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	} else{
		$page = 1;
	}
	if(isset($_POST['limit-records'])){
		$limit = $_POST['limit-records'];
	} else{
		$limit = 20;
	}
	if(isset($_GET['limit'])){
		$limit = $_GET['limit'];
	}											
	$start		 = ($page - 1) * $limit;
	$page 		 = ceil( $total / $limit );						
	$Previous    = $page - 1;
	$Next 		 = $page + 1;	
	
	$code				=	"" ;
	$code_barre			=	"" ;	
	$designation		=	"" ;		
	$prix				=	"0" ;
	$type				=	"" ;	
	$i					=	0;
	$req="select * from erp_fab_mp where 1=1 and stock >= seuil".$reqCode." order by code  LIMIT $start, $limit";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$code				=	$enreg["code"] ;
		$code_barre			=	$enreg["code_barre"] ;
		$designation		=	$enreg["designation"] ;		
		$prix				=	$enreg["px_achat"] ;
		$unite				=	$enreg["unite"] ;
		$i++;
		
		$provenance="";
		$req1="select * from erp_fab_classe where id=".$enreg['provenance'];
		$query1=mysql_query($req1);
		while($enreg1=mysql_fetch_array($query1)){
			$provenance	=	$enreg1['classe'];
		}
		
		if($enreg['consommable']==1){
			$consommable 	=	'Oui';
		} else{
			$consommable 	=	'Non';
		}
	?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $code; ?></td>
                                        <td><?php echo $designation; ?></td>
                                        <td><?php echo $code_barre; ?></td>
                                        <td><?php echo $provenance; ?></td>
                                        <td><?php echo $unite; ?></td>
                                        <td><?php echo $prix; ?></td>
                                        <td><?php echo $enreg['seuil']; ?></td>
                                        <td><?php echo $consommable; ?></td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="mp_commander.php?page=<?php echo $Previous; ?>&limit=<?php echo $limit;?>">Précédente</a>
                                </li>
                                <?php 
												for($i=1;$i<=$page;$i++){
											?>
                                <li class="page-item"><a class="page-link"
                                        href="mp_commander.php?page=<?php echo $i; ?>&limit=<?php echo $limit;?>"><?php echo $i; ?></a>
                                </li>
                                <?php } ?>
                                <li class="page-item"><a class="page-link"
                                        href="mp_commander.php?page=<?php echo $Next; ?>&limit=<?php echo $limit;?>">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<?php include('menu_footer/footer.php') ?>