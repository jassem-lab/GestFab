<?php
session_start();
include('connexion/cn.php');
	
if  (!isset($_SESSION['TELEC_MAILADMIN'])) 
{
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../login.php" </SCRIPT>';
	exit;
}
else{
	echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../dashbord.php" </SCRIPT>';
	exit;
}

?>