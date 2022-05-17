<?php

$class_dir = '..\class';

require('../../../register/posc/ean13/html/function.php');

?>

<link type="text/CSS" rel="stylesheet" href="../../../register/posc/ean13/html/style.css" />

<?php
// FileName & Extension
$system_temp_array = explode('/',$_SERVER['PHP_SELF']);
$system_temp_array2 = explode('.',$system_temp_array[count($system_temp_array)-1]);
$filename = $system_temp_array2[0];

$default_value = array();
$default_value['output'] = 1;
$default_value['thickness'] = 30;
$default_value['res'] = 1;
$default_value['font'] = 2;
$default_value['text2display'] = '';
$default_value['a1'] = '';
$default_value['a2'] = '';

$output = '1';
$thickness = '30';
$res = '2';
$font = '4';
$text2display = (isset($_GET['text2display']))?$_GET['text2display']:$default_value['text2display'];
$a1 = (isset($_GET['a1']))?$_GET['a1']:$default_value['a1'];
$a2 = (isset($_GET['a2']))?$_GET['a2']:$default_value['a2'];
$table = new LSTable(0,1,'500',$null);
?>

<?php

if(!empty($text2display)){
	$table->insertRows(0,1);
	$table->addRowAttribute(0,'style','background-color: #ffffff');
	$table->setText(0,0,'<img src="image.php?code='.$filename.'&o='.$output.'&t='.$thickness.'&r='.$res.'&text='.urlencode($text2display).'&f='.$font.'&a1='.$a1.'&a2='.$a2.'" style="image-orientation: 90deg;" alt="Error? Can\'t display image!" />');
	
	
	
}




//-----------------------EAN13
$table->draw();


?>