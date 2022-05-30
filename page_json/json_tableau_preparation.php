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
<table class="table mb-0">
	<thead>
		<tr>
			<th><b>Produit SF</b></th>
			<th><b>QTE Demandée</b></th>
			<th><b style="color:green">QTE Disponible</b></th>
			<th><b style="color:orange">QTE à fabriquer</b></th>
			<th><b>Cycle (Seconde)</b></th>
			<th><b>Cycle (Minute)</b></th>
			<th><b>Cycle (Heures)</b></th>
			<th><b>Poids NET Demandée</b></th>
			<th><b style="color:red">FM</b></th>
			<th><b style="color:red">FA</b></th>
			<th><b style="color:red">FZ</b></th>
		</tr>
	</thead>
	<tbody>	
	<?php
$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit." and exists(select * from erp_fab_produits_service where  erp_fab_produits_service.idproduit = erp_fab_nomenclature_pf.idsemi AND idservice =".$idservice.")";
$querynom=mysql_query($reqnom);
if(mysql_num_rows($querynom)<1){ ?>
	<b style="color:red"> VERIFIER LA NOMENCLATURE DES SEMIS-FINIS</b>
	<?php 
		$req2="select * from erp_fab_detof_sf where idof=".$id." and produit=".$idproduit." and iservice=".$idservice;
		$query2=mysql_query($req2);
		while($enreg2=mysql_fetch_array($query2)){
		$qte_demandee=$enreg2["quantite"]*$qte_demande;
		$sproduit			=	"";
		$qte_disponible		=	0;
		$reqfm="select * from erp_fab_produits where id=".$enreg2["idsemi"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
			$qte_disponible	=	$enregfm["stock"]-$enregfm["stock_reservee"];
		}
		if($qte_disponible>$qte_demandee){
			$qte_fabrication=0;
		} else{
			$qte_fabrication=$qte_demandee-$qte_disponible;
		}		
	?>
		<tr>
			<td><?php echo $sproduit; ?></td>
			<td><?php echo $qte_demandee; ?></td>
			<td><b style="color:green"><?php echo $qte_disponible; ?></b></td>
			<td><b style="color:orange"><?php echo $qte_fabrication; ?></b></td>			
		</tr>
		<?php } ?>
<?php } 
while($enregnom=mysql_fetch_array($querynom)){	

		$sproduit			=	"";
		$qte_disponible		=	0;
		$reqfm="select * from erp_fab_produits where id=".$enregnom["idsemi"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
			$qte_disponible	=	$enregfm["stock"]-$enregfm["stock_reservee"];
		}	
		
		$qte_demandee=$enregnom["quantite"]*$qte_demande;
		if($qte_disponible>$qte_demandee){
			$qte_fabrication=0;
		} else{
			$qte_fabrication=$qte_demandee-$qte_disponible;
		}

		$temps_cycle		=	0;
		$poids_net			=	0;
		$cavity				=	0;	
		$qte_FM				=	0;
		$qte_FA				=	0;
		$qte_FZ				=	0;		
		$reqs="select * from erp_fab_produits_service where idproduit=".$enregnom["idsemi"];
		$querys=mysql_query($reqs);
		while($enregs=mysql_fetch_array($querys)){
			$reqser="select * from erp_fab_service where id=".$enregs['idservice'];
			$queryser=mysql_query($reqser);
			while($enregser=mysql_fetch_array($queryser)){
				
				$reqmp="select * from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
				and exists (select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FM%' )";
				$querymp=mysql_query($reqmp);
				$num_fm=mysql_num_rows($querymp);
				while($enregmp=mysql_fetch_array($querymp)){
					$qte_FM = $qte_FM + $enregmp['quantite'];			
				}	
				
				$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
				and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FA%')";
				$querymp=mysql_query($reqmp);
				while($enregmp=mysql_fetch_array($querymp)){
					$qte_FA = $qte_FA + $enregmp['qte_mp'];			
				}
				
				
				$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
				and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FZ%')";
				$querymp=mysql_query($reqmp);
				while($enregmp=mysql_fetch_array($querymp)){
					$qte_FZ = $qte_FZ + $enregmp['qte_mp'];			
				}				
				
			}

			$temps_cycle		=	$temps_cycle + $enregs['temps_execution'];
			$poids_net			=	$poids_net + $enregs['poids_net'];
			$cavity				=	$cavity + $enregs['cavity'];
		}
		
		$poids_net			=	 $poids_net	+ (($poids_net*2)/100);
		if($cavity>0){
			$temps_cycle		=	number_format((($temps_cycle*$qte_fabrication)/$cavity),'0','.','');
		} else{
			$temps_cycle		=	0;
		}
		
		if($cavity>0){
			$poids_net			=	number_format((($poids_net*$qte_fabrication)/$cavity),'0','.','');
		} else{
			$poids_net			=	0;
		}

		$fa = 0;
		if($qte_FA>0){
			$fa = ($qte_FA/1000)*100;
			if($poids_net>0){
				$fa = number_format((($poids_net*$fa)/100),'3','.','');
			} else{
				$fa = 'Vérifier le poids';
			}
		}
		$fz = 0;
		if($qte_FZ>0){
			$fz = ($qte_FZ/1000)*100;
			if($poids_net>0){
				$fz = number_format((($poids_net*$fz)/100),'3','.','');
			} else{
				$fz = 'Vérifier le poids';
			}
		}	
		$fm = 0 ;
		if($qte_FM>0){
			
			if($poids_net>0){
				$fm = $poids_net - $fa -  $fz;
			} else{
				$fm = 'Vérifier le poids';
			}			
		}		
		$minute=0;
		if($temps_cycle>0){
			$minute	=	number_format(($temps_cycle/60),0,'.','');
		}
		$heure=0;
		if($minute>0){
			$heure	=	number_format(($minute/60),0,'.','');
		}		
		
?>
			
		<tr>
			<td><a href="affectation_service.php?IDP=<?php echo $enregnom["idsemi"]; ?>" target="_blank"><?php echo $sproduit; ?></a></td>
			<td><?php echo $qte_demandee; ?></td>
			<td><b style="color:green"><?php echo $qte_disponible; ?></b></td>
			<td><b style="color:orange"><?php echo $qte_fabrication; ?></b></td>
			<td><?php echo $temps_cycle; ?></td>
			<td><?php echo $minute; ?></td>
			<td><?php echo $heure; ?></td>
			<td><?php echo $poids_net; ?></td>
			<td><b style="color:red"><?php echo $fm; ?></b></td>
			<td><b style="color:red"><?php echo $fa; ?></b></td>
			<td><b style="color:red"><?php echo $fz; ?></b></td>			
		</tr>
	
<?php } ?>
	</tbody>		
</table>	

	<h4 style="color:brown">Valider la préparation de stock</h4>
	<?php
$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit." and exists(select * from erp_fab_produits_service where  erp_fab_produits_service.idproduit = erp_fab_nomenclature_pf.idsemi AND idservice =".$idservice.")";
$querynom=mysql_query($reqnom);
while($enregnom=mysql_fetch_array($querynom)){	

		$sproduit			=	"";
		$qte_disponible		=	0;
		$reqfm="select * from erp_fab_produits where id=".$enregnom["idsemi"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
			$qte_disponible	=	$enregfm["stock"]-$enregfm["stock_reservee"];
		}	
		
		$qte_demandee=$enregnom["quantite"]*$qte_demande;
		if($qte_disponible>$qte_demandee){
			$qte_fabrication=0;
		} else{
			$qte_fabrication=$qte_demandee-$qte_disponible;
		}
		$temps_cycle		=	0;
		$poids_net			=	0;
		$cavity				=	0;	
		$qte_FM				=	0;
		$qte_FA				=	0;
		$qte_FZ				=	0;		
		$reqs="select * from erp_fab_produits_service where idproduit=".$enregnom["idsemi"];
		$querys=mysql_query($reqs);
		while($enregs=mysql_fetch_array($querys)){
			$reqser="select * from erp_fab_service where id=".$enregs['idservice'];
			$queryser=mysql_query($reqser);
			while($enregser=mysql_fetch_array($queryser)){
				
				$reqmp="select * from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
				and exists (select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FM%' )";
				$querymp=mysql_query($reqmp);
				$num_fm=mysql_num_rows($querymp);
				while($enregmp=mysql_fetch_array($querymp)){
					$qte_FM = $qte_FM + $enregmp['quantite'];			
				}	
				
				$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
				and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FA%')";
				$querymp=mysql_query($reqmp);
				while($enregmp=mysql_fetch_array($querymp)){
					$qte_FA = $qte_FA + $enregmp['qte_mp'];			
				}
				
				
				$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
				and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FZ%')";
				$querymp=mysql_query($reqmp);
				while($enregmp=mysql_fetch_array($querymp)){
					$qte_FZ = $qte_FZ + $enregmp['qte_mp'];			
				}				
				
			}

			$temps_cycle		=	$temps_cycle + $enregs['temps_execution'];
			$poids_net			=	$poids_net + $enregs['poids_net'];
			$cavity				=	$cavity + $enregs['cavity'];
		}
		
		$poids_net			=	 $poids_net	+ (($poids_net*2)/100);
		if($cavity>0){
			$temps_cycle		=	number_format((($temps_cycle*$qte_fabrication)/$cavity),'0','.','');
		} else{
			$temps_cycle		=	0;
		}
		
		if($cavity>0){
			$poids_net			=	number_format((($poids_net*$qte_fabrication)/$cavity),'0','.','');
		} else{
			$poids_net			=	0;
		}

		$fa = 0;
		if($qte_FA>0){
			$fa = ($qte_FA/1000)*100;
			if($poids_net>0){
				$fa = number_format((($poids_net*$fa)/100),'3','.','');
			} else{
				$fa = 'Vérifier le poids';
			}
		}
		$fz = 0;
		if($qte_FZ>0){
			$fz = ($qte_FZ/1000)*100;
			if($poids_net>0){
				$fz = number_format((($poids_net*$fz)/100),'3','.','');
			} else{
				$fz = 'Vérifier le poids';
			}
		}	
		$fm = 0 ;
		if($qte_FM>0){
			
			if($poids_net>0){
				$fm = $poids_net - $fa -  $fz;
			} else{
				$fm = 'Vérifier le poids';
			}			
		}		
		$minute=0;
		if($temps_cycle>0){
			$minute	=	number_format(($temps_cycle/60),0,'.','');
		}
		$heure=0;
		if($minute>0){
			$heure	=	number_format(($minute/60),0,'.','');
		}			
?>
	<div class="col-md-12 row" style="margin-top:5px;margin-bottom:10px">
		<div class="col-md-2">
			<b><?php echo $sproduit; ?></b>
		</div>
		<div class="col-md-3">
			<b>Quantité à Fabriquer</b>
			<input type="number" class="form-control" value="<?php echo $qte_fabrication; ?>" id="qtesf<?php echo $enregnom['idsemi']; ?>-<?php echo $idservice; ?>" style="width:50%" readonly>
		</div>	
	</div>
			<?php
			$tot_fa="0";
			$reqmp="select * from erp_fab_detof_mp where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi']."
			and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_detof_mp.idmp and code like 'FA%')";
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){
				$mp			=	"";
				$reqfm="select * from erp_fab_mp where id=".$enregmp["idmp"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$mp		=	$enregfm["code"] ;
				}			
				$qte_mp = ((($enregmp['quantite'] / 1000)*100) * $poids_net)/100;
				$tot_fa = $tot_fa + $qte_mp ;
			?>
				<div class="col-sm-12 row" style="margin-top: 5px"> 	
					<div class="col-md-2"></div>			
					<div class="col-md-4">
						<b style="color:orange"> MP: <?php echo $mp; ?></b>
					</div>
					<div class="col-md-3">
						<input type="number" class="form-control" value="<?php echo $qte_mp; ?>" id="qtempfa<?php echo $enregmp['idmp']; ?>-<?php echo $enregnom['idsemi']; ?>-<?php echo $idservice; ?>" style="width:50%">
					</div>	
					<div class="col-md-1"></div>	
				</div>				
			<?php } ?>
			
			<?php
			$tot_fz="0";
			$reqmp="select * from erp_fab_detof_mp where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi']."
			and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_detof_mp.idmp and code like 'FZ%')";
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){
				$mp			=	"";
				$reqfm="select * from erp_fab_mp where id=".$enregmp["idmp"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$mp		=	$enregfm["code"] ;
				}			
				$qte_mp = ((($enregmp['quantite'] / 1000)*100) * $poids_net)/100;
				$tot_fz = $tot_fz + $qte_mp ;
			?>
				<div class="col-sm-12 row" style="margin-top: 5px"> 	
					<div class="col-md-2"></div>			
					<div class="col-md-4">
						<b style="color:orange"> MP: <?php echo $mp; ?></b>
					</div>
					<div class="col-md-3">
						<input type="number" class="form-control" value="<?php echo $qte_mp; ?>" id="qtempfz<?php echo $enregmp['idmp']; ?>-<?php echo $enregnom['idsemi']; ?>-<?php echo $idservice; ?>" style="width:50%">
					</div>	
					<div class="col-md-1"></div>	
				</div>				
			<?php } ?>		

			<?php
			$tot_fm="0";
			$reqmp="select * from erp_fab_detof_mp where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi']."
			and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_detof_mp.idmp and code like 'FM%')";
			$querymp=mysql_query($reqmp);
			$nummp=mysql_num_rows($querymp);
			while($enregmp=mysql_fetch_array($querymp)){
				$mp			=	"";
				$reqfm="select * from erp_fab_mp where id=".$enregmp["idmp"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$mp		=	$enregfm["code"] ;
				}			
				$qte_mp = ($poids_net - $tot_fz - $tot_fa)/($nummp);
				$tot_fm = $tot_fm + $qte_mp ;
			?>
				<div class="col-sm-12 row" style="margin-top: 5px;margin-bottom:20px"> 	
					<div class="col-md-2"></div>			
					<div class="col-md-4">
						<b style="color:orange"> MP: <?php echo $mp; ?></b>
					</div>
					<div class="col-md-3">
						<input type="number" class="form-control" value="<?php echo $qte_mp; ?>" id="qtempfm<?php echo $enregmp['idmp']; ?>-<?php echo $enregnom['idsemi']; ?>-<?php echo $idservice; ?>" style="width:50%">
					</div>	
					<div class="col-md-1"></div>	
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
		var tableau_sfa 		= "";
		var tableau_qfa 		= "";
		var tableau_sfz 		= "";
		var tableau_qfz 		= "";	
		var tableau_sfm 		= "";
		var tableau_qfm 		= "";	

		var tableau_idmpfm 		= "";	
		var tableau_idmpfa 		= "";	
		var tableau_idmpfz		= "";	
		<?php
		$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit." and exists(select * from erp_fab_produits_service where  erp_fab_produits_service.idproduit = erp_fab_nomenclature_pf.idsemi AND idservice =".$idservice.")";
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
			$tot_fa="0";
			$reqmp="select * from erp_fab_detof_mp where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi']."
			and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_detof_mp.idmp and code like 'FA%')";
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){
			?>
				var idmp = <?php echo $enregmp['idmp']; ?>;
				var qtempfa = $('#qtempfa'+idmp+'-'+idsemi+'-'+idservice).val();
				if (qtempfa>0) {
					if(tableau_sfa==""){
						tableau_sfa	   = idsemi;
						tableau_qfa	   = qtempfa;
						tableau_idmpfa = idmp;
					} else{
						tableau_sfa	   = tableau_sfa+","+idsemi;
						tableau_qfa	   = tableau_qfa+","+qtempfa;
						tableau_idmpfa = tableau_idmpfa+","+idmp;
					}								
				}				
			<?php } ?>

			<?php
			$tot_fa="0";
			$reqmp="select * from erp_fab_detof_mp where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi']."
			and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_detof_mp.idmp and code like 'FZ%')";
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){
			?>
				var idmp = <?php echo $enregmp['idmp']; ?>;
				var qtempfz = $('#qtempfz'+idmp+'-'+idsemi+'-'+idservice).val();
				if (qtempfz>0) {
					if(tableau_sfz==""){
						tableau_sfz	   = idsemi;
						tableau_qfz	   = qtempfz;
						tableau_idmpfz = idmp;
					} else{
						tableau_sfz	   = tableau_sfz+","+idsemi;
						tableau_qfz	   = tableau_qfz+","+qtempfz;
						tableau_idmpfz = tableau_idmpfz+","+idmp;
					}								
				}				
			<?php } ?>			
			
			<?php
			$tot_fa="0";
			$reqmp="select * from erp_fab_detof_mp where idof=".$id." and produit=".$idproduit." and idsemi=".$enregnom['idsemi']."
			and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_detof_mp.idmp and code like 'FM%')";
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){
			?>
				var idmp = <?php echo $enregmp['idmp']; ?>;
				var qtempfm = $('#qtempfm'+idmp+'-'+idsemi+'-'+idservice).val();
				if (qtempfm>0) {
					if(tableau_sfm==""){
						tableau_sfm	   = idsemi;
						tableau_qfm	   = qtempfm;
						tableau_idmpfm = idmp;
					} else{
						tableau_sfm	   = tableau_sfm+","+idsemi;
						tableau_qfm	   = tableau_qfm+","+qtempfm;
						tableau_idmpfm = tableau_idmpfm+","+idmp;
					}								
				}				
			<?php } ?>				
			
		<?php } ?>
		
		if(tableau!=""){
			$.getJSON("page_ajax/ajax_preparation_of.php?tableau="+tableau+"&tableau_qte="+tableau_qte+"&iddet="+iddet+"&idof="+idof+"&idproduit="+idproduit+"&idservice="+idservice+"&tableau_sfm="+tableau_sfm+"&tableau_qfm="+tableau_qfm+"&tableau_qfz="+tableau_qfz+"&tableau_sfz="+tableau_sfz
			+"&tableau_sfa="+tableau_sfa+"&tableau_qfa="+tableau_qfa+"&tableau_idmpfm="+tableau_idmpfm+"&tableau_idmpfz="+tableau_idmpfz+"&tableau_idmpfa="+tableau_idmpfa, function (data, status) {
				if (status == "success") {
					idof		=	data.idof;
					document.location.href="detail_of.php?ID="+idof;
				}
					document.location.href="detail_of.php?ID="+idof;
			});				
			
		}
		
	});

</script>