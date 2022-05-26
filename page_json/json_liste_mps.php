<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $idservice   				= $_POST['idservice']; 
	$idproduit			   	= $_POST['idproduit']; 
?>

<table class="table mb-0">
	<thead>
	<tr>
		<th><b>Matières première</b></th>
		<th><b>Quantité</b></th>
		<th><b>Action</b></th>
	</tr>
	</thead>
	<tbody>	
<?php
	$reqnom="select * from erp_fab_nomenclature where idproduit=".$idproduit." and idservice=".$idservice;
	$querynom=mysql_query($reqnom);
	while($enregnom=mysql_fetch_array($querynom))
	{
		$mp="";
		$reqmp="select * from erp_fab_mp where id=".$enregnom['idmp'];
		$querymp=mysql_query($reqmp);
		while($enregmp=mysql_fetch_array($querymp)){
			$mp	= $enregmp['code'];
		}
?>
			<tr>
				<td><?php echo $mp; ?></td>
				<td>
					<span id="span_qtemp<?php echo $enregnom['id']; ?>"> <?php echo $enregnom['quantite']; ?></span>
					<input style="display:none;width: 30%;" id="qtemp<?php echo $enregnom['id']; ?>" class="form-control" value="<?php echo $enregnom['quantite']; ?>" >
				</td>
				<td>
					<a id="btnMod<?php echo $enregnom['id']; ?>" data-id="<?php echo $enregnom['id']; ?>" class="btn btn-warning waves-effect waves-light btnModif">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
					<a style="display:none" id="btnModif2<?php echo $enregnom['id']; ?>" data-id="<?php echo $enregnom['id']; ?>" class="btn btn-warning waves-effect waves-light btnModif1">
						Enregistrer
					</a>
					<a id="<?php echo $enregnom['id']; ?>" class="btn btn-sm btn-danger waves-effect waves-light btnDelete">
							<span class="glyphicon glyphicon-trash"></span>
					</a>				
				</td>
			</tr>
	<?php } ?>
	</tbody>	
</table>	

<script>
	$(".btnModif").on("click", function(){
		var id = $(this).data('id'); 
		$("#span_qtemp"+id).hide();
		$("#qtemp"+id).show();
		
		$("#btnMod"+id).hide();
		$("#btnModif2"+id).show();
	});


	$(".btnModif1").on("click", function(){
		var id = $(this).data('id'); 
		var idservice=<?php echo $_POST['idservice']; ?>;
		var idproduit=<?php echo $_POST['idproduit']; ?>;
		var qte = $("#qtemp"+id).val(); 
		
		if(confirm('Confirmez-vous la modification?')){
			var variable="id="+id+"&qte="+qte;
			$.post("page_ajax/ajax_modifnomenclature.php", variable, function (data, status) {
				if (status == "success") {
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps.onreadystatechange=function(){
							
							if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
								
								$('#listeMP'+idservice).html(xmlhttp_listemps.responseText);
							}	
						}
						xmlhttp_listemps.open("POST","page_json/json_liste_mps.php",true);
						xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps.send("idproduit="+idproduit+"&idservice="+idservice);	
						
						//Refraiche la liste des MPs
							if (window.XMLHttpRequest)
							{
							  xmlhttp_selectmps=new XMLHttpRequest();
							}else{
							  xmlhttp_selectmps=new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp_selectmps.onreadystatechange=function(){
								
								if(xmlhttp_selectmps.status==200 && xmlhttp_selectmps.readyState==4){
									
									$('#selectMP'+idservice).html(xmlhttp_selectmps.responseText);
								}	
							}
							xmlhttp_selectmps.open("POST","page_json/json_selectmp.php",true);
							xmlhttp_selectmps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp_selectmps.send("idproduit="+idproduit+"&idservice="+idservice);	
						//Fin refraiche liste des MPs	
				}
			}, 'json');
			$('.page-loader-wrapper').removeClass("show");		
		}
		
	});

	$(".btnDelete").on("click", function(){
		var id = $(this).attr('id');
		var idservice=<?php echo $_POST['idservice']; ?>;
		var idproduit=<?php echo $_POST['idproduit']; ?>;
		
		if(confirm('Confirmez-vous la suppression?')){
			var variable="id="+id;
			$.post("page_ajax/ajax_deletenomenclature.php", variable, function (data, status) {
				if (status == "success") {
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps.onreadystatechange=function(){
							
							if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
								
								$('#listeMP'+idservice).html(xmlhttp_listemps.responseText);
							}	
						}
						xmlhttp_listemps.open("POST","page_json/json_liste_mps.php",true);
						xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps.send("idproduit="+idproduit+"&idservice="+idservice);	
						
						//Refraiche la liste des MPs
							if (window.XMLHttpRequest)
							{
							  xmlhttp_selectmps=new XMLHttpRequest();
							}else{
							  xmlhttp_selectmps=new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp_selectmps.onreadystatechange=function(){
								
								if(xmlhttp_selectmps.status==200 && xmlhttp_selectmps.readyState==4){
									
									$('#selectMP'+idservice).html(xmlhttp_selectmps.responseText);
								}	
							}
							xmlhttp_selectmps.open("POST","page_json/json_selectmp.php",true);
							xmlhttp_selectmps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp_selectmps.send("idproduit="+idproduit+"&idservice="+idservice);	
						//Fin refraiche liste des MPs	
				}
			}, 'json');
			$('.page-loader-wrapper').removeClass("show");		
		}
	});

</script>