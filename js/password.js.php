<script type="text/javascript"> 
	$('#email-input').keyup(function(){
		$.ajax({
			url:'user.php',
			type : 'GET',
			dataType: 'json',
			data : $(this).serialize(),	
			success : function (data){
				if(data > 0){	
					$('#email-input').removeClass('invalidInput').addClass('validInput');
				}
				else{
					$('#email-input').removeClass('validInput').addClass('invalidInput');	
				}
			},
			error : function(data){
				console.log(data);
			}
		});
	});


	$("#password-form").submit(function(e){

		e.preventDefault();
		var isFormValid = true;

		if($("#password-input").css('borderTopColor') != "rgb(0, 120, 160)" || $("#password-confirmation-input").css('borderTopColor') != "rgb(0, 120, 160)" || $("#email-input").css('borderTopColor') != "rgb(0, 120, 160)")
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
				data : "password=" + $("#password-input").val() + "&email=" + $("#email-input").val() + "&change=3",	
				success : function (data){
					window.location = 'user-page.php?new=password';
				},
				error : function(data){
					console.log(data);
				},
			});
		}

	});

</script>