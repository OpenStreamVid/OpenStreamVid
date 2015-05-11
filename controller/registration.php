<?php 


if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && isset($_POST['nickname']) && isset($_POST['password']) && !empty($_POST['nickname']) && !empty($_POST['password']) && empty($_POST['age']))
{
	require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelUser');

	$model = new User();
	
	$model->insert_user($_POST['nickname'], $_POST['email'], $_POST['password']);

	$path1 = 'videos/'.htmlspecialchars($_POST['nickname']);
	$path2 = 'img/user/'.htmlspecialchars($_POST['nickname']);

	$model->create_repertory($path1,$path2);

	if(isset($_FILES['profile-picture']))
	{
		$path = 'img/user/'.htmlspecialchars($_POST['nickname']).'/'.$filename;	
		$model->add_picture($path, $_FILES['profile-picture']['name'], $_FILES['profile-picture']['tmp_name']);
	}
}
else if (!empty($_POST['age']))
{
	echo '<script type="text/javascript"> window.location.replace("error.php"); </script>';	
}

?>