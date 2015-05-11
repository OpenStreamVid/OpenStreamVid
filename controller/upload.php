<?php 

if(isset($_POST) && isset($_FILES) & !empty($_POST) && !empty($_FILES))
{
	require ($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelContent.php');	

	$content = new Content();
	
	$array = $_POST;
	$array['file'] = $_FILES;	
	session_start();
	$array['user'] = $_SESSION['id'];
	$array['nickname'] = $_SESSION['nickname'];

	$added = $content->add($array);

	if(!empty($added))
	{
		echo $added;
	}
}
else
{
	header('Location : error.php',true,303);
	die();
}

?>