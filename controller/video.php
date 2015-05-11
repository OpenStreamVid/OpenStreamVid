<?php
if(isset($param[1]) && !empty($param[1]))
{
	require(ROOT.'model/ModelContent.php');

	$model = new Content();

	$value = $model->load($param[1]);

	if(!empty($value))
	{
		$value = $value[0];
	}
	else
	{
		header("Location: ".WEBROOT."error");
	}
}
else if($_GET['action'] == 'social')
{
	require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelSocial.php');

	$social = new Social();
	$res = array();

	$res['likes'] = $social->get_like($_GET['contentid']);
	$res['dislikes'] = $social->get_dislike($_GET['contentid']);

	echo json_encode($res);
}
else
{
	header("Location: ".WEBROOT."error");
}
?>