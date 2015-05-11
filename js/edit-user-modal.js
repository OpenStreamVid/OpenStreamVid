$(document).ready(function()
{
	if($("#picture.change").css("display") == 'block')
	{
		$("#change-button").replaceWith('<input type="submit" id="change-submit" class="button radius" value="Change"/>')
	}
})

function change(data)
{
	$.ajax({
		url:'controller/user.php',
		dataType:'text',
		type:'GET',
		data:"data="+data[0]+"&action=change&function="+data[1],
		success : function(success)
		{
			$('#change-form-container').css("display","none");
			$('#change-loading').css("display","inline");
			window.setTimeout(function(){
				window.location = window.location.pathname +'?done='+data[1];
			}, 2000);
		},
		error: function(error)
		{
			if(!$("#error-response").hasClass('alert-box alert'))
			{
				$("#error-response").addClass('alert-box alert')
				$("#error-response").append(data[1]+' invalid');	
			}
		},
	});
}

$('#changing-nickname-input').keyup(function()
{
	$.ajax({
		url:'controller/user.php',
		type : 'GET',
		dataType: 'text',
		data : 'action=exist&data='+$(this).val(),	
		success : function (data)
		{
			if(data < '1')
			{	
				$('#changing-nickname-input').removeClass('invalidInput').addClass('validInput');
			}
			else
			{
				$('#changing-nickname-input').removeClass('validInput').addClass('invalidInput');	
			}
		},
		error : function(data)
		{
			console.log(data);
		}
	});
});

$("#changing-email-input").keyup(function(){
	var reg = /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/igm;

	if(reg.test($(this).val()))
	{
		$(this).removeClass('invalidInput').addClass('validInput');
	}
	else if(!reg.test($(this).val()))
	{
		$(this).removeClass('validInput').addClass('invalidInput');	
	}
});


$('#changing-password-input').keyup(function()
{
	if($(this).val().length > 7)
	{
		$(this).removeClass('invalidInput').addClass('validInput');
	}
	else
	{
		$(this).removeClass('validInput').addClass('invalidInput');
	}
	if($("#changing-password-confirmation-input").val().length > 0)
	{
		if($(this).val() == $("#changing-password-confirmation-input").val())
		{
			$('#changing-password-confirmation-input').removeClass('invalidInput').addClass('validInput');
		}
		else
		{
			$('#changing-password-confirmation-input').removeClass('validInput').addClass('invalidInput');	
		}
	}
});


$('#changing-password-confirmation-input').keyup(function()
{
	if($(this).value == $("#changing-password-input").val() && $(this).value.length > 0)
	{
		$('#changing-password-confirmation-input').removeClass('invalidInput').addClass('validInput');
	}
	else if($(this).value != $("#changing-password-input").val())
	{
		$('#changing-password-confirmation-input').removeClass('validInput').addClass('invalidInput');
	}
});


$('#change-button').mouseup(function()
{
	if($("#nickname.change").css('display')=='block' && $("#changing-nickname-input").hasClass("validInput") && $('#changing-nickname-input').val().length != 0)
	{
		var data = new Array($("#changing-nickname-input").val(),"nickname");
		change(data);
	}

	else if($("#email.change").css('display')=='block' && $("#changing-email-input").hasClass("validInput") && $('#changing-email-input').val().length != 0)
	{
		var data = new Array($("#changing-email-input").val(),"email");
		change(data);
	}
	else if($("#password.change").css('display')=='block' && $('#changing-password-input').hasClass("validInput") && $('#changing-password-confirmation-input').hasClass("validInput"))
	{
		var data = new Array($("#changing-password-input").val(),"password");
		change(data);
	}
	else
	{
		if(!$("#error-response").hasClass('alert-box alert'))
		{
			$("#error-response").addClass('alert-box alert')
			$("#error-response").append('Input invalid.');	
		}	
	}

});