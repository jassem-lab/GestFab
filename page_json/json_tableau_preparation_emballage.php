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
			
?>
<input type="hidden" id="idof" value="<?php echo $id; ?>">

	<h4 style="color:brown">Valider la préparation de stock emballage</h4>
	<?php
$reqnom="select * from erp_fab_detpreparation_sf where iddet=".$iddet." and produit=".$idproduit;
$querynom=mysql_query($reqnom);
while($enregnom=mysql_fetch_array($querynom)){	

		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enregnom["idsemi"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}	
		
		$qte_fabrication=$enregnom["quantite"];

		
?>
	<div class="col-md-12 row" style="margin-top:5px;margin-bottom:10px">
		<div class="col-md-2">
			<b><?php echo $sproduit; ?></b>
		</div>
		<div class="col-md-3">
			<b>Quantité Fabriquée</b>
			<input type="number" class="form-control" value="<?php echo $qte_fabrication; ?>" id="qtesf<?php echo $enregnom['idsemi']; ?>-<?php echo $idservice; ?>" style="width:50%" readonly>
		</div>	
	</div>
	<?php
		$reqmp="select * from erp_fab_detof_mp_emballage where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi'];
		$querymp=mysql_query($reqmp);
		while($enregmp=mysql_fetch_array($querymp)){
			$mp			=	"";
			$qte_unitaire=0;$etiquete	=0;
			$reqfm="select * from erp_fab_mp_emballage where id=".$enregmp["idmp"];
			$queryfm=mysql_query($reqfm);
			while($enregfm=mysql_fetch_array($queryfm)){
				$mp					=	$enregfm["code"] ;
				$qte_unitaire		=	$enregfm["quantite"] ;
				$etiquete			=	$enregfm["etiquete"] ;
			}				
			$qte_utiliser=number_format(($qte_fabrication/$qte_unitaire),'0','.','');
			
			
	?>
		<div class="col-md-12 row" style="margin-top:5px;margin-bottom:10px">
			<div class="col-md-2"></div>
			<div class="col-md-2">
				<b><?php echo $mp; ?></b>
			</div>
			<div class="col-md-3">
				<b>Quantité Unitaire</b>
				<input type="number" class="form-control" value="<?php echo $qte_unitaire; ?>" style="width:50%" readonly>
			</div>	
			<div class="col-md-3">
				<b>Quantité à utiliser</b>
				<input type="number" class="form-control" value="<?php echo $qte_utiliser; ?>" style="width:50%" readonly
				 id="qtemp<?php echo $enregmp['id'];?>-<?php echo $enregnom["idsemi"];?>">
			</div>				
		</div>	
	<?php } ?>
	
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
		var tableau_idsf 		= "";	
		var tableau_idmp 		= "";	
		var tableau_qtemp		= "";	
		<?php
		$reqnom="select * from erp_fab_detpreparation_sf where iddet=".$iddet." and produit=".$idproduit;
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

		<?php
			$reqmp="select * from erp_fab_detof_mp_emballage where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi'];
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){		
		?>
			
			var idsemi = <?php echo $enregnom['idsemi']; ?>;
			var idmp   = <?php echo $enregmp['idmp']; ?>;
			var qte    = $('#qtemp'+idmp+'-'+idsemi).val();
			if (qte>0) {
				if(tableau==""){
					tableau_idsf	   = idsemi;
					tableau_idmp	   = idmp;
					tableau_qtemp	   = qte;
				} else{
					tableau_idsf	   = tableau_idsf+","+idsemi;
					tableau_idmp	   = tableau_idmp+","+idmp;
					tableau_qtemp	   = tableau_qtemp+","+qte;
				}								
			}				
				
			<?php } ?>				
		<?php } ?>
		
		if(tableau!=""){
			$.getJSON("page_ajax/ajax_preparation_emballage_of.php?tableau_idsf="+tableau_idsf+"&tableau_idmp="+tableau_idmp+"&iddet="+iddet+"&idof="+idof+"&idproduit="+idproduit+"&idservice="+idservice+"&tableau_qtemp="+tableau_qtemp+"&tableau="+tableau+"&tableau_qte="+tableau_qte, function (data, status) {
				if (status == "success") {
					idof		=	data.idof;
					document.location.href="detail_of.php?ID="+idof;
				}
					document.location.href="detail_of.php?ID="+idof;
			});				
			
		}
		
	});

</script>