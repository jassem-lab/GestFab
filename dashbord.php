<?php include ("menu_footer/menu.php"); ?>





<?php 

$reqbc_sf = "select * from erp_fab_bc" ; 
$querybc_sf = mysql_query($reqbc_sf); 
$bc=mysql_num_rows($querybc_sf);

$reqBS = "select * from erp_fab_bs"; 
$queryBS = mysql_query($reqBS) ; 
$BS = mysql_num_rows($queryBS) ; 

$reqCF = "select * from erp_fab_bcf";
$queryCF = mysql_query($reqCF) ; 
$CF = mysql_num_rows($queryCF) ; 

$reqBE = "select * from erp_fab_be"; 
$queryBE = mysql_query($reqBE) ; 
$BE = mysql_num_rows($queryBE) ; 

$reqPF = "SELECT  *  FROM `erp_fab_produits` WHERE semi =0" ; 
$queryPF = mysql_query($reqPF); 
$PF = mysql_num_rows($queryPF) ; 

$reqPSF = "SELECT  * FROM `erp_fab_produits` WHERE semi =1" ; 
$queryPSF = mysql_query($reqPSF); 
$PSF = mysql_num_rows($queryPSF) ; 

$reqC = "SELECT  * FROM `erp_fab_mp` WHERE consommable =1" ; 
$queryC = mysql_query($reqC); 
$NC = mysql_num_rows($queryC) ; 

$reqNC = "SELECT  * FROM `erp_fab_mp` WHERE consommable =0" ; 
$queryNC = mysql_query($reqNC); 
$NNC = mysql_num_rows($queryNC) ; 

$reqMPC = "select * from erp_fab_mp where 1=1 and stock >= seuil ";
$queryMPC = mysql_query($reqMPC) ; 
$MPC = mysql_num_rows($queryMPC) ; 

$ReqSFStockSécurité = "SELECT * FROM `erp_fab_produits` WHERE stock < seuil AND semi = 0";
$querySFS = mysql_query($ReqSFStockSécurité) ; 
$SFStockSecurite = mysql_num_rows($querySFS) ; 

$ReqPFStockSécurité = "SELECT * FROM `erp_fab_produits` WHERE stock < seuil AND semi = 1";
$queryPFS = mysql_query($ReqPFStockSécurité) ; 
$PFStockSecurite = mysql_num_rows($queryPFS) ; 


$CommandeFournisseur = array(
    array("label"=> "1", "y"=> 82),
    array("label"=> "2", "y"=> 63),
    array("label"=> "3", "y"=> 54),
    array("label"=> "4", "y"=> 70),
    array("label"=> "5", "y"=> 20),
    array("label"=> "6", "y"=> 90),
    array("label"=> "7", "y"=> 63),
    array("label"=> "8", "y"=> 78),
    array("label"=> "9", "y"=> 87),
    array("label"=> "10", "y"=> 41),
    array("label"=> "11", "y"=> 52),
    array("label"=> "12", "y"=> 93),
);
$CommandeClient = array(
    array("label"=> "1", "y"=> 47),
    array("label"=> "2", "y"=> 14),
    array("label"=> "3", "y"=> 80),
    array("label"=> "4", "y"=> 67),
    array("label"=> "5", "y"=> 24),
    array("label"=> "6", "y"=> 80),
    array("label"=> "7", "y"=> 56),
    array("label"=> "8", "y"=> 13),
    array("label"=> "9", "y"=> 97),
    array("label"=> "10", "y"=> 87),
    array("label"=> "11", "y"=> 10),
    array("label"=> "12", "y"=> 78),
);


?>

<div class="wrapper">
    <div class="page-title-box">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="state-information d-none d-sm-block">

                    </div>

                    <h4 class="page-title">Tableau de bord</h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_bc_USER']; ?>
                    <br>
                </div>
            </div>
        </div>

    </div>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6" style="">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Nombre
                                                MP Non Consommable</b>
                                        </h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $NNC; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6" style="">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Nombre
                                                MP Consommable</b>
                                        </h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $NC; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6" style="">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Nombre
                                                Produits Semi Finis</b>
                                        </h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $PSF; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6" style="">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Nombre
                                                Produits Finis</b>
                                        </h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $PF; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6" style="">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Bon de
                                                commande Client</b>
                                        </h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $bc; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Bon de
                                                sortie de stock</b></h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $BS; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Bon de
                                                Commande Fournisseur</b></h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $CF; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6" style="">
                    <div class="card bg-primary mini-stat position-relative">
                        <div class="card-body" style="background-color:#068afb73">
                            <div class="mini-stat-desc">
                                <h6 class="text-uppercase verti-label text-white-50"></h6>
                                <div class="text-white">
                                    <a href="#">
                                        <h6 class="text-uppercase mt-0 text-white-50"><b style="color: white">Bon
                                                d'entré de stock</b>
                                        </h6>
                                    </a>
                                    <h3 class="mb-3 mt-0" style="color: white"><?php echo $BE; ?></h3>
                                </div>
                                <div class="mini-stat-icon">
                                    <i class="mdi mdi-briefcase-check display-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <h5><strong>MP Commandé ( Limité par 5 )</strong></h5>
                        <a class="btn btn-light ml-5" href="val_stock_mp.php">Voir plus <span
                                class="badge rounded-pill text-bg-danger">
                                <?php echo $MPC ?>
                            </span></a>
                    </div>
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th><b>#</b></th>
                                <th><b>Code</b></th>
                                <th><b>Désignation</b></th>
                                <th><b>Stock</b></th>
                                <th><b>Seuil</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $i				=	    0;

            $req = "select * from erp_fab_mp where 1=1 and stock >= seuil LIMIT 5;";
            $query = mysql_query($req) ;
            while($enreg=mysql_fetch_array($query))  {
                $id					=	$enreg["id"] ;	
                $code				=	$enreg["code"] ;
                $designation		=	$enreg["designation"] ;		
                $i++;
            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $code; ?></td>
                                <td><?php echo $designation; ?></td>
                                <td><span class="badge rounded-pill text-bg-info"><?php echo $enreg["stock"]; ?></span>
                                </td>
                                <td><span
                                        class="badge rounded-pill text-bg-danger"><?php echo $enreg['seuil']; ?></span>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <h5><strong>Stock produits Semi finis inférieur au stock de sécruité</strong></h5>
                        <a class="btn btn-light ml-5" href="FinferieurStock.php">Voir plus <span
                                class="badge rounded-pill text-bg-danger">
                                <?php echo $SFStockSecurite ?>
                            </span></a>
                    </div>
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th><b>#</b></th>
                                <th><b>Code</b></th>
                                <th><b>Désignation</b></th>
                                <th><b>Stock</b></th>
                                <th><b>Seuil</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $i				=	    0;

            $req = "SELECT *
            FROM `erp_fab_produits`
            WHERE stock < seuil
            AND semi = 0
            LIMIT 5";
            $query = mysql_query($req) ;
            while($enreg=mysql_fetch_array($query))  {
                $id					=	$enreg["id"] ;	
                $code				=	$enreg["code"] ;
                $designation		=	$enreg["designation"] ;		
                $i++;
            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $code; ?></td>
                                <td><?php echo $designation; ?></td>
                                <td><span class="badge rounded-pill text-bg-info"><?php echo $enreg["stock"]; ?></span>
                                </td>
                                <td><span
                                        class="badge rounded-pill text-bg-danger"><?php echo $enreg['seuil']; ?></span>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4">
                    <div class="row">
                        <h5><strong>Stock produits finis inférieur au stock de sécruité</strong></h5>
                        <a class="btn btn-light ml-5" href="SFinferieurStock.php">Voir plus <span
                                class="badge rounded-pill text-bg-danger">
                                <?php echo $PFStockSecurite ?>
                            </span></a>
                    </div>
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th><b>#</b></th>
                                <th><b>Code</b></th>
                                <th><b>Désignation</b></th>
                                <th><b>Stock</b></th>
                                <th><b>Seuil</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $i				=	    0;

            $req = "SELECT *
            FROM `erp_fab_produits`
            WHERE stock < seuil
            AND semi = 1
            LIMIT 5";
            $query = mysql_query($req) ;
            while($enreg=mysql_fetch_array($query))  {
                $id					=	$enreg["id"] ;	
                $code				=	$enreg["code"] ;
                $designation		=	$enreg["designation"] ;		
                $i++;
            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $code; ?></td>
                                <td><?php echo $designation; ?></td>
                                <td><span class="badge rounded-pill text-bg-info"><?php echo $enreg["stock"]; ?></span>
                                </td>
                                <td><span
                                        class="badge rounded-pill text-bg-danger"><?php echo $enreg['seuil']; ?></span>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>


            </div>

            <!-- DEMANDE MISE EN PEINTURE GRAPH -->
            <div class="row" style="margin : 150px">
                <div class="col-xl-6">
                    <div id="commandeFournisseur" style="height: 270px; width: 100%;"></div>
                </div>
                <div class="col-xl-6">
                    <div id="commandeClient" style="height: 270px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>







    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
    window.onload = function() {

        var chart1 = new CanvasJS.Chart("commandeFournisseur", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Commande Fournisseur."
            },
            axisY: {
                includeZero: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "center",
                horizontalAlign: "right",
                itemclick: toggleDataSeries
            },
            data: [{
                type: "column",
                name: "",
                indexLabel: "{y}",
                yValueFormatString: "#0.##",
                showInLegend: true,
                dataPoints: <?php echo json_encode($CommandeFournisseur, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart1.render();
        var chart2 = new CanvasJS.Chart("commandeClient", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Commande Client."
            },
            axisY: {
                includeZero: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "center",
                horizontalAlign: "right",
                itemclick: toggleDataSeries
            },
            data: [{
                type: "column",
                name: "",
                indexLabel: "{y}",
                yValueFormatString: "#0.##",
                showInLegend: true,
                dataPoints: <?php echo json_encode($CommandeClient, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart2.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }

    }
    </script>

    <?php include("menu_footer/footer.php") ?>