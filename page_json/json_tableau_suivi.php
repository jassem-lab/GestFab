<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $ifamilledproduit   	= $_POST['famille']; 
?>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

</style>
<div style="overflow-x:auto;">
<table class="table mb-0" style="width:10000%;">
	<tr>
		<td><b>PRODUIT</b></td>
		<td style="color:pink"><b>TOTAL</b></td>
		<?php
		$idtableau=0;
		$reqMax="select max(id) as maxTableau from erp_bc_tableau";
		$queryMax=mysql_query($reqMax);
		if(mysql_num_rows($queryMax)>0){
			while($enregMax=mysql_fetch_array($queryMax)){
				$idtableau	=	$enregMax['maxTableau'];
			}
		} 			
		 $reqphase="select * from erp_bc_famproduits_phases where ifamilledproduit=".$ifamilledproduit." 
		 and  exists (select * from erp_bc_phases where erp_bc_phases.id=erp_bc_famproduits_phases.idphase and type<>5) order by ordre asc";
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
			<td><b style="color:<?php echo $couleur; ?>"><?php echo $phase; ?></b></td>
		 <?php } ?>
			<td><b>REST PROD</b></td>
			<td><b>Prêt à livrer SF</b></td>
			<td><b>STRATIFIES</b></td>
			<td><b>PHASE FINITION</b></td>
			<td><b>SEMI-FINIS</b></td>
	</tr>
		<?php
			$reqprd="select * from erp_bc_produits where famille=".$ifamilledproduit;
			$queryprd=mysql_query($reqprd);
			while($enregprd=mysql_fetch_array($queryprd)){
				//Total commandé 
				$total_cmd=0;
				$reqcmd="select sum(quantite) as sumQte from erp_bc_det_bc where produit=".$enregprd['id'];
				$querycmd=mysql_query($reqcmd);
				while($enregcmd=mysql_fetch_array($querycmd)){
					$total_cmd	=	$enregcmd['sumQte'];
				}
				$reste_cmd = 0;
				$total_qte = 0;				
		?>		
			<tr>
				<td><?php echo $enregprd['code']; ?></td>
				<td  style="color:pink"><?php echo $total_cmd; ?></td>
						
				<?php
				 $reqphase="select * from erp_bc_famproduits_phases where ifamilledproduit=".$ifamilledproduit." 
				 and  exists (select * from erp_bc_phases where erp_bc_phases.id=erp_bc_famproduits_phases.idphase and type<>5) order by ordre asc";
				 $queryphase=mysql_query($reqphase);
				 while($enregphase=mysql_fetch_array($queryphase)){
					 $numphase=0;
					 $reqnum="select * from erp_bc_produits_phases where idproduit=".$enregprd['id']." and idphase=".$enregphase['idphase'];
					 $querynum=mysql_query($reqnum);
					 $numphase=mysql_num_rows($querynum);
					 $qte	=	'0';
					 $total_qte = $total_qte + $qte;
					
					//Retrouver la dérnier quantité
					if($idtableau>0){
						$req2="select * from erp_bc_suivi where idtableau=".$idtableau." and  idproduit=".$enregprd['id']." and idphase=".$enregphase['idphase']." and typephase<>4";
						$query2=mysql_query($req2);
						if(mysql_num_rows($query2)>0){
							while($enreg2=mysql_fetch_array($query2)){
								$qte	=	$enreg2['quantite'];
							}
						}
					}
			    ?>
				<td>
					<input type="number" class="form-control" value="<?php echo $qte; ?>" style="    width: 80px;"
					name="phase-<?php echo $enregphase['idphase']; ?>"  id="phase-<?php echo $enregphase['idphase']; ?>-<?php echo $enregprd['id']; ?>"
					<?php if($total_cmd-$total_qte==0){ ?> readonly <?php } ?> <?php if($numphase<1){ ?> readonly <?php } ?>>
				</td>
				 <?php } ?>	
				 <?php
				 $resteprd="0";$pret="0";
				 if($idtableau>0){
					$reqreste="select sum(quantite) as  resteprd from erp_bc_suivi where typephase=4  and idproduit=".$enregprd['id'];
					$queryreste=mysql_query($reqreste);
					while($enregreste=mysql_fetch_array($queryreste)){
						$resteprd	=	$enregreste['resteprd'];
						$pret		=	$enregreste['resteprd'];
					}
					$resteprd = $total_cmd - $resteprd; 
				  }	else{
					  $resteprd = $total_cmd - $resteprd; 
				  }
				 ?>
				<td><input type="number" class="form-control" value="<?php echo $resteprd; ?>" readonly></td>
				<td><input type="number" class="form-control" value="<?php echo $pret; ?>" readonly></td>
				<input type="hidden" value="<?php echo $resteprd; ?>" id="total_cmd-<?php echo $enregprd['id']; ?>">		
				
				<?php
				$total_startifies		=	0;
				$total_phasefinition	=	0;
				$total_semifinis		=	0;
				if($idtableau>0){
					$reqstartifies="select  * from erp_bc_suivi where idtableau=".$idtableau." and  typephase=1 and idproduit=".$enregprd['id'];
					$querystartifies=mysql_query($reqstartifies);
					while($enregstartifies=mysql_fetch_array($querystartifies)){
						$total_startifies	=	$total_startifies + $enregstartifies['quantite'];
					}
					$reqphasefinition="select  * from erp_bc_suivi where idtableau=".$idtableau." and  typephase=2 and idproduit=".$enregprd['id'];
					$queryphasefinition=mysql_query($reqphasefinition);
					while($enregphasefinition=mysql_fetch_array($queryphasefinition)){
						$total_phasefinition	=	$total_phasefinition + $enregphasefinition['quantite'];
					}
					$reqsemifinis="select  * from erp_bc_suivi where idtableau=".$idtableau." and  typephase=3  and idproduit=".$enregprd['id'];
					$querysemifinis=mysql_query($reqsemifinis);
					while($enregsemifinis=mysql_fetch_array($querysemifinis)){
						$total_semifinis	=	$total_semifinis + $enregsemifinis['quantite'];
					}	
				}
				?>	
				<td><input type="number" class="form-control" value="<?php echo $total_startifies; ?>" readonly></td>	
				<td><input type="number" class="form-control" value="<?php echo $total_phasefinition; ?>" readonly></td>	
				<td><input type="number" class="form-control" value="<?php echo $total_semifinis; ?>" readonly></td>	
			</tr>
		<?php } ?>	

		
		
		
		
</table>
</div>
<div class="col-md-12 row" style="margin-bottom:50px">	
		<div class="col-sm-5">	
		<br>
			<button type="button" class="btn btn-primary waves-effect waves-light" id="btnEnreg">
				Enregistrer et Mise à jour
			</button>
			<a href="export_tableau.php?ID=<?php echo $ifamilledproduit; ?>"
				class="btn btn-success waves-effect waves-light">
				Exporter Excel
			</a>				
		</div>	
	
</div>

<script src="//cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.6.0/src/loadingoverlay.min.js"></script>
<script>
	$("#btnEnreg").on("click", function(){
		var famille 	  = <?php echo $_POST['famille']; ?>;
		var tableau_phase = "";
		var tableau_prd   = "";
		var tableau_qte	  = "";		var i=0;
		//Parcour des lignes produits
			//Parcour des produits de famille
			<?php
			$reqprd="select * from erp_bc_produits where famille=".$_POST['famille'];
			$queryprd=mysql_query($reqprd);
			while($enregprd=mysql_fetch_array($queryprd)){		
			$idproduit = $enregprd['id'];	
			$prd	   = $enregprd['code'];				
			?>
			var quantite = 0;  i = i+1;
			<?php
				//Parcour les phases de famille
				$reqphase="select * from erp_bc_famproduits_phases where ifamilledproduit=".$_POST['famille']." 
				 and  exists (select * from erp_bc_phases where erp_bc_phases.id=erp_bc_famproduits_phases.idphase and type<>5) order by ordre asc";
				 $queryphase=mysql_query($reqphase);
				 while($enregphase=mysql_fetch_array($queryphase)){	
				$idphase = $enregphase['idphase'];			
			?>
				
				var prd		      = <?php echo $idproduit; ?>; 
				var phase         = <?php echo $idphase; ?>;				
				var total_cmd	  = $("#total_cmd-"+prd).val();
				var qte           =  $('#phase-'+phase+'-'+prd).val();	
				if(total_cmd>0){		
					 if(tableau_phase==""){
						tableau_phase = phase;
						tableau_prd   = prd;
						tableau_qte	  = qte;
					 } else{
						tableau_phase = tableau_phase+","+phase;
						tableau_prd   = tableau_prd+","+prd;
						tableau_qte   = tableau_qte+","+qte;	
					 }
					 if(qte>0){
						 quantite	   = parseFloat(quantite)+ parseFloat(qte);				
					 }						
				}
				<?php } ?>
					//Vérification de quantité par rappot la quantité demandé
					if(total_cmd<quantite){
						alert("S'il vous plaît vérifier la quantité entrée lIGNE n°"+ i +", la quantité entrée est supérieure à la quantité commandée.");
						return false;
					}					
			 <?php } ?>
			 alert("Le traitement de cette demande peut prendre quelques minutes");
			 $.LoadingOverlay("show");


			$.getJSON("page_ajax/ajax_suivi_production.php?tableau_qte="+tableau_qte+"&tableau_phase="+tableau_phase+"&tableau_prd="+tableau_prd+"&famille="+famille+"&total_cmd="+total_cmd, function (data, status) {
				if (status == "success") {
					idfamille		=	data.famille;
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
					xmlhttp_selectMa.send("famille="+famille);	
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
					xmlhttp_selectMa.send("famille="+famille);	
					$("#divSuivi").show();									
					$.LoadingOverlay("hide"); return false;
					
			});	
		
	});
</script>