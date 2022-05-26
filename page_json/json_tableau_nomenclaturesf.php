<?php
	session_start(); 
	include('../connexion/cn.php');  
 
	$idproduit			   	= $_POST['idproduit']; 
?>

<table class="table mb-0">
	<thead>
		<tr>
			<th><b>Produit SF</b></th>
			<th><b>Services</b></th>
			<th><b>Temps de cycle</b></th>
			<th><b>Couleur </b></th>
			<th><b>Cliches</b> <br><b style="color:grey"> Box Qty </b></th>
			<th><b>Jig <br></b><b style="color:grey"> Moule</b></th>
			<th><b>Poids NET<br><b style="color:grey">BRUTE</b></th>
			<th><b style="color:green">Cavity</b></th>
			<th><b style="color:red">FM</b></th>
			<th><b style="color:red">FA</b></th>
			<th><b style="color:red">FZ</b></th>
		</tr>
	</thead>
	<tbody>	
	<?php
$reqnom="select * from erp_fab_nomenclature_pf where idproduit=".$idproduit;
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
				
				$reqmp="select sum(quantite) as qte_mp from erp_fab_nomenclature where idservice=".$enregs['idservice']." and idproduit=".$enregnom["idsemi"]." 
				and exists (select * from erp_fab_mp where erp_fab_mp.id=erp_fab_nomenclature.idmp and code LIKE 'FM%' )";
				$querymp=mysql_query($reqmp);
				while($enregmp=mysql_fetch_array($querymp)){
					$qte_FM = $qte_FM + $enregmp['qte_mp'];			
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
		
?>
			
		<tr>
			<td><?php echo $sproduit; ?></td>
			<td><?php echo $service; ?></td>
			<td><?php echo $temps_cycle; ?></td>
			<td><?php echo $couleur; ?></td>
			<td><?php echo $cliche.'<br><b style="color:grey">'.$box_qty.'</b>'; ?></td>
			<td><?php echo $moule.'<br><b style="color:grey">'.$jig.'</b>'; ?></td>
			<td><?php echo $poids_net.'<br><b style="color:grey">'.$poids_brute.'</b>'; ?></td>
			<td><b style="color:green"><?php echo $cavity; ?></b></td>
			<td><b style="color:red"><?php echo $qte_FM; ?></b></td>
			<td><b style="color:red"><?php echo $qte_FA; ?></b></td>
			<td><b style="color:red"><?php echo $qte_FZ; ?></b></td>
		</tr>
	
<?php } ?>
	</tbody>		
</table>	