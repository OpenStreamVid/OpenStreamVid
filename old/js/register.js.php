
<script type="text/javascript"> 
	$(document).foundation();

	var file = null;

	$('#nickname-input').keyup(function(){
		$.ajax({
			url:'user.php',
			type : 'GET',
			dataType: 'json',
			data : $(this).serialize(),	
			success : function (data){
				if(data < 1){	
					$('#nickname-input').removeClass('invalidInput').addClass('validInput');
				}
				else{
					$('#nickname-input').removeClass('validInput').addClass('invalidInput');	
				}
			},
			error : function(data){
				console.log(data);
			}
		});
	});

	$(document).on('change','#profile-picture',function(e)
	{
		if($(this)[0].files[0].size > $('#profile-picture').data("max-size"))
		{
			file = 'too big';
		}
	});


	$("#register-form").submit(function(e){

		var isFormValid = true;

		if($("#password-input").css('borderTopColor') != "rgb(0, 120, 160)" || $("#password-confirmation-input").css('borderTopColor') != "rgb(0, 120, 160)" || $("#email-input").css('borderTopColor') != "rgb(0, 120, 160)" || $("#email-confirmation-input").css('borderTopColor') != "rgb(0, 120, 160)" || $('#nickname-input').val().length == 0 || file != null)
		{
			isFormValid = false;
		}
		if(!isFormValid) 
		{
			if(!$("#message").hasClass('alert-box alert'))
			{
				$("#message").addClass('alert-box alert')
				$("#message").append('Please fill in all the required fields');	
			}
		}
		else{
			$.ajax({
				url:'user.php',
				type : 'POST',
				dataType: 'json',
				data : $(this).serialize(),	
				success : function (data){

				},
				error : function(data){
					console.log(data);
				},
			});
		}

	});
</script>