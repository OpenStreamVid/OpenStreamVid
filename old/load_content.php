<?php
	if(isset($_GET['content']) && !empty($_GET['content']))
	{
		require('model/ModelContent');

		$model = new Content();

		$value = $model->load($_GET['id']);

		if(!empty($vale))
		{
			$value = $value[0];
		}
		else
		{
			header("Location: error.php");
		}
	}

	else
	{
		header("Location: error.php");
	}
?>