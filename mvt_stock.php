<?php include('menu_footer/menu.php') ?>
<?php
$reqCode="";
$code="";
if(isset($_POST['code'])){
	if(($_POST['code'])<>""){
		$code			=	$_POST['code'];
		$reqCode		=	" and  mp=".$code;
	}
}
$reqDate="";
$dat="";
if(isset($_POST['dat'])){
	if(($_POST['dat'])<>""){
		$dat				=	$_POST['dat'];
		$reqDate			=	" and  DATE>='".$dat."'";
	}
}
$reqDate1="";
$dat1="";
if(isset($_POST['dat1'])){
	if(($_POST['dat1'])<>""){
		$dat1				=	$_POST['dat1'];
		$reqDate1			=	" and  DATE<='".$dat1."'";
	}
}

?>


<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Mouvement de Stock</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h3>Mouvement de Stock </h3>
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
                                        <div class="col-xl-9">
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
                                            </div>
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>Code</b></th>
                                        <th><b>Designation</b></th>
                                        
                                        <th><b>Type de mouvement</b></th>
                                        <th><b>Date de mouvement</b></th>
                                        <th><b>Reference de mouvement</b></th>
                                        <th><b>Qte Mouvement</b></th>
                                        <th><b>Stock Actuel</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

	$date				=	"";
	$reference			=	"";
	$id					=	0;
	$montant			=	"0";
	
	 $req="select * from jointure_mouvements_articles where 1=1 ".$reqCode.$reqDate.$reqDate1." order by dateh asc "; 
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["ID"] ;	
        $Reference		    =	$enreg["REF"] ;	
		$mp		        	=	$enreg["mp"] ;
		$type		    	=	$enreg["TYPE"] ;
		$quantite			=	$enreg["quantite"] ;
		$date				=	date("d/m/Y", strtotime($enreg["DATE"]) );
		$dateh				=	date("d/m/Y", strtotime($enreg["DATEH"]) );
        

        $reqMP = "select * from erp_fab_mp where id=".$mp; 
        $queryMP = mysql_query($reqMP) ; 
        while($enregMP = mysql_fetch_array($queryMP)){
            $code = $enregMP["code"] ;  
            $designation = $enregMP["designation"] ;  
            $stockActuel = $enregMP["stock"] ;  
        }
if($type == 'INV'){
    $type = 'Inventaire' ; 
}if($type == 'BE'){
    $type = "Bon d'entré" ; 
}if($type == 'BS'){
    $type = 'Bon de sortie' ; 
}
		
?>
                                    <tr>
                                        <td><?php echo $code; ?></td>
                                        <td><?php echo $designation; ?></td>
                                        
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $Reference; ?></td>
                                        <td><?php echo $quantite; ?></td>
                                        <td><b class="badge rounded-pill text-bg-danger"><?php echo $stockActuel; ?></b></td>


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



<?php include('menu_footer/footer.php') ?>