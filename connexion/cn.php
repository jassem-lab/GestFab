<?php
    $connect=mysql_connect("localhost", "root", "") or die ("Echec de la connexion au serveur !");
    $select=mysql_select_db("erp_fab");
	mysql_query("SET NAMES UTF8") ;
?>