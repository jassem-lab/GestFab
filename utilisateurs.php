<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Gestion des utilisateurs</h4>
				<br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
			</div>
		</div>
	</div>
  </div>
  <script>
		function Supprimer(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/supprimerutilisateur.php?ID="+id ;
			}			    
	  }	
	function Archiver(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/archiverutilisateur.php?ID="+id ;
			}			    
	  }		  
	function Unarchiver(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/unarchiverutilisateur.php?ID="+id ;
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


	$nom				=	addslashes($_POST["nom"]) ;
	$prenom				=	addslashes($_POST["prenom"]) ;	
	$mail				=	addslashes($_POST["mail"]) ;	
	$motdepasse			=	addslashes($_POST["motdepasse"]) ;	
	$idprofil			=	addslashes($_POST["idprofil"]);
	
	if($id=="0")
		{
			$sql="INSERT INTO `erp_fab_utilisateurs`(`nom`, `prenom`, `mail`, `motdepasse`, `idprofil`) VALUES 
			('".$nom."','".$prenom."' ,'".$mail."' ,'".$motdepasse."' ,'".$idprofil."' )";
		}
	else{
			$sql="UPDATE `erp_fab_utilisateurs` SET `nom`='".$nom."',`prenom`='".$prenom."',`mail`='".$mail."',`motdepasse`='".$motdepasse."',
			`idprofil`='".$idprofil."' WHERE id=".$id;
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$nom				=	"";
	$prenom				=	"";
	$mail				=	"";
	$motdepasse			=	"";
	$idprofil			=	"";
	
	$req="select * from erp_fab_utilisateurs where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$nom				=	$enreg["nom"] ;
		$prenom				=	$enreg["prenom"] ;
		$mail				=	$enreg["mail"] ;
		$motdepasse			=	$enreg["motdepasse"] ;
		$idprofil			=	$enreg["idprofil"] ;

	}
	
	?> 
  <div class="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<?php if(isset($_GET['suc'])){ ?>
								<?php if($_GET['suc']=='1'){ ?>
								<font color="green" style="background-color:#FFFFFF;"><center>Enregistrement effectué avec succès</center></font><br /><br />
							<?php } }?>							
							<form action="" method="POST">    
								<div class="form-group row">								
									<div class="col-sm-2">
									<b>Nom (*)</b>
										<input class="form-control" type="text"  placeholder="Nom d'utilisateur" value="<?php echo $nom; ?>" id="example-text-input" name="nom" required>
									</div>
									<div class="col-sm-2">
									<b>Prénom (*)</b>
										<input class="form-control"  type="text"  placeholder="prénom d'utilisateur" value="<?php echo $prenom; ?>" id="example-text-input" name="prenom" required>
									</div>
									<div class="col-sm-2">
									<b>Mail (*)</b>
										<input class="form-control"  data-parsley-type="email" type="email"  placeholder="Mail d'utilisateur" value="<?php echo $mail; ?>" id="example-text-input" name="mail" required>
									</div>										
									<div class="col-sm-2">
									<b>Mot de passe (*)</b>
										<input class="form-control"  data-parsley-type="text" type="text"  placeholder="MDP d'utilisateur" value="<?php echo $motdepasse; ?>" id="example-text-input" name="motdepasse" required>
									</div>		
									
									<div class="col-sm-2">
									<b>Profil (*)</b>
										<select class="form-control select2" name="idprofil" required>
											<option value=""> Sélectionner un profil </option>
											<?php
											$req="select * from erp_fab_profil order by profil";
											$query=mysql_query($req);
											while($enreg=mysql_fetch_array($query)){
											?>
											<option value="<?php echo $enreg['id']; ?>" <?php if($idprofil==$enreg['id']) {?> selected <?php } ?>><?php echo $enreg['profil']; ?></option>
											<?php } ?>
										</select>										
									</div>									
								</div>
								
								<div class="form-group row">
									<div class="col-sm-2">	
										<br>
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
			
			
<?php
$reqEmp="";
$utilisateur="";
if(isset($_POST['utilisateur'])){
	if(is_numeric($_POST['utilisateur'])){
		$utilisateur		=	$_POST['utilisateur'];
		$reqEmp				=	" and  id=".$utilisateur;
	}
}

$reqProfil="";
$profil="";
if(isset($_POST['profil'])){
	if(($_POST['profil'])<>""){
		$profil				=	$_POST['profil'];
		$reqProfil			=	" and  idprofil =".$profil;
	}
}
?>	        		
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h3>Liste des utilisateurs</h3>			
								<form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
									<div class="col-xl-12">
										<div class="row">
											<div class="col-xl-3">
											<b>Liste des utilisateurs</b>
											<select class="form-control select2" name="utilisateur">
												<option value=""> Sélectionner un utilisateur </option>
												<?php
												$req="select * from erp_fab_utilisateurs order by nom";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($utilisateur==$enreg['id']) {?> selected <?php } ?>><?php echo $enreg['nom'].' '.$enreg['prenom']; ?></option>
												<?php } ?>
											</select>
											</div>
											<div class="col-xl-3">
											<b>Liste des équipes</b>
											<select class="form-control select2" name="profil">
												<option value=""> Sélectionner un profil </option>
												<?php
												$req="select * from erp_fab_profil order by profil";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($profil==$enreg['id']) {?> selected <?php } ?>><?php echo $enreg['profil']; ?></option>
												<?php } ?>
											</select>
											</div>

											<div class="col-xl-3">
											  <b></b><br>
												<input name="SubmitContact" type="submit" id="submit" class="btn btn-primary btn-sm " value="Filtrer">											
											</div>
											
										</div>	
									</div>
								</form>
								<br>
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th><b>Nom et prénom</b></th>
                                            <th><b>Mail</b></th>
											<th><b>Mot de passe</b></th>
											<th><b>Profil</b></th>
											<th><b>Etat</b></th>
											<th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
	$id					=	0;
	$nom				=	"";
	$prenom				=	"";
	$mail				=	"";
	$motdepasse			=	"";
	$nomprofil			=	"";
	$profil				=	"0";

	
	$req="select * from erp_fab_utilisateurs where 1=1 ".$reqEmp.$reqProfil." order by nom ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$nom				=	$enreg["nom"] ;
		$prenom				=	$enreg["prenom"] ;
		$mail				=	$enreg["mail"] ;
		$motdepasse			=	$enreg["motdepasse"] ;
		$profil				=	$enreg["idprofil"] ;

		
		$reqprofil="select * from erp_fab_profil where id=".$profil;
		$queryprofil=mysql_query($reqprofil);
		while($enregprofil=mysql_fetch_array($queryprofil)){
			$nomprofil			=	$enregprofil["profil"] ;
		}
	?>
										<tr>
											 <td><?php echo $nom.' '.$prenom; ?></td>
											 <td><?php echo $mail; ?></td>
											 <td><?php echo $motdepasse; ?></td>
											 <td><?php echo $nomprofil; ?></td>
											 <td>
												<?php if($enreg['archive']==0){ ?>
													<b style="color:green"> Actif </b>
												<?php } else{ ?>
													<b style="color:red"> Inactif </b>
												<?php } ?>
											 
											 </td>
											 <td>
												<a href="utilisateurs.php?ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">Modifier</a>
												<?php if ($enreg["archive"]=="0"){ ?>
													<a href="Javascript:Archiver('<?php echo $id; ?>')" class="btn btn-danger waves-effect waves-light">Archiver</a>						
												<?php } else {?>
													<a href="Javascript:Unarchiver('<?php echo $id; ?>')" class="btn btn-dark waves-effect waves-light">Unarchiver</a>
												<?php }?>	
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