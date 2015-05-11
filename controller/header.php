<?php 

if(isset($_GET['action']))
{
	if($_GET['action'] == 'login')
	{
		if((isset($_GET['idco']) && isset($_GET['passwordco']) && !empty($_GET['idco']) && !empty($_GET['passwordco'])))
		{	

			require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelUser.php');
			require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/include/configSession.php');

			$model = new User();

			$value = $model->connect($_GET['idco'],$_GET['passwordco']);

			if(!isset($value['empty']))
			{
				$_SESSION['id'] = $value['userid'];
				$_SESSION['nickname'] = $value['usernickname'];

				echo json_encode($value['userid']);
			}
			else
			{
				exit ;
			}
		}
		else
		{
			exit ;
		}
	}
	else if($_GET['action'] == 'logout')
	{
		session_start();
		session_destroy();
		unset($_SESSION);
	}
	else if($_GET['action'] == 'logout')
	{
		session_start();
		session_destroy();
		unset($_SESSION);

		echo json_encode($_GET['action']);
	}
	else if($_GET['action'] == 'search')
	{
		require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelContent.php');

		$model = new Content();
		$limit = 'LIMIT 5';
		$result = null;

		$req = $model->search($_GET['search'],$limit);

		if(!empty($req))
		{
			foreach ($req as $key => $value) 
			{
				$result.='	<div id="'.$value['contentID'].'" class="element-result">
								<a><b>'.$value['contentTitle'].'</b></a>
							</div>';
			}		
		}
		else
		{
			$result ='<b>No Results Found</b>';		
		}	

		print_r($result);
	}
	else if($_GET['action'] == 'load')
	{
		require($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelContent.php');

		$content = new Content();
		$result = $content->exist($_GET['search']);

		if(!empty($result))
		{
			print_r($result[0]['contentID']);
		}
		else
		{
			echo 'no content';
		}
	}
}
else
{
	exit ;
}
?>