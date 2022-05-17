<!DOCTYPE html>
<html lang="en">
    <head>
<?php
session_start();
include('connexion/cn.php');

?>
<?php
if ((isset($_SESSION['erp_bc_MAILUSER']))) {
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="dashbord.php" </SCRIPT>';
	exit;
}
?>		
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<title>Gestion des commandes</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/1.png">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div class="account-pages" style="background-color: #0e3e72;"></div>
        <div class="wrapper-page">
<?php
if (isset($_POST['username'])) {

	$LOGIN = addslashes($_POST["username"]);
	$MOTDEPASSE = addslashes($_POST["userpassword"]);

	$idprofil = 0;
	$reqTestExistEmail = " select * from erp_bc_utilisateurs where  mail='" . $LOGIN . "' and motdepasse='" . $MOTDEPASSE . "'";
	$queryTestExistEmail = mysql_query($reqTestExistEmail);
	if (mysql_num_rows($queryTestExistEmail) != 0) {
		while ($enregTestExistEmail = mysql_fetch_array($queryTestExistEmail)) {
			$IDUTILISATEUR = $enregTestExistEmail['id'];
			$MAIL = $enregTestExistEmail['mail'];
			$idprofil = $enregTestExistEmail['idprofil'];

			$_SESSION['erp_bc_IDUSER'] = $IDUTILISATEUR;
			$_SESSION['erp_bc_USER'] = $enregTestExistEmail['nom'] . ' ' . $enregTestExistEmail['prenom'];
			$_SESSION['erp_bc_MAILUSER'] = $MAIL;
			$_SESSION['erp_bc_PROFIL'] = $idprofil;

			if($enregTestExistEmail['archive']==1){
				echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?err=nocpt1" </SCRIPT>';
				exit;
			}
		
			if($idprofil==1 or $idprofil==2){
				echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="dashbord.php" </SCRIPT>';
				exit;				
			} elseif($idprofil==4){
				echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="dashbord_cli.php" </SCRIPT>';
				exit;				
			}
			
			
			
		}

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="dashbord.php" </SCRIPT>';
	}

	if ((mysql_num_rows($queryTestExistEmail) == 0)) {
		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?err=nocpt" </SCRIPT>';
	}

}
?>
            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="dashbord.php" class="logo logo-admin"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="text-muted font-18 m-b-5 text-center"><b style="color: #ba6e24;">Espace de connexion à la platforme</b></h4>
                        
						<?php if (isset($_GET['err'])) { ?>
							<?php if ($_GET['err'] == 'nocpt') { ?>
							<font color="#ff0000" style="background-color:#FFFFFF;"><center>Vérifier votre saisie SVP !</center></font><br /><br />
							<?php
							}?>	
							<?php if ($_GET['err'] == 'nocpt1') { ?>
							<font color="#ff0000" style="background-color:#FFFFFF;"><center>Votre compte a été archivé !</center></font><br /><br />
							<?php
							}?>								
							<?php if ($_GET['err'] == 'suc') { ?>
							<font color="green" style="background-color:#FFFFFF;"><center>Vérifier votre boîte mail pour consulter votre mot de passe !</center></font><br /><br />
							<?php
	}?>
						<?php
}?>
                        <form class="form-horizontal m-t-30" action="" method="POST">

                            <div class="form-group">
                                <label for="username" style="color:">Adresse mail</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter votre adresse mail">
                            </div>

                            <div class="form-group">
                                <label for="userpassword" style="color:">Mot de passe</label>
                                <input type="password" class="form-control" id="userpassword" name="userpassword"  placeholder="Enter votre mot de passe">
                            </div>
							
                            <div class="form-group row m-t-20">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
										<button class="btn btn-primary w-md waves-effect waves-light" type="submit">Connecter</button>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="login.php" class="btn btn-danger w-md waves-effect waves-light" style="background-color:#ba6e24;" >Annuler</a>
                                </div>
                            </div>							

						
                        </form>
                    </div>

                </div>
            </div>

				<div class="m-t-40 text-center">
							<p class="text-muted"><b  style="color:white">  © 2022 Gestion des commandes <br> Application créée par  </b><a href="http://www.deltawebit.com/contact.php" target="_blank"><b  style="color:orange">Delta Web Information Technology</b></a></b></p>
				</div>

        </div>

        <!-- END wrapper -->

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script>

        <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>