<?php 
	
/**
 	AJAX action
**/
if(isset($_GET['action']))
{
	require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelUser.php');
	$user = new User();

	if($_GET['action'] == 'email')
	{
		echo $user->get_email($_GET['id']);
	}
	elseif ($_GET['action'] == 'exist') 
	{
		$res = $user->exist($_GET['data']);
		echo $res;
	}
	elseif ($_GET['action'] == 'change') 
	{
		require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/include/configSession.php');

		$function = $_GET['function'];

		$array = array( 'function' 	=>	$function,
						'id'		=>	$_SESSION['id'],
						'data'		=>	$_GET['data'],
						'old'		=>	($function == 'nickname') ? $_SESSION['nickname'] : '');

		$user->change($array);

		
		if($function == 'nickname')
		{
			$_SESSION['nickname'] = htmlspecialchars($_GET['data']);
		}

		echo $_GET['data'];
	}
}
/**
		On page load
**/
else
{
	require(ROOT.'/model/ModelContent.php');
	require(ROOT.'/model/ModelIndex.php');

	$content = new Content();

	$row = $content->get($_SESSION['id']);
	// $row = (!empty($row)) ? $row[0] : $row;

	if(!empty($row))
	{
		require(ROOT.'model/ModelSocial.php');

		$social = new Social();

		foreach ($row as $key => $value) 
		{
			$row[$key]['likes'] = $social->get_like($value['contentid']);
			$row[$key]['dislikes'] = $social->get_dislike($value['contentid']);
		}
	}

	$index = new Index();
	$tag = $index->get_tag();
}
?>