<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

  <div class="page-title-box">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="page-title">Détail OF</h4>
				<br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
			</div>
		</div>
	</div>
  </div>
   <script>
		function Valider(id,idproduit,idservice,iddet)
	  {
			if(confirm('Confirmez-vous cette action?'))
			{
				document.location.href="page_js/valider_preparation_pf.php?ID="+id+"&idproduit="+idproduit+"&idservice="+idservice+"&iddet="+iddet ;
			}			    
	  }	
 
  </script> 
 <?php

	if(isset($_GET['ID'])){
		$id = $_GET['ID'];
		$idof1=0;
		$req="select * from erp_fab_of where id=".$id;
		$query=mysql_query($req);
		while($enreg=mysql_fetch_array($query)){
			$reql="select * from erp_fab_of where id<>".$id." and idbc=".$enreg['idbc'];
			$query1=mysql_query($reql);
			while($enreg1=mysql_fetch_array($query1)){
				$idof1=$enreg1['id'];
			}
		}
	}else{
		$id 		= "0";	
	}

	if(isset($_GET['IDD'])){
		$idd = $_GET['IDD'];
	}else{
		$idd = "0";
	}

	$client				=	"1";
	$remarque			=	"";
	$produit			=	"0";
	$date_livraison		=	"0";
	$prix_unitaire		=	"0";
	$prix_total			=	"0";
	$quantite			=	"1";
	$type				=	0;
	$date				=	date("Y-m-d");
	$emballage_sf		=	0;
	$req="select * from erp_fab_of where id=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$date				=	$enreg["date"] ;
		$reference			=	$enreg["reference"] ;
		$remarque			=	$enreg["observation"] ;
		$emballage_sf		=	$enreg["emballage_sf"] ;
		$refbc="";
		$reqbc="select * from erp_fab_bc where id=".$enreg['idbc'];
		$querybc=mysql_query($reqbc);
		while($enregbc=mysql_fetch_array($querybc)){
			$refbc	=	$enregbc['reference'];
		}		
	}

	?> 
  <div class="page-content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card m-b-20">
						<div class="card-body">
							<a href="gest_of.php" class="btn btn-primary waves-effect waves-light">Retour</a> 
							<?php if(isset($_GET['suc'])){ ?>
								<?php if($_GET['suc']=='1'){ ?>
								<font color="green" style="background-color:#FFFFFF;"><center>Enregistrement effectué avec succès</center></font><br /><br />
							<?php } }?>		
								<div class="form-group row">
									<div class="col-sm-2">
									<b>Référence (*)</b>
										<input class="form-control" type="text" placeholder="Référence" value="<?php echo $reference; ?>" 
										 name="reference" id="reference" readonly required>
									</div>	
									<div class="col-sm-2">
									<b>Référence BC(*)</b>
										<input class="form-control" type="text" placeholder="Référence" value="<?php echo $reference; ?>" 
										 name="reference" id="reference" readonly required>
									</div>										
									<div class="col-sm-2">
									<b>Date (*)</b>
										<input class="form-control" type="date" placeholder="Date" value="<?php echo $date; ?>" id="example-text-input" name="date" required readonly>
									</div>										
								</div>
<div class="form-group row">
	<table class="table mb-0"  >
		<thead>
		<tr>
			<th><b>Produit finis</b></th>
			<th><b style="color:green">Assemblage</b></th>	
			<th><b style="color:green">Emballage</b></th>
		</tr>
		</thead>
		<tbody>
<?php
	$req="select * from erp_fab_detof where idof=".$id;
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query)){
		$qte				=	$enreg["quantite"] ;
		$sproduit			=	"";
		$reqfm="select * from erp_fab_produits where id=".$enreg["produit"];
		$queryfm=mysql_query($reqfm);
		while($enregfm=mysql_fetch_array($queryfm)){
			$sproduit		=	$enregfm["code"].' ('.$enregfm['designation'].')' ;
		}		
		
		$qte_emballage=0;
		$req1="select sum(quantite) as sumQte from erp_fab_detpreparation_sf where  produit=".$enreg['produit']." and idservice=5
		and exists(select * from erp_fab_preparation where erp_fab_preparation.id=erp_fab_detpreparation_sf.idpreparation and idof=".$idof1.")";
		$query1=mysql_query($req1);
		while($enreg1=mysql_fetch_array($query1)){
			$qte_emballage=$enreg1['sumQte'];
		}
?>
		<tr>
			<td><?php echo $sproduit.' <br><i style="color:orange">QTE: '.$qte.'</i> <i style="color:green"> / Qte Emballé: '.$qte_emballage.'</i>'; ?></td>
			<?php if($qte_emballage>0){
				$req3="select * from erp_fab_detpreparation_sf where iddet=".$enreg['id']." and produit=".$enreg['produit']." and idservice=6";
				$query3=mysql_query($req3);
				if(mysql_num_rows($query3)<1){				
			?>
			<td>
					<button type="button" class="btn2 btn-primary waves-effect waves-light" data-toggle="modal" 
							data-target=".bs-example-modal-lg2<?php echo $enreg['id']; ?>6" id="<?php echo $enreg['produit']; ?>"  data-id="<?php echo $enreg['id']; ?>" data-id1="6">
							Préparation 
					</button>
					<div class="modal fade bs-example-modal-lg2<?php echo $enreg['id']; ?>6" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content"  style="width: 1200px;margin-left: -120px;">
								<div class="modal-header">
									<h5 class="modal-title mt-0" id="myLargeModalLabel">
										Préparation de liste SF pour le produit <?php echo $sproduit; ?>
									</h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
								</div>
								<div class="modal-body">
								   <div class="col-md-12 row" id="NomenclatureSF<?php echo $enreg['produit']; ?><?php echo $enreg['id']; ?>6">

								   </div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->	
			</td>	
			<?php } else{ ?>
			<?php
				$etat=0;
				$req4="select * from erp_fab_preparation where idof=".$id." and idproduit=".$enreg['produit']." and idservice=6";
				$query4=mysql_query($req4);
				while($enreg4=mysql_fetch_array($query4)){
					$etat	=	$enreg4['etat'];
				}
				if($etat==0){
			?>
			<td>
				<a href="Javascript:Valider('<?php echo $id; ?>','<?php echo $enreg['produit']; ?>','6','<?php echo $enreg['id']; ?>')" class="btn btn-danger waves-effect waves-light" style="background-color:green">
					Validation de fabrication
				</a>				
			</td>
			<?php } else{ ?>
			<td>
				<b style="color:green"> L'assemblage de PF est terminée</b>
			</td>	
			<?php } }?>
			
			<?php } ?>
		</tr>
<?php } ?>		
		
		
		</tbody>
	</table>	
</div>							
	
						</div>

					</div>
				 </div> 
			</div> 	
			
		 </div> 
  </div>
</div>
<?php include ("menu_footer/footer.php"); ?>
<script>
	$(".btn2").on("click", function(){
		var idproduit	= $(this).attr('id');
		var iddet		= $(this).data('id');
		var idservice   = $(this).data('id1');
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps.onreadystatechange=function(){
			
			if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
				
				$('#NomenclatureSF'+idproduit+iddet+idservice).html(xmlhttp_listemps.responseText);
			}	
		}
		xmlhttp_listemps.open("POST","page_json/json_tableau_preparation_pf.php",true);
		xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps.send("idproduit="+idproduit+"&iddet="+iddet+"&idservice="+idservice);
	});	
	$(".btn3").on("click", function(){
		var idproduit	= $(this).attr('id');
		var iddet		= $(this).data('id');
		var idservice   = 5;
		if (window.XMLHttpRequest)
		{
		  xmlhttp_listemps01=new XMLHttpRequest();
		}else{
		  xmlhttp_listemps01=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp_listemps01.onreadystatechange=function(){
			
			if(xmlhttp_listemps01.status==200 && xmlhttp_listemps01.readyState==4){
				
				$('#NomenclatureSF1'+idproduit+iddet+idservice).html(xmlhttp_listemps01.responseText);
			}	
		}
		xmlhttp_listemps01.open("POST","page_json/json_tableau_preparation_emballage.php",true);
		xmlhttp_listemps01.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp_listemps01.send("idproduit="+idproduit+"&iddet="+iddet+"&idservice="+idservice);
	});		
</script>
