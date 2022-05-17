<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idbc_original   	= $_POST['idbc_original']; 
?>
	<b>Liste des produits</b>
	<select class="form-control select2" name="produit" id="produit">
		<option value="0"> Sélectionner un produit</option>
		<?php
		$req0="select * from erp_bc_det_bc  where idbc=".$idbc_original;
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){	
			$codeproduit="";
			$reqprd="select * from erp_bc_produits where id=".$enreg0['produit'];
			$queryprd=mysql_query($reqprd);
			while($enregprd=mysql_fetch_array($queryprd)){
				$codeproduit	=	$enregprd['code'].' ('.$enregprd['designation'].')';
			}
		?>
		<option value="<?php echo $enreg0['produit']; ?>">
			<?php echo $codeproduit; ?>
		</option>
		<?php } ?>																		
	</select>
<script>
	$("#produit").on("change", function(){
		var iddet 	  = $("#produit").val();
		var idbc_original = <?php echo $_POST['idbc_original']; ?>;
		var idbc 	  = 0;
		$.getJSON("page_json/json_detbc_detailproduit.php?ID="+iddet+"&idbc_original="+idbc_original+"&idbc="+idbc, function (data, status) {
			if (status == "success") {		
				poids			=	data.poids;
				volume			=	data.volume;
				prix_unitaire	=	data.prix_unitaire;
				quantite		=	data.quantite;
			}	
			$("#poids").val(poids);	
			$("#volume").val(volume);	
			$("#prix_unitaire").val(prix_unitaire);
			$("#prix_total").val(prix_unitaire);
			$("#quantite").val(quantite);
		});	
	});	
</script>
