<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $type   	= $_POST['type']; 
	$id		   	= $_POST['id'];
?>
	<b>Liste des produits</b>
	<select class="form-control select2" name="produit" id="produit">
		<option value="0"> Sélectionner un produit</option>
		<?php
		$req0="select * from erp_fab_produits  where semi=0 and provenance=2 and not exists(select * from erp_bc_det_bs where erp_bc_det_bs.produit=erp_fab_produits.id and erp_bc_det_bs.idbs=".$id.")";
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){	
		?>
		<option value="<?php echo $enreg0['id']; ?>">
			<?php echo $enreg0['code'].'-'.$enreg0['designation']; ?>
		</option>
		<?php } ?>																		
	</select>
<script>
	$("#produit").on("change", function(){
		var iddet 	  = $("#produit").val();
		$.getJSON("page_json/json_detailproduit.php?ID="+iddet, function (data, status) {
			if (status == "success") {		
				prix_unitaire	=	data.prix_unitaire;
			}	
			$("#prix_unitaire").val(prix_unitaire);
		});	
	});	
</script>
