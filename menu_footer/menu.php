<!DOCTYPE html>
<html lang="en">

<head>
    <?php
session_start();
include('connexion/cn.php');

?>
    <?php
if (!isset($_SESSION['erp_fab_MAILUSER'])) 
{
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="index.php" </SCRIPT>';
	exit;
}
?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Gestion et de Suivi de Stock</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/1.png">
    <link href="plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/morris/morris.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main" style="background-color: #2054c966">
            <div class="container-fluid">
                <div class="logo">
                    <b style="text-align: center; color: #102677;font-family: Roboto, sans-serif;font-size: 16.5px;">Gestion
                        et de Suivi de Stock</b>
                </div>

                <div class="menu-extras topbar-custom">

                    <ul class="navbar-right d-flex list-inline float-right mb-0">

                        <?php
if (isset($_SESSION['erp_fab_MAILUSER'])) {
?>
                        <li class="dropdown notification-list">
                            <div class="dropdown notification-list">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="assets/512.png" alt="user" class="rounded-circle"
                                        style="width:20px; height:20px">
                                </a>
                                <!--<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
									<a class="dropdown-item text-danger" href="aide/aide.pdf" target="_blank"><i class="ion-document"></i>
									<b style="color:#f16c69">Manuel d'utilisation</b>
									</a>
								</div>     -->
                            </div>
                        </li>
                        <?php
}?>
                        <!-- NOTIFICATION -->
                        <li id="idListNotifs" class="dropdown notification-list">
                            <?php
$_GET['li'] = 1;
//include("page_ajax/ajax_refresh_notification.php");
?>
                        </li>



                        <li class="dropdown notification-list">
                            <div class="dropdown notification-list">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light"
                                    data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                    aria-expanded="false">
                                    <img src="assets/2.png" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <a class="dropdown-item text-danger" href="deconnexion.php"><i
                                            class="mdi mdi-power text-danger"></i> Déconnexion</a>
                                </div>
                            </div>
                        </li>

                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->
        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->

                    <?php
if (isset($_SESSION['erp_fab_MAILUSER'])) {
?>

                    <?php if ($_SESSION['erp_fab_PROFIL'] == 1) { ?>
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            <a href="dashbord.php" style="font-size: 12px;"><i class="mdi mdi-home"></i>Tableau de
                                bord</a>
                        </li>

                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-buffer"></i>Tables de base</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="utilisateurs.php"><b style="font-size:12px">Utilisateurs</a></b>
                                        </li>
                                        <li><a href="gest_clients.php"><b style="font-size:12px">Clients</a></b></li>
                                        <li><a href="gest_provenance.php"><b style="font-size:12px">Provenance </a></b>
                                        </li>
                                        <li><a href="gest_emplacement.php"><b style="font-size:12px">Emplacement
                                            </a></b></li>
                                        <li><a href="table_base.php"><b style="font-size:12px">Autres Table de base
                                            </a></b></li>
                                        <li><a href="services.php"><b style="font-size:12px">Service (Phase de
                                                    fabrication)</a></b></li>
                                        <li><a href="mps.php"><b style="font-size:12px">Matières premières </a></b></li>
                                        <li><a href="mps_emballage.php"><b style="font-size:12px">Matières premières
                                                    Emballage</a></b></li>
                                        <li><a href="gest_sf.php"><b style="font-size:12px">Produits Semi-Finis</a></b>
                                        </li>
                                        <li><a href="nomenclature_sf_service.php"><b style="font-size:12px">Nomenclature
                                                    Service / SF</a></b></li>
                                        <li><a href="gest_pf.php"><b style="font-size:12px">Produits Finis</a></b></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-buffer"></i>Mouvement Fournisseurs
                            </a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="gest_bcf.php"><b style="font-size:12px">Commandes Fournisseur
                                            </a></b></li>
                                        <li><a href="gest_be.php"><b style="font-size:12px">Entrées en stock</a></b>
                                        </li>
                                        <li><a href="gest_bs.php"><b style="font-size:12px">Sorties de stock</a></b>
                                        </li>
                                        <li><a href="gest_inv.php"><b style="font-size:12px">Inventaire de stock</a></b>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-buffer"></i>Mouvement Client </a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="gest_bc.php"><b style="font-size:12px">Commandes Client </a></b>
                                        </li>
                                        <li><a href="gest_of.php"><b style="font-size:12px">Ordre de fabrication</a></b>
                                        </li>
                                        <li><a href="gest_bl.php"><b style="font-size:12px">Livraison Client</a></b>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li>


                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-buffer"></i>Rapports</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="mvt_stock.php"><b style="font-size:12px">Mouvement de stock
                                            </a></b></li>
                                        <li><a href="val_stock.php"><b style="font-size:12px">Valorisation de stock
                                                    MP</a></b></li>
                                        <li><a href="val_stock_SF.php"><b style="font-size:12px">Valorisation de stock
                                                    SF</a></b></li>
                                        <li><a href="val_stock_F.php"><b style="font-size:12px">Valorisation de stock
                                                    PF</a></b></li>
                                        <li><a href="mp_commander.php"><b style="font-size:12px">MPs à commander</a></b>
                                        </li>
                                        <li><a href="SFinferieurStock.php"><b style="font-size:12px">SF Inf au Stock de
                                                    sécurité</a></b></li>
                                        <li><a href="FinferieurStock.php"><b style="font-size:12px">PF Inf au Stock de
                                                    sécurité</a></b></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>



                    </ul>
                    <?php } ?>


                    <?php } ?>


                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->
