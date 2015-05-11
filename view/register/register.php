<?php 
	if(!isset($_SESSION['id']))
	{	
		header("Location : error.php",true,303);
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">

	<title>Register</title>

<?php
	require_once 'include/include.css.php';
?>
</head>
<body>
	<div class="content-wrap">
		<a href="index" class="icon">
				<img src="img/site/logo.png" class="icon-name">
		</a>
		<div id="register-form">
			<form id="register-form" method="POST" action="loading.php" enctype="multipart/form-data">
				<fieldset>
					<legend class="register-background">Registration</legend>
					<label class="form-label" id="nickname" for="nickname"> Nickname <small>required</small> : 
						<input type="text" name="nickname" id="nickname-input" class="required">
					</label>		
					<label data-tooltip class="has-tip register-form-label" title="Enter 8 characters minimum. To secure your account we recommend using letters, capital, numbers and special characters." id="password" for="password"> Password <small>required</small> :
						<input type="password" name="password" id="password-input" onkeyup="passwordLengthValidation(this)" class="required">
					</label>	
					<label class="form-label" id="password-confirmation" for="password-confirmation"> Confirm password :
						<input type="password" id="password-confirmation-input" onkeyup="passwordConfirmed(this)">
					</label>		
					<label data-tooltip class="has-tip register-form-label" title="Enter your email (example : email@em.com)" id="email" for="email"> Email <small>required</small> :
						<input type="text" name="email" id="email-input" onkeyup="emailValidation(this)" class="required">
					</label>		
					<label class="form-label" id="email-confirmation" for="email-confirmation"> Confirm email :
						<input type="text"id="email-confirmation-input" onkeyup="emailConfirmed(this)">
					</label>	
					<label class="form-label" id="picture" for="picture">Photo (.gif/.jpg/.png | max. 5 Mo) :<br><br>
						<input type="file" name="profile-picture" data-max-size="5242880" accept="image/jpeg,image/png,image/gif" id="profile-picture"/>
					</label>	
					<!-- No Captcha Anti-Spam (use of a normal ID) -->
					<label id="age" for="age"> Age :
						<input type="text" id="age">
					</label>

					<!-- Error field message div -->
					<div id="message">

					</div>		

					<div class="form-button">
						<input type="submit" value="Register" id="submit-register" class="button success radius"/>
						<a href="index.php" id="cancel-button" class="button alert radius">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>
<?php 
	include 'include/include.js.php'; 
?>
<script src="js/<?php echo substr(basename($_SERVER['PHP_SELF']),0,-4);?>.js"></script>