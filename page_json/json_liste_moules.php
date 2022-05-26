<?php
	session_start(); 
	include('../connexion/cn.php');  
 
    $code   				= $_POST['code']; 
?>

<table class="table mb-0">
	<thead>
	<tr>
		<th><b>Code</b></th>
		<th><b>Désignation</b></th>
		<th><b>Action</b></th>
	</tr>
	</thead>
	<tbody>	
<?php
	$reqnom="select * from erp_fab_moules";
	$querynom=mysql_query($reqnom);
	while($enregnom=mysql_fetch_array($querynom))
	{
		
?>
			<tr>
				<td>
					<span id="span_moule<?php echo $enregnom['id']; ?>"> <?php echo $enregnom['moule']; ?></span>
					<input style="display:none;width:;" id="moule<?php echo $enregnom['id']; ?>" class="form-control" value="<?php echo $enregnom['moule']; ?>" >				
				</td>
				<td>
					<span id="span_des<?php echo $enregnom['id']; ?>"> <?php echo $enregnom['designation']; ?></span>
					<input style="display:none;width:;" id="des<?php echo $enregnom['id']; ?>" class="form-control" value="<?php echo $enregnom['designation']; ?>" >				
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
		$("#span_moule"+id).hide();
		$("#moule"+id).show();

		$("#span_des"+id).hide();
		$("#des"+id).show();
		
		$("#btnMod"+id).hide();
		$("#btnModif2"+id).show();
	});

	$(".btnModif1").on("click", function(){
		var id = $(this).data('id'); 
		var moule = $("#moule"+id).val(); 
		var des   = $("#des"+id).val(); 
		
		if(confirm('Confirmez-vous la modification?')){
			var variable="moule="+moule+"&des="+des+"&id="+id;
			$.post("page_ajax/ajax_edit_moule.php", variable, function (data, status) {
				if (status == "success") {
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps.onreadystatechange=function(){
							
							if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
								
								$('#listeMOULES').html(xmlhttp_listemps.responseText);
							}	
						}
						xmlhttp_listemps.open("POST","page_json/json_liste_moules.php",true);
						xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps.send("code="+moule);	
						
						//Refraiche la liste des MPs
							if (window.XMLHttpRequest)
							{
							  xmlhttp_selectmps=new XMLHttpRequest();
							}else{
							  xmlhttp_selectmps=new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp_selectmps.onreadystatechange=function(){
								
								if(xmlhttp_selectmps.status==200 && xmlhttp_selectmps.readyState==4){
									
									$('#listeMOULES').html(xmlhttp_selectmps.responseText);
								}	
							}
							xmlhttp_selectmps.open("POST","page_json/json_liste_moules.php",true);
							xmlhttp_selectmps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp_selectmps.send("code="+moule);	
						//Fin refraiche liste des MPs	
				}
			}, 'json');
			$('.page-loader-wrapper').removeClass("show");		
		}
		
	});
	
	$(".btnDelete").on("click", function(){
		var id = $(this).attr('id'); 
		var moule = $("#moule"+id).val(); 
		var des   = $("#des"+id).val(); 
		
		if(confirm('Confirmez-vous la suppression?')){
			var variable="moule="+moule+"&des="+des+"&id="+id;
			$.post("page_ajax/ajax_delete_moule.php", variable, function (data, status) {
				if (status == "success") {
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps.onreadystatechange=function(){
							
							if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
								
								$('#listeMOULES').html(xmlhttp_listemps.responseText);
							}	
						}
						xmlhttp_listemps.open("POST","page_json/json_liste_moules.php",true);
						xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps.send("code="+moule);	
						
						//Refraiche la liste des MPs
							if (window.XMLHttpRequest)
							{
							  xmlhttp_selectmps=new XMLHttpRequest();
							}else{
							  xmlhttp_selectmps=new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp_selectmps.onreadystatechange=function(){
								
								if(xmlhttp_selectmps.status==200 && xmlhttp_selectmps.readyState==4){
									
									$('#listeMOULES').html(xmlhttp_selectmps.responseText);
								}	
							}
							xmlhttp_selectmps.open("POST","page_json/json_liste_moules.php",true);
							xmlhttp_selectmps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
							xmlhttp_selectmps.send("code="+moule);	
						//Fin refraiche liste des MPs	
				}
			}, 'json');
			$('.page-loader-wrapper').removeClass("show");		
		}
		
	});	
	

</script>