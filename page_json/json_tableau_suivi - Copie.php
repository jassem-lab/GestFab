<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $produit   	= $_POST['produit']; 
?>
<table class="table mb-0"   style="width: 1600px;overflow:auto;">
	<thead>
	<tr>
		<th><b>TOTAL</b></th>
		<?php
		 $reqphase="select * from erp_bc_produits_phases where idproduit=".$produit." 
		 and  exists (select * from erp_bc_phases where erp_bc_phases.id=erp_bc_produits_phases.idphase and type<>4) order by ordre asc";
		 $queryphase=mysql_query($reqphase);
		 while($enregphase=mysql_fetch_array($queryphase)){
			 $phase=""; $couleur= "";
			 $reqp="select * from erp_bc_phases where id=".$enregphase['idphase'];
			 $queryp=mysql_query($reqp);
			 while($enregp=mysql_fetch_array($queryp)){
				  $phase	=	$enregp['phase'];
				  if($enregp['type']==1){
					   $couleur= "#ff5e00";
				  }elseif($enregp['type']==2){
					   $couleur= "#7575e5";
				  }elseif($enregp['type']==3){
					   $couleur= "#9f5d26";
				  } else{
					  $couleur= "#45a15d";
				  }
			 }
		?>
			<th><b style="color:<?php echo $couleur; ?>"><?php echo $phase; ?></b></th>
		 <?php } ?>
			<th><b>REST PROD</b></th>
	</tr>
	</thead>
	<tbody>
		<?php
			//Total commandé 
			$total_cmd=0;
			$reqcmd="select sum(quantite) as sumQte, sum(qte_stratifies) as sumStra, sum(qte_finis) as sumFini, sum(qte_semifinis) as sumFF from erp_bc_det_bc where produit=".$produit;
			$querycmd=mysql_query($reqcmd);
			while($enregcmd=mysql_fetch_array($querycmd)){
				$total_cmd	=	$enregcmd['sumQte']-$enregcmd['sumStra']-$enregcmd['sumFini']-$enregcmd['sumFF'];
			}
			$reste_cmd = 0;
			$total_qte = 0;
		?>
			<tr>
				<input type="hidden" value="<?php echo $total_cmd; ?>" id="total_cmd">
				<td><?php echo $total_cmd; ?></td>
				<?php
				 $reqphase="select * from erp_bc_produits_phases where idproduit=".$produit." 
				 and  exists (select * from erp_bc_phases where erp_bc_phases.id=erp_bc_produits_phases.idphase and type<>4) order by ordre asc ";
				 $queryphase=mysql_query($reqphase);
				 while($enregphase=mysql_fetch_array($queryphase)){	
					$qte	=	'';
					$total_qte = $total_qte + $qte;
			    ?>
				<td>
					<input type="number" class="form-control" style="width:90%"  value="<?php echo $qte; ?>"
					name="phase-<?php echo $enregphase['idphase']; ?>"  id="phase-<?php echo $enregphase['idphase']; ?>">
				</td>
				 <?php } ?>
				 <td><input type="number" class="form-control" style="width:90%"  value="<?php echo $total_cmd-$total_qte; ?>" readonly></td>
			</tr>
	</tbody>
</table>
<?php
//Dérnier Tableau 
$idtableau=0;

 $reqMax="select max(id) as maxTableau from erp_bc_tableau where idproduit=".$produit;
$queryMax=mysql_query($reqMax);
if(mysql_num_rows($queryMax)>0){
	while($enregMax=mysql_fetch_array($queryMax)){
		$idtableau	=	$enregMax['maxTableau'] ;
	}
} 	else{
	$idtableau=0;
}
?>
<?php if($idtableau>0){ ?>
	<div class="col-md-12 row" style="margin-top:50px">	
	<b>Dérnier saisie</b>
	<table class="table mb-0"   style="width: 1600px;overflow:auto;">
		<thead>
		<tr>
			<th><b>TOTAL</b></th>
			<?php
			 $reqphase="select * from erp_bc_produits_phases where idproduit=".$produit." 
			 and  exists (select * from erp_bc_phases where erp_bc_phases.id=erp_bc_produits_phases.idphase and type<>4) order by ordre asc";
			 $queryphase=mysql_query($reqphase);
			 while($enregphase=mysql_fetch_array($queryphase)){
				 $phase=""; $couleur= "";
				 $reqp="select * from erp_bc_phases where id=".$enregphase['idphase'];
				 $queryp=mysql_query($reqp);
				 while($enregp=mysql_fetch_array($queryp)){
					  $phase	=	$enregp['phase'];
					  if($enregp['type']==1){
						   $couleur= "#ff5e00";
					  }elseif($enregp['type']==2){
						   $couleur= "#7575e5";
					  }elseif($enregp['type']==3){
						   $couleur= "#9f5d26";
					  } else{
						  $couleur= "#45a15d";
					  }
				 }
			?>
				<th><b style="color:<?php echo $couleur; ?>"><?php echo $phase; ?></b></th>
			 <?php } ?>
		</tr>
		</thead>
		<tbody>
			<?php
				//Total commandé 
				$total_cmd=0;
				$reqcmd="select sum(quantite) as sumQte, sum(qte_stratifies) as sumStra, sum(qte_finis) as sumFini, sum(qte_semifinis) as sumFF from erp_bc_det_bc where produit=".$produit;
				$querycmd=mysql_query($reqcmd);
				while($enregcmd=mysql_fetch_array($querycmd)){
					$total_cmd	=	$enregcmd['sumQte']-$enregcmd['sumStra']-$enregcmd['sumFini']-$enregcmd['sumFF'];
				}
				$reste_cmd = 0;
				$total_qte = 0;	
			?>
				<tr>
					<input type="hidden" value="<?php echo $total_cmd; ?>" id="total_cmd">
					<td><?php echo $total_cmd; ?></td>
					<?php
					 $reqphase="select * from erp_bc_suivi where idproduit=".$produit." and idtableau=".$idtableau;
					 $queryphase=mysql_query($reqphase);
					 while($enregphase=mysql_fetch_array($queryphase)){	
						$qte	=	$enregphase['quantite'];
						$total_qte = $total_qte + $qte;
					?>
					<td>
						<input type="number" class="form-control" style="width:90%"  value="<?php echo $qte; ?>" readonly>
					</td>
					 <?php } ?>
				</tr>
		</tbody>
	</table>	
	</div>	
<?php } ?>
<div class="col-md-12 row">	
		<div class="col-sm-5">	
		<br>
			<button type="button" class="btn btn-primary waves-effect waves-light" id="btnEnreg">
				Enregistrer et Mise à jour
			</button>
		</div>	
		
		<div class="col-sm-5">	
			<table class="table mb-0">
				<thead>
				<tr>	
					<th><b>BACS STRATIFIES</b></th>
					<th><b>BACS EN PHASE DE FINITION</b></th>
					<th><b>BACS SEMI-FINIS</b></th>
				</tr>
				</thead>	
				<tbody>	
				<?php
					$idtableau="0";
					$reqtableau="select max(id) as max from erp_bc_tableau";
					$querytableau=mysql_query($reqtableau);
					if(mysql_num_rows($querytableau)>0){
						while($enregMax=mysql_fetch_array($querytableau)){
							$idtableau	=	$enregMax['max'] ;
						}
					} 
					
					if($idtableau==""){  $idtableau=0; }
					
					$total_startifies		=	0;
					$total_phasefinition	=	0;
					$total_semifinis		=	0;
					$reqstartifies="select  * from erp_bc_suivi where idproduit=".$produit." and  typephase=1 ";
					$querystartifies=mysql_query($reqstartifies);
					while($enregstartifies=mysql_fetch_array($querystartifies)){
						$total_startifies	=	$total_startifies + $enregstartifies['quantite'];
					}
					$reqphasefinition="select  * from erp_bc_suivi where idproduit=".$produit." and  typephase=2";
					$queryphasefinition=mysql_query($reqphasefinition);
					while($enregphasefinition=mysql_fetch_array($queryphasefinition)){
						$total_phasefinition	=	$total_phasefinition + $enregphasefinition['quantite'];
					}
					$reqsemifinis="select  * from erp_bc_suivi where idproduit=".$produit." and  typephase=3 ";
					$querysemifinis=mysql_query($reqsemifinis);
					while($enregsemifinis=mysql_fetch_array($querysemifinis)){
						$total_semifinis	=	$total_semifinis + $enregsemifinis['quantite'];
					}					
				?>
				<tr>
					<td><?php echo $total_startifies; ?></td>
					<td><?php echo $total_phasefinition; ?></td>
					<td><?php echo $total_semifinis; ?></td>
				</tr>
				</tbody>
			</tbody>	
		</div>	
</div>





<script>
	$("#btnEnreg").on("click", function(){
		var produit 	  = <?php echo $_POST['produit']; ?>;
		var total_cmd	  = $("#total_cmd").val();
		var tableau_phase = "";
		var tableau_qte	  = "";
		var  quantite 	  = 0;
		<?php
			 $reqphase="select * from erp_bc_produits_phases where idproduit=".$_POST['produit']." 
			 and  exists (select * from erp_bc_phases where erp_bc_phases.id=erp_bc_produits_phases.idphase and type<>4) order by ordre asc ";
			 $queryphase=mysql_query($reqphase);
			 while($enregphase=mysql_fetch_array($queryphase)){	
		?>
			 var phase     = <?php echo $enregphase['idphase']; ?>;
			 var qte       =  $('#phase-'+phase).val();
			
			 if(tableau_phase==""){
				tableau_phase = phase;
			    tableau_qte	  = qte;
			 } else{
				tableau_phase = tableau_phase+","+phase;
			    tableau_qte   = tableau_qte+","+qte;	
			 }
			 if(qte>0){
				 quantite	   = parseFloat(quantite)+ parseFloat(qte);				
			 }
		<?php } ?>
		
		//Vérification de quantité par rappot la quantité demandé
		if(total_cmd<quantite){
			alert("S'il vous plaît vérifier la quantité entrée, la quantité entrée est supérieure à la quantité commandée.");
			return false;
		}
		
		if(tableau_phase!=""){
			$.getJSON("page_ajax/ajax_suivi_production.php?tableau_qte="+tableau_qte+"&tableau_phase="+tableau_phase+"&produit="+produit+"&total_cmd="+total_cmd, function (data, status) {
				if (status == "success") {
					idproduit		=	data.produit;
					verification	=	data.verification;
					phase			=	data.phase;
					if(verification==1){
						alert("S'il vous plaît vérifier la quantité entrée dans la phase : "+phase);
						return false;						
					}
					$("#divSuivi").hide();
					if (window.XMLHttpRequest)
					{
					  xmlhttp_selectMa=new XMLHttpRequest();
					}else{
					  xmlhttp_selectMa=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_selectMa.onreadystatechange=function(){
						
						if(xmlhttp_selectMa.status==200 && xmlhttp_selectMa.readyState==4){
							
							$('#divSuivi').html(xmlhttp_selectMa.responseText);
						}	
					}
					xmlhttp_selectMa.open("POST","page_json/json_tableau_suivi.php",true);
					xmlhttp_selectMa.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_selectMa.send("produit="+produit);	
					$("#divSuivi").show();
				}
					$("#divSuivi").hide();
					if (window.XMLHttpRequest)
					{
					  xmlhttp_selectMa=new XMLHttpRequest();
					}else{
					  xmlhttp_selectMa=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_selectMa.onreadystatechange=function(){
						
						if(xmlhttp_selectMa.status==200 && xmlhttp_selectMa.readyState==4){
							
							$('#divSuivi').html(xmlhttp_selectMa.responseText);
						}	
					}
					xmlhttp_selectMa.open("POST","page_json/json_tableau_suivi.php",true);
					xmlhttp_selectMa.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_selectMa.send("produit="+produit);	
					$("#divSuivi").show();									
					
					
			});	
		} else{
			alert('Saisire au moins une quantité');
			return false;
		}		
	});
</script>