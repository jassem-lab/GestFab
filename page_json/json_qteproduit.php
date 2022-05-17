<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   = $_POST['id']; 
	$idbc = $_POST['idbc'];
	if(isset($_POST['idd'])){
		$idd=$_POST['idd'];
	} else{
		$idd=0;
	}
	
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
		$qte_bc 		= $enreg['qte'];
		$qte_pour_peint = $enreg['qte_peint'];
	}
	
	$px		=	"0";
	$pt		=	"0";
	$qte	=	"0";
	$col	=	"0";
	$req="select * from erp_bc_det_bcpeint where idbc=".$idbc." and produit=".$id." and id=".$idd;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$px		=		$enreg['prix_unitaire'];
		$pt		=		$enreg['prix_total'];
		$qte	=		$enreg['quantite'];
		$col	=		$enreg['couleur'];
	}
	
?>
	<input type="hidden" class="form-control" value="<?php echo $qte_bc; ?>" data-id="<?php echo $id; ?>" 
		name="qte_bc-<?php echo $id; ?>" id="qte_bc-<?php echo $id; ?>" readonly>
		<input type="hidden" class="form-control" value="<?php echo $qte_pour_peint; ?>" data-id="<?php echo $id; ?>" 
		name="qte_pour_peint-<?php echo $id; ?>" id="qte_pour_peint-<?php echo $id; ?>" readonly>		
		
	<div class="col-md-3">
		<th><b>Couleur Demandée</b></th>
		<select class="form-control couleur" data-id="<?php echo $id; ?>" name="couleur-<?php echo $id; ?>" id="couleur-<?php echo $id; ?>">
			<option value="0">Sélectionner une couleur</option>
			<?php
				$reqco="select * from erp_bc_couleur order by couleur";
				$queryco=mysql_query($reqco);
				while($enregco=mysql_fetch_array($queryco)){
			?>
				<option value="<?php echo $enregco['id']; ?>" <?php if($col==$enregco['id']){ ?> selected  <?php } ?>>
					<?php echo $enregco['couleur']; ?>
				</option>
			<?php } ?>
		</select>
	</div>
	<div class="col-md-2">
		<b>Prix unitaire </b>
		<input class="form-control" name="px-<?php echo $id; ?>" id="px-<?php echo $id; ?>" value="<?php echo $px; ?>" readonly>
	</div>
	<div class="col-md-2">
		<b>QTE Demandée</b>
		<input class="form-control qte" data-id="<?php echo $id; ?>" type="number" name="qte_dem-<?php echo $id; ?>" id="qte_dem-<?php echo $id; ?>" value="<?php echo $qte; ?>">
		<input class="form-control" data-id="<?php echo $id; ?>" type="hidden" name="anc_qte-<?php echo $id; ?>" id="anc_qte-<?php echo $id; ?>" value="<?php echo $qte; ?>">
	</div>	
	<div class="col-md-2">
		<b>Prix total</b>
		<input class="form-control" name="pt-<?php echo $id; ?>" id="pt-<?php echo $id; ?>" value="<?php echo $pt; ?>" readonly>
	</div>		

	<script>
		$(".couleur").on('change', function(){
			var id= $(this).data('id'); //id produit
			var couleur=$("#couleur-"+id).val(); //valuer couleur
			$.getJSON("page_json/json_prixpeintur_produit.php?id="+id+"&couleur="+couleur, function (data, status) {
				if (status == "success") {		
					px			=	data.px;
				}	
				$("#px-"+id).val(px);	
			});				
		});
		
		$(".qte").on("change", function(){
			var id= $(this).data('id'); //id produit
			var qte = $("#qte_dem-"+id).val();
			var qtebc = $("#qte_bc-"+id).val();
			var qtepeint = $("#qte_pour_peint-"+id).val();
			var anc_qte = $("#anc_qte-"+id).val();
			qte = (parseFloat(qte)+parseFloat(qtepeint)) - parseFloat(anc_qte);
			if(parseFloat(qte)>parseFloat(qtebc)){
				alert("Impossible de demander une quantité supérieure à la quantité de bon commande");
				$("#qte_dem-"+id).val('');
				$("#pt-"+id).val('');
				return false;				
			}
			var px  = $("#px-"+id).val();
			var total = px * qte;
			
			$("#pt-"+id).val(total);
		});
		$(".qte").on("keyup", function(){
			var id= $(this).data('id'); //id produit
			var qte = $("#qte_dem-"+id).val();
			var qtebc = $("#qte_bc-"+id).val();
			var qtepeint = $("#qte_pour_peint-"+id).val();
			var anc_qte = $("#anc_qte-"+id).val();
			qte = (parseFloat(qte)+parseFloat(qtepeint)) - parseFloat(anc_qte);
			if(parseFloat(qte)>parseFloat(qtebc)){
				alert("Impossible de demander une quantité supérieure à la quantité de bon commande");
				$("#qte_dem-"+id).val('');
				$("#pt-"+id).val('');
				return false;				
			}		
			var px  = $("#px-"+id).val();
			var total = px * qte;
			
			$("#pt-"+id).val(total);
		});	
		$(".qte").on("keypress", function(){
			var id= $(this).data('id'); //id produit
			var qte = $("#qte_dem-"+id).val();
			var qtebc = $("#qte_bc-"+id).val();
			var qtepeint = $("#qte_pour_peint-"+id).val();
			var anc_qte = $("#anc_qte-"+id).val();
			qte = (parseFloat(qte)+parseFloat(qtepeint)) - parseFloat(anc_qte);
			if(parseFloat(qte)>parseFloat(qtebc)){
				alert("Impossible de demander une quantité supérieure à la quantité de bon commande");
				$("#qte_dem-"+id).val('');
				$("#pt-"+id).val('');
				return false;				
			}			
			var px  = $("#px-"+id).val();
			var total = px * qte;
			
			$("#pt-"+id).val(total);
		});		
		
	
	</script>	
	