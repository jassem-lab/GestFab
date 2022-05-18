<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idphase   				= $_POST['idphase']; 
	$idproduit			   	= $_POST['idproduit']; 
?>
	<b>Liste des matières première</b>
	<select class="form-control select2" name="mp<?php echo $idphase; ?>" id="mp<?php echo $idphase; ?>">
		<option value="0"> Sélectionner une matière </option>
		<?php
		$req0="select * from erp_matieres where not exists (select * from erp_nomenclature
		where idproduit=".$idproduit." and idphase=".$idphase." and erp_nomenclature.idmp=erp_matieres.id)";
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){
		?>
		<option value="<?php echo $enreg0['id']; ?>">
			<?php echo $enreg0['code']; ?>
		</option>
		<?php } ?>																		
	</select>