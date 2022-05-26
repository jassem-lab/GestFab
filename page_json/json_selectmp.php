<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idservice   				= $_POST['idservice']; 
	$idproduit			   	    = $_POST['idproduit']; 
?>
	<b>Liste des matières première</b>
	<select class="form-control select2" name="mp<?php echo $idservice; ?>" id="mp<?php echo $idservice; ?>">
		<option value="0"> Sélectionner une matière </option>
		<?php
		$req0="select * from 	erp_fab_mp where not exists (select * from erp_fab_nomenclature
		where idproduit=".$idproduit." and idservice=".$idservice." and erp_fab_nomenclature.idmp=erp_fab_mp.id)";
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){
		?>
		<option value="<?php echo $enreg0['id']; ?>">
			<?php echo $enreg0['code']; ?>
		</option>
		<?php } ?>																		
	</select>