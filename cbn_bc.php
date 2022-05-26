<?php include ("menu_footer/menu.php"); ?>
<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Calcul Besoin NET</h4>
<?php 
	$id = $_GET['ID'];
	$bc = "";
	$req="select * from erp_fab_bc where id=".$id; 
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$bc			=	$enreg["reference"] ;
	}

?>				
				<h4>Commande : <?php echo $bc; ?></h4>
				
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
														
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>Produit</b></th>
										<th><b>QTE à Commander</b><br><b style="color:orange">Date livraison</b></th>
										<th><b>Nomenclature SF</b><br><b style="color:red">Stock SF Dispo</b></th>
										<th><b>Nbre Total de cycle </b></th>
										<th><b>Temps/Min </b></th>
										<th><b>Poids Net</b></th>
										<th><b>Poids brut</b></th>
										<th><b>Nomenclature MP</b><br><b style="color:red">Stock MP Dispo</b></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
	$req="select * from erp_bc_det_bc where idbc=".$id." order by date_livraison asc";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$produit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enreg["produit"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$produit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}	
		$date				=	date("d/m/Y", strtotime($enreg["date_livraison"]) );	
		
		$nomenclature = 0;
		$reqcom="select * from erp_fab_nomenclature_pf where idproduit=".$enreg["produit"]." and idsemi>0";
		$querycom=mysql_query($reqcom);
		$nomenclature=mysql_num_rows($querycom);			
?>
									<tr>
                                        <td><?php echo $produit; ?></td>
										<td><?php echo $enreg['quantite']; ?><br><b style="color:orange"><?php echo $date; ?></b></th>
										<td>
											<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
													data-target=".bs-example-modal-lg<?php echo $enreg['id']; ?>" id="<?php echo $enreg['produit']; ?>"  data-id="<?php echo $enreg['id']; ?>">
													Nomenclature SF (<?php echo $nomenclature; ?>)
											</button>
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg<?php echo $enreg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content"  style="width: 1200px;margin-left: -120px;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"><b style="color:green"><?php echo 'Nomenclature '.$produit; ?></b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
														   <div class="col-md-12 row" id="NomenclatureSF<?php echo $enreg['produit']; ?><?php echo $enreg['id']; ?>">

														   </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->												
										</td>
										<td>Nbre Total de cycle </td>
										<td>Temps/Min </td>
										<td>Poids Net</td>
										<td>Poids brut</td>
										<td>Nomenclature MP</td>
										<td>Qte MP</td>	
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

<?php include ("menu_footer/footer.php"); ?>
<script>
	$(".btn").on("click", function(){
		var idproduit	= $(this).attr('id');
		var iddet		= $(this).data('id');
		
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps.onreadystatechange=function(){
			
			if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
				
				$('#NomenclatureSF'+idproduit+iddet).html(xmlhttp_listemps.responseText);
			}	
		}
		xmlhttp_listemps.open("POST","page_json/json_tableau_nomenclaturesf.php",true);
		xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps.send("idproduit="+idproduit);
	});	
</script>