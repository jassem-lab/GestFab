<?php
	session_start(); 
	include('../connexion/cn.php');  
 
	$idproduit			   	= $_POST['idproduit']; 
?>
	<b>Liste des produits semi-finis</b>
	<select class="form-control select2" name="sf<?php echo $idproduit; ?>" id="sf<?php echo $idproduit; ?>">
		<option value="0"> Sélectionner un produit </option>
		<?php
		$req0="select * from erp_fab_produits where semi=0 and not exists (select * from erp_fab_nomenclature_pf
		where idproduit=".$idproduit."  and erp_fab_nomenclature_pf.idsemi=erp_fab_produits.id)";
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){
			$provenance="";
			$reqp="select * from erp_fab_classe where id=".$enreg0['provenance'];
			$queryp=mysql_query($reqp);
			while($enregp=mysql_fetch_array($queryp)){
				$provenance	=	$enregp['classe'];
			}
		?>
		<option value="<?php echo $enreg0['id']; ?>">
			<?php echo $enreg0['code'].' ('.$provenance.')'; ?>
		</option>
		<?php } ?>																		
	</select>