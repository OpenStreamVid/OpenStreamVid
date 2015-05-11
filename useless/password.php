<!DOCTYPE html>
<head>
	<meta charset="utf8">

	<title>Password lost</title>

<?php
	require_once 'include/config.php';
	require_once 'include/include.css.php';

	if(!isset($_SESSION['id']) || empty($_SESSION['id']))
	{
		echo '<script type="text/javascript"> history.back(-1); </script>';
	}
	else
	{
?>
</head>
<body>
	<div class="content-wrap">
		<a href="index" class="icon">
				<img src="img/site/logo.png" class="icon-name">
		</a>
		<div class="password-form">
			<form id="password-form" method="POST" action="" >
				<fieldset>
					<legend class="password-background">Password lost</legend>
					<label data-tooltip class="has-tip password-form-label" title="Enter 8 characters minimum. To secure your account we recommend using letters, capital, numbers and special characters." id="password" for="password"> Password <small>required</small> : 
						<input type="password" name="password" id="password-input" onkeyup="passwordLengthValidation(this)" class="required">
					</label>			
					<label class="password-form-label" id="password-confirmation" for="password-confirmation"> Confirm new password :
						<input type="password" id="password-confirmation-input" onkeyup="passwordConfirmed(this)">
					</label>	
					<label data-tooltip class="has-tip password-form-label" title="Enter your user email (example : email@em.com)" id="email" for="email"> Email <small>required</small> :
						<input type="text" name="email" id="email-input" class="required">
					</label>

					<!-- Error field message div -->
					<div id="message">

					</div>		

					<div class="password-form-button">
						<input type="submit" id="submit-password" value="Change" class="button radius"/>
						<a href="index.php" id="cancel-button" class="button alert radius">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</body>
<?php 
	}
 ?>
</html>