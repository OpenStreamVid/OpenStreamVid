<html>
<head>
	<meta charset="utf-8">

	<title>Contact us</title>

	<?php include "include/include.css.php"; ?>
</head>
<body>

	<?php include "include/header.php"; ?>
	<div id="contact-wrap">
		<form id="contact_form" action="#" method="POST" enctype="multipart/form-data">
			<div class="row">
				<label for="name">Your name:</label><br />
				<input id="name" class="input" name="name" type="text" value="" size="30" /><br />
			</div>
			<div class="row">
				<label for="email">Your email:</label><br />
				<input id="email" class="input" name="email" type="text" value="" size="30" /><br />
			</div>
			<div class="row">
				<label for="message">Your message:</label><br />
				<textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
			</div>
			<input id="content_submit_button" class="button" type="submit" value="Send email" />
		</form>	
	</div>					

	<?php include "include/footer.php"; ?>

</body>
</html>
<?php include 'include/include.js.php'; ?>