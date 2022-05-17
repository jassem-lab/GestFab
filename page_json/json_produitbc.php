<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $id   	= $_POST['id']; 
	
	
?>
	<div class="col-sm-4">
	<b>liste des produits</b>
		<select class="form-control select2" name="produit" id="produit" required>
			<option value="0"> Sélectionner un produit </option>
			<?php
			$req="SELECT produit as id, sum(quantite) as qte FROM `erp_bc_det_bc` WHERE `idbc`=".$id." or  exists(select * from erp_bc_bc where erp_bc_bc.id=erp_bc_det_bc.idbc and idbc_original=".$id." and type=1)  group by produit";
			$query=mysql_query($req);
			while($enreg=mysql_fetch_array($query)){
				$produit = "";  $volume = ""; $poids = "";
				$qte_sf	 = ""; $qte_pour_peint	 = "";
				$reqprd="select * from erp_bc_produits where id=".$enreg['id'];
				$queryprd=mysql_query($reqprd);
				while($enregprd=mysql_fetch_array($queryprd)){
					$produit = $enregprd['code'];
					$volume  = $enregprd['volume'];
					$poids   = $enregprd['poids'];
					$qte_sf	 = $enregprd['stock_sf'];
					$qte_pour_peint = $enregprd['stock_pour_peint'];
				}
				$qte_bc = $enreg['qte'];				
			?>
			<option value="<?php echo $enreg['id']; ?>"><?php echo $produit.' | Poids:'.$poids.' | Volume:'.$volume; ?></option>
			<?php } ?>
		</select>
	</div>	
	<div class="col-sm-8"  id="idQTE1">
	</div>	
	<div class="col-sm-12 row" id="idQTE" style="margin-top:15px">
	</div>
		
	<script>
		$("#produit").on('change', function(){
			var id	 = $(this).val(); //id produit
			var idbc = <?php echo $_POST['id']; ?>;
			if( id>0){
				if (window.XMLHttpRequest)
				{
				  xmlhttp_selectBE1=new XMLHttpRequest();
				}else{
				  xmlhttp_selectBE1=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp_selectBE1.onreadystatechange=function(){
					
					if(xmlhttp_selectBE1.status==200 && xmlhttp_selectBE1.readyState==4){
						
						$('#idQTE1').html(xmlhttp_selectBE1.responseText);
					}	
				}
				xmlhttp_selectBE1.open("POST","page_json/json_qteproduit1.php",true);
				xmlhttp_selectBE1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp_selectBE1.send("id="+id+"&idbc="+idbc);	
				$("#idQTE1").show();					
				
				
				if (window.XMLHttpRequest)
				{
				  xmlhttp_selectBE=new XMLHttpRequest();
				}else{
				  xmlhttp_selectBE=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp_selectBE.onreadystatechange=function(){
					
					if(xmlhttp_selectBE.status==200 && xmlhttp_selectBE.readyState==4){
						
						$('#idQTE').html(xmlhttp_selectBE.responseText);
					}	
				}
				xmlhttp_selectBE.open("POST","page_json/json_qteproduit.php",true);
				xmlhttp_selectBE.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp_selectBE.send("id="+id+"&idbc="+idbc);	
				$("#idQTE").show();	

				
			} else{
				$("#idQTE1").hide();	
				$("#idQTE").hide();	
			}
		});
	</script>