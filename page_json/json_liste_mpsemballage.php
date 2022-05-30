<?php
	session_start(); 
	include('../connexion/cn.php');  
 
	$idsf			   	= $_POST['idsf']; 
?>

<table class="table mb-0">
	<thead>
	<tr>
		<th><b>MP</b></th>
		<th><b>Action</b></th>
	</tr>
	</thead>
	<tbody>	
<?php
	$reqnom="select * from erp_fab_nomenclature_emballage where idsemi=".$idsf;
	$querynom=mysql_query($reqnom);
	while($enregnom=mysql_fetch_array($querynom))
	{
		$mp="";
		$reqmp="select * from erp_fab_mp_emballage where id=".$enregnom['idmp'];
		$querymp=mysql_query($reqmp);
		while($enregmp=mysql_fetch_array($querymp)){
			$mp	= $enregmp['code'];
		}
?>
			<tr>
				<td><?php echo $mp; ?></td>
				<td>
					<a id="<?php echo $enregnom['id']; ?>" class="btn btn-sm btn-danger waves-effect waves-light btnDelete">
							<span class="glyphicon glyphicon-trash"></span>
					</a>				
				</td>
			</tr>
	<?php } ?>
	</tbody>	
</table>	

<script>
	
	$(".btnDelete").on("click", function(){
		var id = $(this).attr('id');
		var idsf=<?php echo $_POST['idsf']; ?>;
		
		if(confirm('Confirmez-vous la suppression?')){
			var variable="id="+id;
			$.post("page_ajax/ajax_deletenomenclature_emballage.php", variable, function (data, status) {
				if (status == "success") {
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps.onreadystatechange=function(){
							
							if(xmlhttp_listemps.status==200 && xmlhttp_listemps.readyState==4){
								
								$('#listeMP'+idsf).html(xmlhttp_listemps.responseText);
							}	
						}
						xmlhttp_listemps.open("POST","page_json/json_liste_mpsemballage.php",true);
						xmlhttp_listemps.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps.send("idsf="+idsf);						
				}
			}, 'json');
			$('.page-loader-wrapper').removeClass("show");		
		}
	});

</script>