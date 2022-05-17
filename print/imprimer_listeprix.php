
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>TELEC Engineering - Module Achat</title>
        <!-- InstanceEndEditable -->
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link rel="stylesheet" href="file:///C|/wamp/www/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <!-- InstanceBeginEditable name="head" -->
        <!-- InstanceEndEditable -->
		<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<body  style="background-color:#fff">
<?php
	session_start();
	include('../connexion/cn.php');
	$id= $_GET['ID'];
	$req="select * from erp_bc_prix_peinture where id=".$_GET['ID'];
	$query=mysql_query($req);
	while($enreg=mysql_fetch_array($query))
	{
		$reference			=	$enreg["reference"] ;
		$trimestre=0;
		$reqtrim="select * from erp_bc_trimestre where id=".$enreg["trimestre"];
		$querytrim=mysql_query($reqtrim);
		while($enregtrim=mysql_fetch_array($querytrim)){
			$trimestre	=	$enregtrim['trimestre'].'-'.$enreg['annee'];
		}	
	}


?>

<h1> Liste des prix  </h1>
<b><?php echo utf8_encode('Trimestre / Année'); ?> :</b>  <?php echo $trimestre; ?><br>
<div class="table-responsive" style="margin-top:15px">
	<table class="table mb-0" border="1" width="100%">
			<thead>
			<tr>
				<th><b style="color:blue">Produit</b></th>
				<?php 
				$reqfam="select * from erp_bc_famille_couleur ";
				$queryfam=mysql_query($reqfam);
				while($enregfam=mysql_fetch_array($queryfam)){
				?>
					<th><b style="color:blue"><?php echo $enregfam['famille']; ?></b></th>
				<?php } ?>												
			</tr>
			</thead>
			<tbody>
			<?php 
				$reqprd="select * from erp_bc_produits";
				$queryprd=mysql_query($reqprd);
				while($enregprd=mysql_fetch_array($queryprd)){									
			?>										
				<tr>
					 <td><b><?php echo $enregprd['code']; ?><i><br><?php echo $enregprd['designation']; ?></i></b></td>
					<?php 
					$reqfam="select * from erp_bc_famille_couleur ";
					$queryfam=mysql_query($reqfam);
					while($enregfam=mysql_fetch_array($queryfam)){
						$prix='';
						$reqprix="select * from erp_bc_det_prix where idprix=".$id." and produit=".$enregprd['id']." and famillecouleur=".$enregfam['id'];
						$queryprix=mysql_query($reqprix);
						while($enregprix=mysql_fetch_array($queryprix)){
							$prix	=	$enregprix['prix'];
						}
					?>											 
					 <td style="text-align: center;">
						<?php echo $prix; ?>
					 </td>
					 <?php } ?>	
				</tr>
			<?php } ?>										

			</tbody>			
	</table>
</div>
</body>