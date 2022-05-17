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
