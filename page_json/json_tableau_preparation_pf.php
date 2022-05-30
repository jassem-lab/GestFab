<?php
	session_start(); 
	include('../connexion/cn.php');  
 
	$idproduit			   	= $_POST['idproduit']; 
	$iddet			  	 	= $_POST['iddet']; 
	$idservice				= $_POST['idservice']; 
	
	$qte_demande=0;
	$reqdet="select * from erp_fab_detof where id=".$iddet;
	$querydet=mysql_query($reqdet);
	while($enregdet=mysql_fetch_array($querydet)){
		$qte_demande	=	$enregdet['quantite'];
		$id				=	$enregdet['idof'];
	}
	$idof1=0;
	$req="select * from erp_fab_of where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$reql="select * from erp_fab_of where id<>".$id." and idbc=".$enreg['idbc'];
		$query1=mysql_query($reql);
		while($enreg1=mysql_fetch_array($query1)){
			$idof1=$enreg1['id'];
		}
	}	
	
			
?>
<input type="hidden" id="idof" value="<?php echo $id; ?>">
	<h4 style="color:brown">Valider la préparation de stock SF</h4>
	<?php
$reqnom="select * from erp_fab_detpreparation_sf where  produit=".$idproduit." and idservice=5
and exists(select * from erp_fab_preparation where erp_fab_preparation.id=erp_fab_detpreparation_sf.idpreparation and idof=".$idof1.")";
$querynom=mysql_query($reqnom);
while($enregnom=mysql_fetch_array($querynom)){	

		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enregnom["idsemi"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}	
		
		$qte_demandee=$enregnom["quantite"];
?>
	<div class="col-md-12 row" style="margin-top:5px;margin-bottom:10px">
		<div class="col-md-2">
			<b><?php echo $sproduit; ?></b>
		</div>
		<div class="col-md-3">
			<b>Quantité à Fabriquer</b>
			<input type="number" class="form-control" value="<?php echo $qte_demandee; ?>" id="qtesf<?php echo $enregnom['idsemi']; ?>-<?php echo $idservice; ?>" style="width:50%" readonly>
		</div>	
	</div>
			
<?php } ?>		
								<div class="col-sm-2" style="margin-top: 5px;margin-bottom:20px">	
									<br>
									<button type="submit" class="btn btn-primary waves-effect waves-light">
										Enregistrer
									</button>
								</div>	

<script>
	$('.btn').on('click', function(){
		
		var idproduit			= <?php echo  $_POST['idproduit']; ?>; 
		var iddet			  	= <?php echo  $_POST['iddet']; ?>;
		var idservice			= <?php echo  $_POST['idservice']; ?>;
		var idof				= $('#idof').val();
		var tableau 			= "";
		var tableau_qte 		= "";

		<?php
		$reqnom="select * from erp_fab_detpreparation_sf where  produit=".$idproduit." and idservice=5
		and exists(select * from erp_fab_preparation where erp_fab_preparation.id=erp_fab_detpreparation_sf.idpreparation and idof=".$idof1.")";
		$querynom=mysql_query($reqnom);
		while($enregnom=mysql_fetch_array($querynom)){		
		?>
			
			var idsemi = <?php echo $enregnom['idsemi']; ?>;
			var qte    = $('#qtesf'+idsemi+'-'+idservice).val();
			if (qte>0) {
				if(tableau==""){
					tableau	   = idsemi;
					tableau_qte= qte;
				} else{
					tableau	   = tableau+","+idsemi;
					tableau_qte= tableau_qte+","+qte;
				}								
			}				
			
		<?php } ?>
		
		if(tableau!=""){
			$.getJSON("page_ajax/ajax_preparation_of_pf.php?tableau="+tableau+"&tableau_qte="+tableau_qte+"&iddet="+iddet+"&idof="+idof+"&idproduit="+idproduit+"&idservice="+idservice, function (data, status) {
				if (status == "success") {
					idof		=	data.idof;
					document.location.href="detail_of_pf.php?ID="+idof;
				}
					document.location.href="detail_of_pf.php?ID="+idof;
			});				
			
		}
		
	});

</script>