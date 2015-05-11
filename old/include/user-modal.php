<div id="user-modal" class="reveal-modal" data-reveal>
	<div id="change-form-container">
		<form id="change-form" method="POST">
			<fieldset>
				<legend>Change</legend>
				<div style="display:none" class="change" id="nickname">
					<label id="changing-nickname">Change nickname :	
						<input type="text" name="nickname" id="changing-nickname-input"> 
					</label>
				</div>
				<div style="display:none" class="change" id="email">
					<label id="changing-email">Change email address :
						<input type="text" name="email" id="changing-email-input"> 
					</label>
				</div>					
				<div style="display:none" class="change" id="picture">
					<label id="changing-picutre">Change profile picture :<br><br>
						<input type="file" name="picture" id="changing-picture-input"> 
					</label>
				</div>	

				<div id="error-response">

				</div>
			</fieldset>
			<div class="modal-buttons">
				<a id="change-button" class="button radius">Change</a>
				<a href="" class="button radius alert">Close</a>
			</div>
		</form>
	</div>
	<div id="change-loading">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<div id="changed" class="welcome-modal">
		<fieldset>
			<legend>Changed</legend>
				<h2>You have successfully done the change</h2>
				<h3>You can close and continue using the website</h3>
				<a href="" class="button radius">Close</a>
		</fieldset>
	</div>
	<a class="close-reveal-modal">&#215;</a>
</div>