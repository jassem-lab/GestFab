<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   = $_POST['id']; 
	$idbc = $_POST['idbc'];
	$produit = "";  $volume = ""; $poids = "";
	$qte_sf	 = ""; $qte_pour_peint	 = "";
	$reqprd="select * from erp_bc_produits where id=".$id;
	$queryprd=mysql_query($reqprd);
	while($enregprd=mysql_fetch_array($queryprd)){
		$produit = $enregprd['code'];
		$volume  = $enregprd['volume'];
		$poids   = $enregprd['poids'];
		$qte_sf	 = $enregprd['stock_sf'];
		$qte_pour_peint = $enregprd['stock_pour_peint'];
	}
	$qte_bc = 0;
	 $req="SELECT produit as id, sum(quantite) as qte, sum(stock_pour_peint) as qte_peint FROM `erp_bc_det_bc` WHERE produit=".$id." and (`idbc`=".$idbc." or  exists(select * from erp_bc_bc where erp_bc_bc.id=erp_bc_det_bc.idbc and idbc_original=".$idbc." and type=1))  group by produit";
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){	
		$qte_bc = $enreg['qte'];
		$qte_pour_peint = $enreg['qte_peint'];
	}
?>
	<div class="col-md-12"><br>
		<b>QTE SF : <span style="color:green"><?php echo $qte_sf; ?></span> 
		| QTE demandée Pour peinture : <span style="color:red"> <?php echo $qte_pour_peint; ?> </span> 
		| QTE BC : <span style="color:blue"><?php echo $qte_bc; ?></span>  </b> 
	</div>

	