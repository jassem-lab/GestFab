<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Gestion des entrées de stock</h4>
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
				document.location.href="page_js/supprimerbe.php?ID="+id ;
			}			    
	  }	
		function Imprimer(id)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				var myMODELE_A4 = window.open("print/imprimer_be.php?ID="+id, "_blank", "toolbar=no, scrollbars=yes, resizable=no, top=500, left=500, width=700, height=600");
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
		$reqDate1			=	" and  date1>='".$dat1."'";
	}
}
?>	        		
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
						<a href="addedit_be.php" class="btn btn-primary waves-effect waves-light">Ajouter un bon d'entrée</a> 
							<h3>Liste des entrées de stock</h3>			
								<form name="SubmitContact" class="" method="post" action="" onSubmit="" style=''>
									<div class="col-xl-12">
										<div class="row">
											<div class="col-xl-3">
												<b>Du</b>
												<input type="date" class="form-control" id="dat" name="dat" value="<?php echo $dat; ?>">
											</div>																			
											<div class="col-xl-3">
												<b>Au</b>
												<input type="date" class="form-control" id="dat1" name="dat1" value="<?php echo $dat1; ?>">
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
                                            <th><b>Référence</b></th>
                                            <th><b>Date</b></th>
											<th><b>Montant</b></th>
											<th><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php

	$date				=	"";
	$reference			=	"";
	$id					=	0;
	$montant			=	"0";
	
	$req="select * from erp_fab_be where 1=1 ".$reqDate.$reqDate1." order by date desc "; 
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$reference			=	$enreg["reference"] ;
		$montant			=	$enreg["montant"] ;
		$date				=	date("d/m/Y", strtotime($enreg["date"]) );
		
?>
										<tr>
											 <td><?php echo $reference; ?></td>
											 <td><?php echo $date; ?></td>
											 <td><?php echo number_format($montant,'2','.',''); ?></td>
											 <td>
											
												<a href="addedit_be.php?ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												<a href="javascript:Imprimer('<?php echo $id; ?>')" class="btn btn-warning waves-effect waves-light" style="background-color: blue;color: white;">
													<span class="glyphicon glyphicon-print"></span>
												</a>
												<a href="Javascript:Supprimer('<?php echo $id; ?>')" class="btn btn-danger waves-effect waves-light" style="background-color:brown">
													<span class="glyphicon glyphicon-trash"></span>
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
