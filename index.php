<?php 
 
define('WEBROOT',str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT',str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require(ROOT.'include/configSession.php');


$param = explode('/',$_GET['p']);
$page = $param[0];


if(isset($page))
{
	if(empty($page))
	{
		$page = 'index';
	}

	if($page == 'channel')// AJAX loading cases
	{
		require('view/'. $page .'/'. $page .'.php');

		require(ROOT.'include/include.js.php');
		if(file_exists(ROOT.'js/'. $page .'.js.php'))
		{
			require (ROOT.'js/'. $page .'.js.php');
		}
		else if(file_exists(ROOT.'js/'. $page .'.js'))
		{?> 
			<script src="<?php echo WEBROOT .'js/'. $page .'.js'; ?>"></script> 
		<?php
		}
		
		require('controller/'. $page .'.php');
	}
	else
	{
		require('controller/'. $page .'.php');
		require('view/'. $page .'/'. $page .'.php');

		require(ROOT.'include/include.js.php');
		
		if(file_exists(ROOT.'js/'. $page .'.js.php'))
		{
			require (ROOT.'js/'. $page .'.js.php');
		}
		else if(file_exists(ROOT.'js/'. $page .'.js'))
		{?> 
			<script src="<?php echo WEBROOT .'js/'. $page .'.js'; ?>"></script> 
		<?php
		}
		
	}

}