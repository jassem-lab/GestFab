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
							<H4>Consultation de besoin en terme de stock</b>							
   
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
		$qte 				=	$enreg['quantite'];
		$idproduit			=	$enreg['produit'];
		//CBN 
			$temps_cycle=0;$poids_net=0;$poids_net1=0;$poids_brute=0;$cavity=0;	
			$qte_FM=0;$qte_FA=0;$qte_FZ=	0;
			$fa=0;$tot_fa=0;$tot_fz=0;$tot_fm=0;$fz=0;$fm=0;		
			$idproduit=$enreg["produit"];
			$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit." and exists(select * from erp_fab_detof_sf where
			erp_fab_detof_sf.produit=erp_fab_nomenclature_pf.idproduit and erp_fab_nomenclature_pf.idsemi=erp_fab_detof_sf.idsemi)";
			$querynom=mysql_query($reqnom);
			while($enregnom=mysql_fetch_array($querynom)){ //Début nomenclature	
				$reqs="select * from erp_fab_produits_service where idproduit=".$enregnom["idsemi"];
				$querys=mysql_query($reqs);
				while($enregs=mysql_fetch_array($querys)){ //Début nomenclature	 SF
					$reqmp="select * from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists (select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FM%' )";
					$querymp=mysql_query($reqmp);
					$num_fm=mysql_num_rows($querymp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FM =  $enregmp['quantite'];			
					}					
					$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FA%')";
					$querymp=mysql_query($reqmp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FA = $enregmp['qte_mp'];			
					}
					$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FZ%')";
					$querymp=mysql_query($reqmp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FZ =   $enregmp['qte_mp'];			
					}	

					$qte_demande=$qte*$enregnom["quantite"];
					if($enregs['cavity']>0){
						$temps_cycle		=	$temps_cycle + number_format((($enregs['temps_execution']*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$temps_cycle		=	$temps_cycle +  0;
					}
					
					if($enregs['cavity']>0){
						$poids_net			=	$poids_net+number_format((($enregs['poids_net']*$qte_demande)/$enregs['cavity']),'3','.','');
						$poids_net1			=	number_format((($enregs['poids_net']*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$poids_net			=	$poids_net+0;
						$poids_net1			=	0;
					}
					
					if($enregs['cavity']>0){
						$poids_brute		=	$poids_brute+number_format((($enregs['poids_brute']*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$poids_brute		=	$poids_brute+0;
					}		

					if($qte_FA>0){
						$fa = ($qte_FA/1000)*100;
						$fa = number_format((($poids_net1*$fa)/100),'3','.','');
						$tot_fa =  $tot_fa + $fa;	
					}
					if($qte_FZ>0){
						$fz = $fz+ ($qte_FZ/1000)*100;
						$fz = number_format((($poids_net1*$fz)/100),'3','.','');
						$tot_fz =  $tot_fz + $fz;	
					}	
					if($qte_FM>0){
						$fm = $fm+($poids_net1 - $fa -  $fz);
						$tot_fm =  $tot_fm + $fz;	
					}
					
				}//Fin nomenclature	 SF
			}	//Fin nomenclature	
		
		//FIN CBN 		
		$minute = number_format(($temps_cycle/60),'3','.','');
		$heure  = number_format(($temps_cycle/60/60),'3','.','');
?>

   
<div class="col-sm-12 row">	
	<div class="col-sm-12">	
		<b> Produit : <?php echo $produit; ?> | Quantité Demandée: <?php echo $qte; ?>  </b>
		<br>
		<b style="margin-left:15px"> Cycle : <?php echo $temps_cycle.' Seconde'; ?>| Cycle : <?php echo ($minute).' Minute'; ?> |  Cycle : <?php echo ($heure).' Heures'; ?></b>
		<br>
		<b style="margin-left:15px"> Poids Net: <?php echo $poids_net; ?> | FZ: <?php echo $tot_fz; ?> | FA: <?php echo $tot_fa; ?> | FM: <?php echo $fm; ?></b>
	</div>							
		<?php
			$reqsf="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit;
			$querysf=mysql_query($reqsf);
			while($enregsf=mysql_fetch_array($querysf)){
				$ssemi			=	"";
				$reqfm="select * from erp_fab_produits where id=".$enregsf["idsemi"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$ssemi		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
				}				
		//CBN 
			$temps_cycle=0;$poids_net=0;$poids_net1=0;$poids_brute=0;$cavity=0;	
			$qte_FM=0;$qte_FA=0;$qte_FZ=	0;
			$fa=0;$tot_fa=0;$tot_fz=0;$tot_fm=0;$fz=0;$fm=0;		
			$idproduit=$enreg["produit"];
			$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit." and idsemi=".$enregsf["idsemi"];
			$querynom=mysql_query($reqnom);
			while($enregnom=mysql_fetch_array($querynom)){ //Début nomenclature	
				$reqs="select * from erp_fab_produits_service where idproduit=".$enregnom["idsemi"];
				$querys=mysql_query($reqs);
				while($enregs=mysql_fetch_array($querys)){ //Début nomenclature	 SF
					$reqmp="select * from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists (select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FM%' )";
					$querymp=mysql_query($reqmp);
					$num_fm=mysql_num_rows($querymp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FM =  $enregmp['quantite'];			
					}					
					$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FA%')";
					$querymp=mysql_query($reqmp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FA = $enregmp['qte_mp'];			
					}
					$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FZ%')";
					$querymp=mysql_query($reqmp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FZ =   $enregmp['qte_mp'];			
					}	

					$qte_demande=$qte*$enregnom["quantite"];
					if($enregs['cavity']>0){
						$temps_cycle		=	$temps_cycle + number_format((($enregs['temps_execution']*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$temps_cycle		=	$temps_cycle +  0;
					}
					
					$poids_net			=	 $poids_net	+ (($poids_net*2)/100);
					$poids_net1			=	 $enregs['poids_net']	+ (($enregs['poids_net']*2)/100);
					if($enregs['cavity']>0){
						$poids_net			=	$poids_net+number_format((($enregs['poids_net']*$qte_demande)/$enregs['cavity']),'3','.','');
						$poids_net1			=	number_format((($poids_net1*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$poids_net			=	$poids_net+0;
						$poids_net1			=	0;
					}
					
					if($enregs['cavity']>0){
						$poids_brute		=	$poids_brute+number_format((($enregs['poids_brute']*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$poids_brute		=	$poids_brute+0;
					}		

					if($qte_FA>0){
						$fa = ($qte_FA/1000)*100;
						$fa = number_format((($poids_net1*$fa)/100),'3','.','');
						$tot_fa =  $tot_fa + $fa;	
					}
					if($qte_FZ>0){
						$fz = $fz+ ($qte_FZ/1000)*100;
						$fz = number_format((($poids_net1*$fz)/100),'3','.','');
						$tot_fz =  $tot_fz + $fz;	
					}	
					if($qte_FM>0){
						$fm = $fm+($poids_net1 - $fa -  $fz);
						$tot_fm =  $tot_fm + $fz;	
					}
					
				}//Fin nomenclature	 SF
			}	//Fin nomenclature	
		$minute = number_format(($temps_cycle/60),'3','.','');
		$heure  = number_format(($temps_cycle/60/60),'3','.','');			
		
		//FIN CBN 				
		?>		
		<div class="col-sm-12 row" style="margin-top: 15px"> 	
			<div class="col-md-1"></div>			
			<div class="col-md-10">
				<b style="color:green"> Semi-Finis : <?php echo $ssemi; ?> | Besoin Stock: <?php echo $enregsf['quantite']*$qte; ?></b>
				<br>
				<b style="color:green; margin-left:15px">Cycle: <?php echo $temps_cycle.' Seconde'; ?> | Cycle: <?php echo $minute.' Minute'; ?> | Cycle: <?php echo $heure.' Heurs'; ?></b>
				<br>
				<b style="color:green;margin-left:15px"> Poids Net: <?php echo $poids_net; ?> | FZ: <?php echo $tot_fz; ?> | FA: <?php echo $tot_fa; ?> | FM: <?php echo $fm; ?></b>
				
				</b>
			</div>
			<div class="col-md-1"></div>	
		</div>	
			<?php
			$tot_fa="0";
			$reqmp="select * from erp_fab_nomenclature where idproduit=".$enregsf['idsemi']." and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code like 'FA%')";
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){
				$mp			=	"";
				$reqfm="select * from erp_fab_mp where id=".$enregmp["idmp"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$mp		=	$enregfm["code"] ;
					$stock  = 	$enregfm["stock"] ;
				}			
				$qte_mp = ((($enregmp['quantite'] / 1000)*100) * $poids_net)/100;
				$tot_fa = $tot_fa + $qte_mp ;
			?>
				<div class="col-sm-12 row" style="margin-top: 15px"> 	
					<div class="col-md-2"></div>			
					<div class="col-md-8">
						<b style="color:orange"> 
							MP: <?php echo $mp; ?> | Besoin Stock: <?php echo $qte_mp; ?>
						</b>
						<b <?php if($stock>$qte_mp){ ?> style="color:green" <?php } else{ ?>  style="color:red"  <?php } ?>> | STOCK DISPONIBLE: <?php echo $stock; ?></b>
					</div>
					<div class="col-md-1"></div>	
				</div>				
			<?php } ?>
			<?php
			$tot_fz="0";
			$reqmp="select * from erp_fab_nomenclature where idproduit=".$enregsf['idsemi']." and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code like 'FZ%')";
			$querymp=mysql_query($reqmp);
			while($enregmp=mysql_fetch_array($querymp)){
				$mp			=	"";
				$reqfm="select * from erp_fab_mp where id=".$enregmp["idmp"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$mp		=	$enregfm["code"] ;
					$stock  = 	$enregfm["stock"] ;
				}			
				$qte_mp = ((($enregmp['quantite'] / 1000)*100) * $poids_net)/100;
				$tot_fz = $tot_fz + $qte_mp ;
			?>
				<div class="col-sm-12 row" style="margin-top: 15px"> 	
					<div class="col-md-2"></div>			
					<div class="col-md-8">
						<b style="color:orange"> 
							MP: <?php echo $mp; ?> | Besoin Stock: <?php echo $qte_mp; ?>
						</b>
						<b <?php if($stock>$qte_mp){ ?> style="color:green" <?php } else{ ?>  style="color:red"  <?php } ?>> | STOCK DISPONIBLE: <?php echo $stock; ?></b>
					</div>
					<div class="col-md-1"></div>	
				</div>					
			<?php } ?>		

			<?php
			$tot_fm="0";
			$reqmp="select * from erp_fab_nomenclature where idproduit=".$enregsf['idsemi']." and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code like 'FM%')";
			$querymp=mysql_query($reqmp);
			$nummp=mysql_num_rows($querymp);
			while($enregmp=mysql_fetch_array($querymp)){
				$mp			=	"";
				$reqfm="select * from erp_fab_mp where id=".$enregmp["idmp"];
				$queryfm=mysql_query($reqfm);
				while($enregfm=mysql_fetch_array($queryfm)){
					$mp		=	$enregfm["code"] ;
					$stock  = 	$enregfm["stock"] ;
				}			
				$qte_mp = ($poids_net - $tot_fz - $tot_fa)/($nummp);
				$tot_fm = $tot_fm + $qte_mp ;
			?>
				<div class="col-sm-12 row" style="margin-top: 15px"> 	
					<div class="col-md-2"></div>			
					<div class="col-md-8">
						<b style="color:orange"> 
							MP: <?php echo $mp; ?> | Besoin Stock: <?php echo $qte_mp; ?>
						</b>
						<b <?php if($stock>$qte_mp){ ?> style="color:green" <?php } else{ ?>  style="color:red"  <?php } ?>> | STOCK DISPONIBLE: <?php echo $stock; ?></b>
					</div>
					<div class="col-md-1"></div>	
				</div>				
			<?php } ?>							

		<?php } ?>	
<?php } ?>							
							
							
							
                        </div>
													
                    </div>

                </div>
            </div>				
		
		
           <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
							<H4>Consultation de besoin Par service</b>							
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>Produit</b></th>
										<th><b>QTE à Commander</b><br><b style="color:orange">Date livraison</b></th>
										<?php
										$req="select * from erp_fab_service";
										$query=mysql_query($req);
										while($enreg=mysql_fetch_array($query)){
										?>
											<th><b><?php echo $enreg['service']; ?> </b></th>
										<?php } ?>
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
										<td><?php echo $enreg['quantite']; ?><br><b style="color:orange"><?php echo $date; ?></b></td>
										<?php
										$reqs="select * from erp_fab_service";
										$querys=mysql_query($reqs);
										while($enregs=mysql_fetch_array($querys)){
											$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$enreg['produit']." and exists(select * from erp_fab_produits_service where  erp_fab_produits_service.idproduit = erp_fab_nomenclature_pf.idsemi AND idservice =".$enregs['id'].")";
											$querynom=mysql_query($reqnom);
											if(mysql_num_rows($querynom)>0){
										?>										
										<td>
											<button type="button" class="btn2 btn-primary waves-effect waves-light" data-toggle="modal" 
													data-target=".bs-example-modal-lg2<?php echo $enreg['id']; ?><?php echo $enregs['id']; ?>" id="<?php echo $enreg['produit']; ?>"  data-id="<?php echo $enreg['id']; ?>" data-id1="<?php echo $enregs['id']; ?>">
													Détail 
											</button>
                                            <div class="modal fade bs-example-modal-lg2<?php echo $enreg['id']; ?><?php echo $enregs['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content"  style="width: 1200px;margin-left: -120px;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"><b style="color:green">
																<?php echo 'Détail service '.$enregs['service'].' Pour le produit '.$produit; ?></b> <br> <?php echo 'Quantité Demandée '.$enreg['quantite']; ?></b> 
															</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
														   <div class="col-md-12 row" id="NomenclatureSER<?php echo $enreg['produit']; ?><?php echo $enreg['id']; ?><?php echo $enregs['id']; ?>">

														   </div>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->														
										</td>
										<?php } } ?>
									</tr>

	<?php } ?>
									
                                </tbody>
                            </table>
                        </div>
													
                    </div>	 
   


			<div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
							<H4>Consultation de besoin globale</b>							
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th><b>Produit</b></th>
										<th><b>QTE à Commander</b><br><b style="color:orange">Date livraison</b></th>
										<th><b>Nomenclature SF</b><br></th>
										<th><b>Nbre de cycle </b></th>
										<th><b>Temps/Min </b></th>
										<th><b>Poids Net</b></th>
										<th><b>Poids brut</b></th>
										<th><b style="color:red">FM</b></th>
										<th><b style="color:red">FA</b></th>
										<th><b style="color:red">FZ</b></th>
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

		//CACLCUL CBN
			$service			=	"";
			$couleur			=	"";
			$cliche				=	"";
			$jig				=	"";
			$moule				=	"";
			$temps_cycle		=	0;
			$box_qty			=	0;
			$poids_net			=	0;
			$poids_net1			=	0;
			$poids_brute		=	0;
			$cavity				=	0;	
			$qte_FM				=	0;
			$qte_FA				=	0;
			$qte_FZ				=	0;
			$fa 				= 	0; 
			$tot_fa 			=   0;
			$tot_fz 			=   0;
			$tot_fm 			=   0;
			$fz 				= 	0;
			$fm 				= 	0;
			$idproduit=$enreg["produit"];
			$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit;
			$querynom=mysql_query($reqnom);
			while($enregnom=mysql_fetch_array($querynom)){ //Début nomenclature	
				$reqs="select * from erp_fab_produits_service where idproduit=".$enregnom["idsemi"];
				$querys=mysql_query($reqs);
				while($enregs=mysql_fetch_array($querys)){ //Début nomenclature	 SF
					$reqmp="select * from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists (select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FM%' )";
					$querymp=mysql_query($reqmp);
					$num_fm=mysql_num_rows($querymp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FM =  $enregmp['quantite'];			
					}	
					$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FA%')";
					$querymp=mysql_query($reqmp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FA = $enregmp['qte_mp'];			
					}
					$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
					and exists(select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FZ%')";
					$querymp=mysql_query($reqmp);
					while($enregmp=mysql_fetch_array($querymp)){
						$qte_FZ =   $enregmp['qte_mp'];			
					}	

					$qte_demande=$enreg["quantite"]*$enregnom["quantite"];
					if($enregs['cavity']>0){
						$temps_cycle		=	$temps_cycle + number_format((($enregs['temps_execution']*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$temps_cycle		=	$temps_cycle +  0;
					}
					$poids_net			=	 $poids_net	+ (($poids_net*2)/100);
					$poids_net1			=	 $enregs['poids_net']	+ (($enregs['poids_net']*2)/100);
					if($enregs['cavity']>0){
						$poids_net			=	$poids_net+number_format((($enregs['poids_net']*$qte_demande)/$enregs['cavity']),'3','.','');
						$poids_net1			=	number_format((($poids_net1*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$poids_net			=	$poids_net+0;
						$poids_net1			=	0;
					}
					
					if($enregs['cavity']>0){
						$poids_brute		=	$poids_brute+number_format((($enregs['poids_brute']*$qte_demande)/$enregs['cavity']),'3','.','');
					} else{
						$poids_brute		=	$poids_brute+0;
					}		

					if($qte_FA>0){
						$fa = ($qte_FA/1000)*100;
						$fa = number_format((($poids_net1*$fa)/100),'3','.','');
						$tot_fa =  $tot_fa + $fa;	
					}
					if($qte_FZ>0){
						$fz = $fz+ ($qte_FZ/1000)*100;
						$fz = number_format((($poids_net1*$fz)/100),'3','.','');
						$tot_fz =  $tot_fz + $fz;	
					}	
					if($qte_FM>0){
						$fm = $fm+($poids_net1 - $fa -  $fz);
						$tot_fm =  $tot_fm + $fz;	
					}		

				} //Fin nomenclature SF
				
				
			} //Fin nomenclature

			
			
		//FIN CACLCUL CBN
?>
									<tr>
                                        <td><?php echo $produit; ?></td>
										<td><?php echo $enreg['quantite']; ?><br><b style="color:orange"><?php echo $date; ?></b></td>
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
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"><b style="color:green">
																<?php echo 'Nomenclature '.$produit; ?></b> <br> <?php echo 'Quantité Demandée '.$enreg['quantite']; ?></b> 
															</h5>
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
										
										<td><?php echo $temps_cycle.' Seconde'; ?></td>
										<td><?php echo number_format(($temps_cycle/60),'3','.','').' Minutes'; ?></td>
										<td><?php echo $poids_net; ?></td>
										<td><b><?php echo $poids_brute; ?></b></td>
										<td><b style="color:red"><?php echo $fm; ?></b></td>
										<td><b style="color:red"><?php echo $tot_fa; ?></b></td>
										<td><b style="color:red"><?php echo $tot_fz; ?></b></td>
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
		xmlhttp_listemps.send("idproduit="+idproduit+"&iddet="+iddet);
	});	
	
	$(".btn2").on("click", function(){
		var idproduit	= $(this).attr('id');
		var iddet		= $(this).data('id');
		var idservice   = $(this).data('id1');
		
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps01=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps01=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps01.onreadystatechange=function(){
			
			if(xmlhttp_listemps01.status==200 && xmlhttp_listemps01.readyState==4){
				
				$('#NomenclatureSER'+idproduit+iddet+idservice).html(xmlhttp_listemps01.responseText);
			}	
		}
		xmlhttp_listemps01.open("POST","page_json/json_tableau_nomenclatureservice.php",true);
		xmlhttp_listemps01.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps01.send("idproduit="+idproduit+"&iddet="+iddet+"&idservice="+idservice);
	});		
</script>