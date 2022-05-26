<?php include ("menu_footer/menu.php"); ?>

<div class="wrapper">

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Autres tables de base </h4>
                    <br> Utilisateur : <?php echo $_SESSION['erp_fab_USER']; ?>
                </div>
            </div>
        </div>
    </div>

   
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
<?php
	$moules	=	0;
	$req="select * from erp_fab_moules";
	$query=mysql_query($req);
	$moules=mysql_num_rows($query);
	
	$cliches	=	0;
	$req="select * from erp_fab_cliches";
	$query=mysql_query($req);
	$cliches=mysql_num_rows($query);
	
	$jig	=	0;
	$req="select * from erp_fab_jig";
	$query=mysql_query($req);
	$jig=mysql_num_rows($query);	
	
	$color	=	0;
	$req="select * from erp_fab_couleurs";
	$query=mysql_query($req);
	$color=mysql_num_rows($query);		
?>	
						
						
						
                             <table class="table mb-0">
                                    <tr>
                                        <td>Moules (Mold) <b> [ <?php echo $moules; ?> ]</b></td>
										<td>
											<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
												data-target=".bs-example-modal-lg" id="ModifMoule">
												Modifier
											</button>	
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                           
														   <div class="col-md-12 row">
																<div class="col-md-3">
																	<b>Code de Moule</b>
																	<input id="code" name="code" class="form-control" >
																</div>
																<div class="col-md-6">
																	<b>Désignation de Moule</b>
																	<input id="designation" name="designation" class="form-control" >
																</div>																
																<div class="col-md-3">
																	<br>
																	<input type="button" id="" value="Enregistrer" class="btn btn-primary btn-sm btn_moules" >
																</div>															
														   </div>
														   
														   <div class="col-md-12 row" style="margin-top:20px" id="listeMOULES" >
	
														   </div>
														   
														   
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->											
										</td>
                                    </tr>
                                    <tr>
                                        <td>Clichés (CLICHES) <b>[  <?php echo $cliches; ?> ]</b></td>
										<td>
											<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
												data-target=".bs-example-modal-lg1" id="ModifCliche">
												Modifier
											</button>	
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                           
														   <div class="col-md-12 row">
																<div class="col-md-3">
																	<b>Code de Cliche</b>
																	<input id="cliche" name="cliche" class="form-control" >
																</div>
																<div class="col-md-6">
																	<b>Désignation de Cliche</b>
																	<input id="designationc" name="designationc" class="form-control" >
																</div>																
																<div class="col-md-3">
																	<br>
																	<input type="button" id="" value="Enregistrer" class="btn btn-primary btn-sm btn_cliche" >
																</div>															
														   </div>
														   
														   <div class="col-md-12 row" style="margin-top:20px" id="listeCLICHES" >
	
														   </div>
														   
														   
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->											
										</td>
                                    </tr>									
                                    <tr>
										<td>Gigue (JIG)  <b> [ <?php echo $jig; ?> ]</b></td>
										<td>
											<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
												data-target=".bs-example-modal-lg2" id="ModifJIG">
												Modifier
											</button>	
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                           
														   <div class="col-md-12 row">
																<div class="col-md-3">
																	<b>Code de jig</b>
																	<input id="jig" name="jig" class="form-control" >
																</div>
																<div class="col-md-6">
																	<b>Désignation de JIG</b>
																	<input id="designationj" name="designationj" class="form-control" >
																</div>																
																<div class="col-md-3">
																	<br>
																	<input type="button" id="" value="Enregistrer" class="btn btn-primary btn-sm btn_jig" >
																</div>															
														   </div>
														   
														   <div class="col-md-12 row" style="margin-top:20px" id="listeJIG" >
	
														   </div>
														   
														   
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->											
										</td>
                                    </tr>  
                                    <tr>
										<td>Couleurs (COLOR) <b> [  <?php echo $color; ?> ]</b></td>
										<td>
											<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
												data-target=".bs-example-modal-lg3" id="ModifCOL">
												Modifier
											</button>	
                                            <!--  Modal content for the above example -->
                                            <div class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="myLargeModalLabel"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                           
														   <div class="col-md-12 row">
																<div class="col-md-3">
																	<b>Code de couleur</b>
																	<input id="couleur" name="couleur" class="form-control" >
																</div>
																<div class="col-md-6">
																	<b>Désignation de Couleur</b>
																	<input id="designationco" name="designationco" class="form-control" >
																</div>																
																<div class="col-md-3">
																	<br>
																	<input type="button" id="" value="Enregistrer" class="btn btn-primary btn-sm btn_col" >
																</div>															
														   </div>
														   
														   <div class="col-md-12 row" style="margin-top:20px" id="listeCOL" >
	
														   </div>
														   
														   
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->											
										</td>
                                    </tr>   									
							</table>   		
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include ("menu_footer/footer.php"); ?>
<script>
	$(".btn_moules").on("click", function(){
		
		var code = $("#code").val();
		var des  = $("#designation").val();
		
		var variable="code="+code+"&des="+des;
		$.post("page_ajax/ajax_addedit_moules.php", variable, function (data, status) {
			if (status == "success") {	
					verif			=	data.verif;
					if(verif>0){
						alert('Le code '+code+' est déjà existé');
						return false;
					}
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
					xmlhttp_listemps.send("code="+code);	
					
					//Refraiche la liste des MOULES
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
						xmlhttp_listemps.send("code="+code);	
					//Fin refraiche liste des MOULES					

					$('#code').val('');
					$('#designation').val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
		
	});
	
	$("#ModifMoule").on("click", function(){
		var code=0;
		//Refraiche la liste des MOULES
			if (window.XMLHttpRequest)
			{
			  xmlhttp_selectmps1=new XMLHttpRequest();
			}else{
			  xmlhttp_selectmps1=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_selectmps1.onreadystatechange=function(){
				
				if(xmlhttp_selectmps1.status==200 && xmlhttp_selectmps1.readyState==4){
					
					$('#listeMOULES').html(xmlhttp_selectmps1.responseText);
				}	
			}
			xmlhttp_selectmps1.open("POST","page_json/json_liste_moules.php",true);
			xmlhttp_selectmps1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_selectmps1.send("code="+code);	
		//Fin refraiche liste des MOULES	

	});	
	
	
	$(".btn_cliche").on("click", function(){
		
		var code   = $("#cliche").val();
		var des    = $("#designationc").val();
		
		var variable="code="+code+"&des="+des;
		$.post("page_ajax/ajax_addedit_cliches.php", variable, function (data, status) {
			if (status == "success") {	
					verif			=	data.verif;
					if(verif>0){
						alert('Le code '+code+' est déjà existé');
						return false;
					}
					if (window.XMLHttpRequest)
					{
					  xmlhttp_listemps2=new XMLHttpRequest();
					}else{
					  xmlhttp_listemps2=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_listemps2.onreadystatechange=function(){
						
						if(xmlhttp_listemps2.status==200 && xmlhttp_listemps2.readyState==4){
							
							$('#listeCLICHES').html(xmlhttp_listemps2.responseText);
						}	
					}
					xmlhttp_listemps2.open("POST","page_json/json_liste_cliches.php",true);
					xmlhttp_listemps2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_listemps2.send("code="+code);	
					
					//Refraiche la liste des MOULES
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps2=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps2=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps2.onreadystatechange=function(){
							
							if(xmlhttp_listemps2.status==200 && xmlhttp_listemps2.readyState==4){
								
								$('#listeCLICHES').html(xmlhttp_listemps2.responseText);
							}	
						}
						xmlhttp_listemps2.open("POST","page_json/json_liste_cliches.php",true);
						xmlhttp_listemps2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps2.send("code="+code);	
					//Fin refraiche liste des MOULES					

					$('#cliche').val('');
					$('#designationc').val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
		
	});	
	
	$("#ModifCliche").on("click", function(){
		var code=0;
		//Refraiche la liste des MOULES
			if (window.XMLHttpRequest)
			{
			  xmlhttp_selectmps3=new XMLHttpRequest();
			}else{
			  xmlhttp_selectmps3=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_selectmps3.onreadystatechange=function(){
				
				if(xmlhttp_selectmps3.status==200 && xmlhttp_selectmps3.readyState==4){
					
					$('#listeCLICHES').html(xmlhttp_selectmps3.responseText);
				}	
			}
			xmlhttp_selectmps3.open("POST","page_json/json_liste_cliches.php",true);
			xmlhttp_selectmps3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_selectmps3.send("code="+code);	
		//Fin refraiche liste des MOULES	

	});		
	
	$(".btn_jig").on("click", function(){
		
		var code   = $("#jig").val();
		var des    = $("#designationj").val();
		
		var variable="code="+code+"&des="+des;
		$.post("page_ajax/ajax_addedit_jig.php", variable, function (data, status) {
			if (status == "success") {	
					verif			=	data.verif;
					if(verif>0){
						alert('Le code '+code+' est déjà existé');
						return false;
					}
					if (window.XMLHttpRequest)
					{
					  xmlhttp_listemps4=new XMLHttpRequest();
					}else{
					  xmlhttp_listemps4=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_listemps4.onreadystatechange=function(){
						
						if(xmlhttp_listemps4.status==200 && xmlhttp_listemps4.readyState==4){
							
							$('#listeJIG').html(xmlhttp_listemps4.responseText);
						}	
					}
					xmlhttp_listemps4.open("POST","page_json/json_liste_jigs.php",true);
					xmlhttp_listemps4.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_listemps4.send("code="+code);	
					
					//Refraiche la liste des MOULES
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps4=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps4=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps4.onreadystatechange=function(){
							
							if(xmlhttp_listemps4.status==200 && xmlhttp_listemps4.readyState==4){
								
								$('#listeJIG').html(xmlhttp_listemps4.responseText);
							}	
						}
						xmlhttp_listemps4.open("POST","page_json/json_liste_jigs.php",true);
						xmlhttp_listemps4.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps4.send("code="+code);	
					//Fin refraiche liste des MOULES					

					$('#jig').val('');
					$('#designationj').val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
		
	});	
	
	$("#ModifJIG").on("click", function(){
		var code=0;
		//Refraiche la liste des MOULES
			if (window.XMLHttpRequest)
			{
			  xmlhttp_selectmps5=new XMLHttpRequest();
			}else{
			  xmlhttp_selectmps5=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_selectmps5.onreadystatechange=function(){
				
				if(xmlhttp_selectmps5.status==200 && xmlhttp_selectmps5.readyState==4){
					
					$('#listeJIG').html(xmlhttp_selectmps5.responseText);
				}	
			}
			xmlhttp_selectmps5.open("POST","page_json/json_liste_jigs.php",true);
			xmlhttp_selectmps5.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_selectmps5.send("code="+code);	
		//Fin refraiche liste des MOULES	

	});			
	

	$(".btn_col").on("click", function(){
		
		var code   = $("#couleur").val();
		var des    = $("#designationco").val();
		
		var variable="code="+code+"&des="+des;
		$.post("page_ajax/ajax_addedit_couleur.php", variable, function (data, status) {
			if (status == "success") {	
					verif			=	data.verif;
					if(verif>0){
						alert('Le code '+code+' est déjà existé');
						return false;
					}
					if (window.XMLHttpRequest)
					{
					  xmlhttp_listemps6=new XMLHttpRequest();
					}else{
					  xmlhttp_listemps6=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp_listemps6.onreadystatechange=function(){
						
						if(xmlhttp_listemps6.status==200 && xmlhttp_listemps6.readyState==4){
							
							$('#listeCOL').html(xmlhttp_listemps6.responseText);
						}	
					}
					xmlhttp_listemps6.open("POST","page_json/json_liste_couleurs.php",true);
					xmlhttp_listemps6.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp_listemps6.send("code="+code);	
					
					//Refraiche la liste des MOULES
						if (window.XMLHttpRequest)
						{
						  xmlhttp_listemps6=new XMLHttpRequest();
						}else{
						  xmlhttp_listemps6=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp_listemps6.onreadystatechange=function(){
							
							if(xmlhttp_listemps6.status==200 && xmlhttp_listemps6.readyState==4){
								
								$('#listeCOL').html(xmlhttp_listemps6.responseText);
							}	
						}
						xmlhttp_listemps6.open("POST","page_json/json_liste_couleurs.php",true);
						xmlhttp_listemps6.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp_listemps6.send("code="+code);	
					//Fin refraiche liste des MOULES					

					$('#couleur').val('');
					$('#designationco').val('');
			}
		}, 'json');
		$('.page-loader-wrapper').removeClass("show");
		
	});	
	
	$("#ModifCOL").on("click", function(){
		var code=0;
		//Refraiche la liste des MOULES
			if (window.XMLHttpRequest)
			{
			  xmlhttp_selectmps8=new XMLHttpRequest();
			}else{
			  xmlhttp_selectmps8=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp_selectmps8.onreadystatechange=function(){
				
				if(xmlhttp_selectmps8.status==200 && xmlhttp_selectmps8.readyState==4){
					
					$('#listeCOL').html(xmlhttp_selectmps8.responseText);
				}	
			}
			xmlhttp_selectmps8.open("POST","page_json/json_liste_couleurs.php",true);
			xmlhttp_selectmps8.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_selectmps8.send("code="+code);	
		//Fin refraiche liste des MOULES	

	});				
	
	
</script>