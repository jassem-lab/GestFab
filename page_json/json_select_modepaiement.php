<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $mode_paiement   	= $_POST['mode_paiement']; 

	$trimestre=0;
	$req="select * from erp_bc_paiementsf where mode=".$mode_paiement;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$mode            = $enreg['mode'];
		$montant            = $enreg['montant'];
		$banque            = $enreg['banque'];
		$numero            = $enreg['numero'];
		$echeance            = $enreg['echeance'];
	}



?>
	<b>Liste des factures</b>
	<select class="form-control select2" name="facture" id="facture">
		<option value="0"> Sélectionner une facture</option>
		<?php
		$req0="select * from erp_bc_factsf where trimestre=".$trimestre;
		$query0=mysql_query($req0);
		while($enreg0=mysql_fetch_array($query0)){	
			
		?>
		<option value="<?php echo $enreg0['id']; ?>">
			<?php echo $enreg0['reference']; ?>
		</option>
		<?php } ?>																		
	</select>

