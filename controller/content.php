<?php 

if(isset($_POST) && isset($_FILE))
{

}
else if(isset($_GET['title']))
{
	require ($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/model/ModelContent.php');

	$content = new Content();

	if(empty($content->exist(htmlentities($_GET['title']))))
	{
		echo $_GET['title'];
	}
	else
	{
		echo 'exist';
	}
}

?>