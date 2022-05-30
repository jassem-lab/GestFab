<?php
	session_start(); 
	include('../connexion/cn.php');  
 
	$idproduit			   	= $_POST['idproduit']; 
	$idservice			   	= $_POST['idservice']; 
	$iddet			  	 	= $_POST['iddet']; 
	$qte_demande=0;
	$reqdet="select * from erp_bc_det_bc where id=".$iddet;
	$querydet=mysql_query($reqdet);
	while($enregdet=mysql_fetch_array($querydet)){
		$qte_demande	=	$enregdet['quantite'];
	}
			
?>

<table class="table mb-0">
	<thead>
		<tr>
			<th><b>Produit SF</b></th>
			<th><b>QTE SF</b></th>
			<th><b>QTE Demandée</b></th>
			<th><b>Cycle Nécessaire (Seconde)</b></th>
			<th><b>Cycle Nécessaire (Minute)</b></th>
			<th><b>Poids NET Demandée</th>
			<th><b>BRUTE</b></th>
			<th><b style="color:red">FM</b></th>
			<th><b style="color:red">FA</b></th>
			<th><b style="color:red">FZ</b></th>
		</tr>
	</thead>
	<tbody>	
	<?php
$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit." and exists(select * from erp_fab_produits_service where  erp_fab_produits_service.idproduit = erp_fab_nomenclature_pf.idsemi AND idservice =".$idservice.")";
$querynom=mysql_query($reqnom);
while($enregnom=mysql_fetch_array($querynom)){	

		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enregnom["idsemi"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}	
		
		
		$service			=	"";
		$couleur			=	"";
		$cliche				=	"";
		$jig				=	"";
		$moule				=	"";
		$temps_cycle		=	0;
		$box_qty			=	0;
		$poids_net			=	0;
		$poids_brute		=	0;
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
				if($service==""){
					$service 			=	$enregser['service'];
				} else{
					$service 			=	$service.' - '.$enregser['service'];
				}
				
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
			
			
			$reqser="select * from erp_fab_couleurs where id=".$enregs['couleur'];
			$queryser=mysql_query($reqser);
			while($enregser=mysql_fetch_array($queryser)){
				if($couleur==""){
					$couleur 			=	$enregser['couleur'];
				} else{
					$couleur 			=	$couleur.' - '.$enregser['couleur'];
				}
			}
			$reqser="select * from erp_fab_cliches where id=".$enregs['cliche'];
			$queryser=mysql_query($reqser);
			while($enregser=mysql_fetch_array($queryser)){
				if($cliche==""){
					$cliche 			=	$enregser['cliche'];
				} else{
					$cliche 			=	$cliche.' - '.$enregser['cliche'];
				}
			}
			
			$reqser="select * from erp_fab_jig where id=".$enregs['jig'];
			$queryser=mysql_query($reqser);
			while($enregser=mysql_fetch_array($queryser)){
				if($jig==""){
					$jig 			=	$enregser['jig'];
				} else{
					$jig 			=	$jig.' - '.$enregser['jig'];
				}
			}		
			
			$reqser="select * from erp_fab_moules where id=".$enregs['jig'];
			$queryser=mysql_query($reqser);
			while($enregser=mysql_fetch_array($queryser)){
				if($moule==""){
					$moule 			=	$enregser['moule'];
				} else{
					$moule 			=	$moule.' - '.$enregser['moule'];
				}
			}	

			$box_qty			=	$box_qty + $enregs['box_qty'];
			$temps_cycle		=	$temps_cycle + $enregs['temps_execution'];
			$poids_net			=	$poids_net + $enregs['poids_net'];
			$poids_brute		=	$poids_brute + $enregs['poids_brute'];
			$cavity				=	$cavity + $enregs['cavity'];
		}
		
		$poids_net			=	 $poids_net	+ (($poids_net*2)/100);
		$qte_demande=$qte_demande*$enregnom["quantite"];
		if($cavity>0){
			$temps_cycle		=	number_format((($temps_cycle*$qte_demande)/$cavity),'3','.','');
		} else{
			$temps_cycle		=	0;
		}
		
		if($cavity>0){
			$poids_net			=	number_format((($poids_net*$qte_demande)/$cavity),'3','.','');
		} else{
			$poids_net			=	0;
		}
		
		if($cavity>0){
			$poids_brute		=	number_format((($poids_brute*$qte_demande)/$cavity),'3','.','');
		} else{
			$poids_brute		=	0;
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
		
		
?>
			
		<tr>
			<td><a href="affectation_service.php?IDP=<?php echo $enregnom["idsemi"]; ?>" target="_blank"><?php echo $sproduit; ?></a></td>
			<td><?php echo $enregnom["quantite"]; ?></td>
			<td><?php echo $qte_demande; ?></td>
			<td><?php echo $temps_cycle.' Secondes'; ?></td>
			<td><?php echo number_format(($temps_cycle/60),'3','.','').' Minutes'; ?></td>
			<td><?php echo $poids_net; ?></td>
			<td><b><?php echo $poids_brute; ?></b></td>
			<td><b style="color:red"><?php echo $fm; ?></b></td>
			<td><b style="color:red"><?php echo $fa; ?></b></td>
			<td><b style="color:red"><?php echo $fz; ?></b></td>
		</tr>
	
<?php } ?>
	</tbody>		
</table>	