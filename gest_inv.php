<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Gestion des inventaires de stock</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function Supprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/supprimerinventaire.php?ID=" + id;
        }
    }

    function MAJ(id) {
        if (confirm('Confirmez-vous cette action?')) {
            document.location.href = "page_js/majnventaire.php?ID=" + id;
        }
    }

    function Imprimer(id) {
        if (confirm('Confirmez-vous cette action?')) {
            var myMODELE_A4 = window.open("print/imprimer_inventaire.php?ID=" + id, "_blank",
                "toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=700, height=600");
        }
    }
    </script>

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <?php
$reqDate="";
$dat="";
if(isset($_POST['dat'])){
	if(($_POST['dat'])<>""){
		$dat				=	$_POST['dat'];
		$reqDate			=	" and  date<='".$dat."'";
	}
}
$reqDate1="";
$dat1="";
if(isset($_POST['dat1'])){
	if(($_POST['dat1'])<>""){
		$dat1				=	$_POST['dat1'];
		$reqDate1			=	" and  date>='".$dat1."'";
	}
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <a href="addedit_inventaire.php" class="btn btn-primary waves-effect waves-light">Ajouter un
                                inventaire de stock</a>
                            <h3>Liste des inventaires</h3>
                            <form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <b>Du</b>
                                            <input type="date" class="form-control" id="dat" name="dat"
                                                value="<?php echo $dat; ?>">
                                        </div>
                                        <div class="col-xl-3">
                                            <b>Au</b>
                                            <input type="date" class="form-control" id="dat1" name="dat1"
                                                value="<?php echo $dat1; ?>">
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
                                        <th><b>Référence</b></th>
                                        <th><b>Type</b></th>
                                        <th><b>Date</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$date				=	"";
	$reference			=	"";
	$id					=	0;
	$montant			=	"0";
	
	 $req="select * from erp_fab_inventaire where 1=1 ".$reqDate.$reqDate1." order by date desc "; 
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$reference			=	$enreg["reference"] ;
		$date				=	date("d/m/Y", strtotime($enreg["date"]) );
		$type				=	"";
		if($enreg['type']==1){
			$type				=	"Inventaire des produits semis-finis";
		} else{
			$type				=	"Inventaire des matières premières";
		}
		
?>
                                    <tr>
                                        <td><?php echo $reference; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td>
                                            <?php if($enreg['etat']==0){ ?>

                                            <a href="Javascript:Supprimer('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light"
                                                style="background-color:brown">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                            <a href="Javascript:MAJ('<?php echo $id; ?>')"
                                                class="btn btn-danger waves-effect waves-light"
                                                style="background-color:green">
                                                Mise à jours de stock
                                            </a>
                                            <?php } else{ ?>
                                            <b style="color:green">Mise à jours de stock a été effectué</b>
                                            <?php } ?>
                                            <a href="javascript:Imprimer('<?php echo $id; ?>')"
                                                class="btn btn-warning waves-effect waves-light"
                                                style="background-color: blue;color: white;">
                                                <span class="glyphicon glyphicon-print"></span>
                                            </a>
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