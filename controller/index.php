<?php

require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelIndex.php');

$model = new Index();
$max_new_content = 6;
$tag_content = array();

$tag = $model->get_tag();

foreach ($tag as $key => $value) {
	$tagid=$value['tagid'];

	$tag_content[$key] = $model->get_new_content($tagid, $max_new_content);
}

?>