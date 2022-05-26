<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $type   	= $_POST['type'];
	$id		   	= $_POST['id'];
?>
	<b>Liste des MPs</b>
	<select class="form-control select2" name="mp" id="mp">
		<option value="0"> Sélectionner un MP</option>
		<?php
		$req0="select * from erp_fab_mp where not exists(select * from erp_bc_det_bcf where erp_bc_det_bcf.mp=erp_fab_mp.id and erp_bc_det_bcf.idbc=".$id.")";
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){	
		?>
		<option value="<?php echo $enreg0['id']; ?>">
			<?php echo $enreg0['code']; ?>
		</option>
		<?php } ?>																		
	</select>
<script src="../plugins/select2/js/select2.min.js"></script>	
<script>
	$("#mp").on("change", function(){
		var iddet 	  = $("#mp").val();
		$.getJSON("page_json/json_detail_mp.php?ID="+iddet, function (data, status) {
			if (status == "success") {		
				prix_unitaire	=	data.prix_unitaire;
			}	
			$("#prix_unitaire").val(prix_unitaire);
		});	
	});	
</script>
