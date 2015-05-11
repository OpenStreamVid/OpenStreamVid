<?php 
if(isset($_SESSION['id']))
{
	require(ROOT.'/model/ModelSocial.php');

	$social = new Social();

	$row = $social->get_content_liked($_SESSION['id']);
}
else
{
	echo'<script type="text/javascript">history.go(-1); </script>';
}
?>