<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $bc_select   	= $_POST['bc_select']; 

	$trimestre=0;
	$req="select * from erp_bc_bc where id=".$bc_select;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$trimestre	=	$enreg['trimestre'];
	}



?>
	<b>Liste des factures</b>
	<select class="form-control select2" name="facture_select1" id="facture_select1">
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

