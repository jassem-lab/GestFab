<!DOCTYPE html>
<html lang="en">

<head>
    <?php
session_start();
include('connexion/cn.php');

?>
    <?php
if (!isset($_SESSION['erp_bc_MAILUSER'])) 
{
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="index.php" </SCRIPT>';
	exit;
}
?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Gestion et suivi des commandes</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/1.png">
    <link href="plugins/bootstrap-md-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/morris/morris.css">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print" />
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
                        et suivi de Fabrication</b>
                </div>

                <div class="menu-extras topbar-custom">

                    <ul class="navbar-right d-flex list-inline float-right mb-0">

                        <?php
if (isset($_SESSION['erp_bc_MAILUSER'])) {
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
if (isset($_SESSION['erp_bc_MAILUSER'])) {
?>

                    <?php if ($_SESSION['erp_bc_PROFIL'] == 1) { ?>
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
                                        <li><a href="produits.php"><b style="font-size:12px">Fournisseur </a></b></li>
                                        <li><a href="gest_classe.php"><b style="font-size:12px">Classe des Matières
                                                    Premières
                                            </a></b></li>
                                        <li><a href="phases.php"><b style="font-size:12px">Matière première</a></b>
                                        </li>
                                        <li><a href="gest_moule.php"><b style="font-size:12px">Moule semi-finis</a></b>
                                        </li>
                                        <li><a href="couleur_peinture.php"><b style="font-size:12px">Service
                                                    supplémentaire</a></b></li>
                                        <li><a href="type_defauts.php"><b style="font-size:12px">Produit
                                                    semi-fini</a></b></li>
                                        <li><a href="contenu_mails.php"><b style="font-size:12px">Produit fini</a></b>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="stock.php" style="font-size: 12px;"><i class="mdi mdi-buffer"></i>Mouvement
                                fournisseur</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="gest_prix.php"><b style="font-size:12px">Entrée marchandise
                                            </a></b></li>
                                        <li><a href="gest_bc.php"><b style="font-size:12px">Sortie marchandise</a></b>
                                        </li>
                                        <li><a href="gest_bccomple.php"><b style="font-size:12px">Invetaire de
                                                    stock</a></b></li>
                                        <li><a href="gest_bl.php"><b style="font-size:12px">Mouvement de stock</a></b>
                                        </li>
                                        <li><a href="gest_fact.php"><b style="font-size:12px">Stock par dernier prix
                                                    d'achat</a></b>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </li>



                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-buffer"></i>Mouvement Client</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="gest_retour.php"><b style="font-size:12px">Commande client</a></b>
                                        </li>
                                        <li><a href="stat_sav.php"><b style="font-size:12px">Ordre de
                                                    fabrication</a></b>
                                        </li>
                                        <li><a href="stat_sav.php"><b style="font-size:12px">Livraison client</a></b>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-buffer"></i>Tableau de bord
                                administrateur</a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="gest_retour.php"><b style="font-size:12px">Commande
                                                    mensuelle</a></b>
                                        </li>
                                        <li><a href="stat_sav.php"><b style="font-size:12px">Ordre de fabrication
                                                    mensuelle</a></b>
                                        </li>
                                        <li><a href="stat_sav.php"><b style="font-size:12px">Livraison mensuelle</a></b>
                                        </li>
                                        <li><a href="stat_sav.php"><b style="font-size:12px">Matières premières en
                                                    rupture de stock</a></b>
                                        </li>
                                        <li><a href="stat_sav.php"><b style="font-size:12px">Suivi de stock produit
                                                    fini</a></b>
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
                                        <li><a href="stock.php"><b style="font-size:12px">Mouvement de stock </a></b>
                                        </li>
                                        <li><a href="liste_paie.php"><b style="font-size:12px">Valorisation de
                                                    stock</a></b>
                                        </li>
                                        <li><a href="liste_bc.php"><b style="font-size:12px">Liste des entrées
                                                    marchandises</a></b>
                                        </li>
                                        <li><a href="list_bl.php"><b style="font-size:12px">Liste des sorties
                                                    marchandises
                                            </a></b></li>
                                        <li><a href="list_facts.php"><b style="font-size:12px">Liste des ordres de
                                                    fabrication
                                            </a></b></li>
                                        <li><a href="liste_demmp.php"><b style="font-size:12px">Liste des livraisons
                                            </a></b></li>
                                        <li><a href="liste_paie.php"><b style="font-size:12px">Liste des matières
                                                    premières à commandées</a></b></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php } ?>
                    <?php if ($_SESSION['erp_bc_PROFIL'] == 4) { ?>
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            <a href="dashbord_cli.php" style="font-size: 12px;"><i class="mdi mdi-home"></i>Tableau de
                                bord</a>
                        </li>

                        <li class="has-submenu">
                            <a href="stock.php" style="font-size: 12px;"><i class="mdi mdi-home"></i>Stock
                                semis-finis</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-home"></i>Simulation</a>
                        </li>

                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-home"></i>Consultation Livraison</a>
                        </li>
                        <li class="has-submenu">
                            <a href="#" style="font-size: 12px;"><i class="mdi mdi-home"></i>Consultation Facture</a>
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