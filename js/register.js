
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

	
function passwordLengthValidation(e)
{
	if(e.value.length > 7)
	{
		$('#password-input').removeClass('invalidInput').addClass('validInput');
	}
	else
	{
		$('#password-input').removeClass('validInput').addClass('invalidInput');
	}
	if($("#password-confirmation-input").val().length > 0)
	{
		if(e.value == $("#password-confirmation-input").val())
		{
			$('#password-confirmation-input').removeClass('invalidInput').addClass('validInput');
		}
		else
		{
			$('#password-confirmation-input').removeClass('validInput').addClass('invalidInput');	
		}
	}
}

function passwordConfirmed(e)
{
	if(e.value == $("#password-input").val() && e.value.length > 0)
	{
		$('#password-confirmation-input').removeClass('invalidInput').addClass('validInput');
	}
	else if(e.value != $("#password-input").val())
	{
		$('#password-confirmation-input').removeClass('validInput').addClass('invalidInput');
	}
}


function emailValidation(e){

	var reg = /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/igm;

	if(reg.test(e.value))
	{
		$('#email-input').removeClass('invalidInput').addClass('validInput');
	}
	else if(!reg.test(e.value))
	{
		$('#email-input').removeClass('validInput').addClass('invalidInput');	
	}

	if($("#email-confirmation-input").val().length > 0)
	{
		if(e.value == $("#email-confirmation-input").val())
		{
			$('#email-input').removeClass('invalidInput').addClass('validInput');
		}
		else if($("#email-confirmation-input").css("borderColor") == 'rgb(255,0,0)')
		{
			$('#email-input').removeClass('validInput').addClass('invalidInput');
		}
	}
}

function emailConfirmed(e)
{
	var reg = /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/igm;

	if(reg.test(e.value) && e.value == $("#email-input").val())
	{
		$('#email-confirmation-input').removeClass('invalidInput').addClass('validInput');
	}
	else if(!reg.test(e.value))
	{
		$('#email-confirmation-input').removeClass('validInput').addClass('invalidInput');		
	}
}