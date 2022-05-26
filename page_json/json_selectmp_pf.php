<?php
	session_start(); 
	include('../connexion/cn.php');  
 
	$idproduit			   	= $_POST['idproduit']; 
?>
	<b>Liste des MPs</b>
	<select class="form-control select2" name="mp<?php echo $idproduit; ?>" id="mp<?php echo $idproduit; ?>">
		<option value="0"> Sélectionner un MP </option>
		<?php
		$req0="select * from erp_fab_mp where not exists (select * from erp_fab_nomenclature_pf
		where idproduit=".$idproduit."  and erp_fab_nomenclature_pf.idmp=erp_fab_mp.id)";
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){
		?>
		<option value="<?php echo $enreg0['id']; ?>">
			<?php echo $enreg0['code']; ?>
		</option>
		<?php } ?>																		
	</select>