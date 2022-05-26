<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Gestion des clients</h4>
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
				document.location.href="page_js/supprimerclient.php?ID="+id ;
			}			    
	  }	
	function Archiver(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/archiverclient.php?ID="+id ;
			}			    
	  }		  
	function Unarchiver(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/unarchiverclient.php?ID="+id ;
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


	$raisonsocial		=	addslashes($_POST["raisonsocial"]) ;
	$adresse			=	addslashes($_POST["adresse"]) ;	
	$pays				=	addslashes($_POST["pays"]) ;	
	$telephone			=	addslashes($_POST["telephone"]) ;	
	$personne			=	addslashes($_POST["personne"]) ;
	$gsm				=	addslashes($_POST["gsm"]) ;
	$mail				=	addslashes($_POST["mail"]) ;
	
	if($id=="0")
		{
			// $sql="INSERT INTO `erp_fab_clients`(`raisonsocial`, `adresse`, `pays`, `telephone`, `mail`, `personne`, `gsm`) VALUES
			// ('".$raisonsocial."','".$adresse."','".$pays."' ,'".$telephone."' ,'".$mail."' ,'".$personne."' ,'".$gsm."' )";
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_fab_IDUSER'];
			$document="Fiche client";
			$action="Création de compte client :".$raisonsocial;
			
			$sql1="INSERT INTO `erp_fab_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";
			$req=mysql_query($sql1);	
			
		}
	else{
			$sql="UPDATE `erp_fab_clients` SET `raisonsocial`='".$raisonsocial."',`adresse`='".$adresse."',
			`pays`='".$pays."', `telephone`='".$telephone."' , `mail`='".$mail."' , `personne`='".$personne."' , `gsm`='".$gsm."' WHERE id=".$id;
			
			//Log
			$dateheure=date('Y-m-d H:i:s');
			$iduser=$_SESSION['erp_fab_IDUSER'];
			$document="Fiche client";
			$action="Modification de compte client :".$raisonsocial." - adresse:".$adresse." - telephone:".$telephone." - mail=".$mail." - personne:".$personne."";
			
			$sql1="INSERT INTO `erp_fab_log`(`dateheure`, `idutilisateur`, `document`, `action`) VALUES ('".$dateheure."','".$iduser."','".$document."','".mysql_real_escape_string($action)."')";$req=mysql_query($sql1);			
		}
		$req=mysql_query($sql);

		echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="?suc=1" </SCRIPT>';

}
	$raisonsocial		=	"" ;
	$adresse			=	"" ;	
	$pays				=	"" ;		
	$telephone			=	"" ;
	$gsm				=	"" ;	
	$personne			=	"" ;
	$mail				=	"" ;	
	$req="select * from erp_fab_clients where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$raisonsocial	=	$enreg["raisonsocial"] ;
		$adresse		=	$enreg["adresse"] ;	
		$pays			=	$enreg["pays"] ;	
		$telephone		=	$enreg["telephone"] ;	
		$gsm			=	$enreg["gsm"] ;
		$personne		=	$enreg["personne"] ;
		$mail			=	$enreg["mail"] ;
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
									<div class="col-sm-3">
									<b>Raison sociale (*)</b>
										<input class="form-control" type="text" placeholder="Raison sociale" value="<?php echo $raisonsocial; ?>" id="example-text-input" name="raisonsocial" required>
									</div>										
									<div class="col-sm-3">
									<b>Adresse mail (*)</b>
										<input class="form-control" type="email" parsley-type="email" placeholder="Email de client" value="<?php echo $mail; ?>" id="example-text-input" name="mail" required>
									</div>
									<div class="col-sm-2">
									<b>Téléphone</b>
										<input class="form-control"  data-parsley-type="number" type="number"  placeholder="Téléphone de client" value="<?php echo $telephone; ?>" id="example-text-input" name="telephone" >
									</div>											
									<div class="col-sm-2">
									<b>GSM </b>
										<input class="form-control"  data-parsley-type="number" type="number"  placeholder="GSM de client" value="<?php echo $gsm; ?>" id="example-text-input" name="gsm" >
									</div>		
									<div class="col-sm-2">
									<b>Personne à contacter </b>
										<input class="form-control" type="text"  placeholder="Personne à contacter" value="<?php echo $personne; ?>" id="example-text-input" name="personne" >
									</div>									
								</div>
								
								<div class="form-group row">
									<div class="col-sm-8">
									<b>Adresse </b>
										<textarea class="form-control" name="adresse" id="adresse" ><?php echo $adresse; ?></textarea>
									</div>										
									<div class="col-sm-3">
									<b>Pays</b>
										<input class="form-control"  placeholder="Pays" value="<?php echo $pays; ?>" id="example-text-input" name="pays" >
									</div>										
								
								</div>
								<div class="form-group m-b-0">
									<div>
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
$reqCli="";
$client="";
if(isset($_POST['client'])){
	if(is_numeric($_POST['client'])){
		$client		=	$_POST['client'];
		$reqCli		=	" and  id=".$client;
	}
}

$reqPerso="";
$perso="";
if(isset($_POST['perso'])){
	if(($_POST['perso'])<>""){
		$perso			=	$_POST['perso'];
		$reqPerso		=	" and  personne like '%".$perso."%'";
	}
}
?>	        		
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<h3>Liste des clients</h3>			
								<form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
									<div class="col-xl-12">
										<div class="row">
											<div class="col-xl-3">
											<b>Liste des clients</b>
											<select class="form-control select2" name="client">
												<option value=""> Sélectionner un client </option>
												<?php
												$req="select * from erp_fab_clients order by raisonsocial";
												$query=mysql_query($req);
												while($enreg=mysql_fetch_array($query)){
												?>
												<option value="<?php echo $enreg['id']; ?>" <?php if($client==$enreg['id']) {?> selected <?php } ?>><?php echo $enreg['raisonsocial']; ?></option>
												<?php } ?>
											</select>
											</div>
											
											<div class="col-xl-3">
												<b>Personne à contacter</b>
												<input type="text" class="form-control" name="perso" id="perso" value="<?php echo $perso; ?>">
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
                                            <th><b>#</b></th>
                                            <th><b>Raison sociale</b></th>
                                            <th><b>Email</b></th>
											<th><b>Téléphone</b></th>
											<th><b>personne à contacter</b></th>
											<th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php

	$nom	=	"" ;
	$prenom	=	"" ;
	$mail	=	"" ;	
	$id		=	"0" ;		
	$i		=	"0" ;
	$req="select * from erp_fab_clients where 1=1 ".$reqCli.$reqPerso." order by raisonsocial ";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$nom	=	$enreg["raisonsocial"] ;
		$mail	=	$enreg["mail"] ;	
		$id		=	$enreg["id"] ;			
		$i++;
	?>
										<tr>
											 <td><?php echo $i; ?></td>
											 <td><?php echo $nom; ?></td>
											 <td><?php echo $mail; ?></td>
											 <td><?php echo $enreg["telephone"]; ?></td>
											 <td><?php echo $enreg["personne"]; ?></td>
											 <td>
												<a href="gest_clients.php?ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">Modifier</a>
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