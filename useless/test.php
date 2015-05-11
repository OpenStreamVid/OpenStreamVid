<?php 

$array = array( 0 => array( "test" => "marche" ) );

foreach ($array as $key => $value) {
	echo $value['test'];
}
?>