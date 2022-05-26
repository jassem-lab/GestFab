<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Nomenclature Service et Produit Semi-Finis</h4>
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
								<br>
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th><b>Service</b></th>
                                            <th><b>Nomenclature</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php

	$date				=	"";
	$reference			=	"";
	$id					=	0;
	$montant			=	"0";
	
	$req="select * from erp_fab_service order by service desc "; 
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$id					=	$enreg["id"] ;	
		$service			=	$enreg["service"] ;
		$nomenclature		=	0;
		$req1="select * from erp_fab_produits_service where idservice=".$id;
		$query1=mysql_query($req1);
		$nomenclature=mysql_num_rows($query1);
		
?>
										<tr>
											 <td><?php echo $service; ?></td>
											 <td>
											
												<a href="nomenclature_service.php?ID=<?php echo $id; ?>" class="btn btn-warning waves-effect waves-light">
													Mise à jour nomenclature (<?php echo $nomenclature; ?>)
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
