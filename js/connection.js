function Connect()
{
	if($("#idco").val().length > 0 && $("#passwordco").val().length > 0 )
	{
		$.ajax({
			url:'controller/header.php',
			dataType:'json',
			type:'GET',
			data:"action=login&idco="+$("#idco").val()+"&passwordco="+$("#passwordco").val(),
			success : function(data){
				$('#form-container').css("display","none");
				$('#connection-loading').css("display","inline");
				window.setTimeout(function(){
					location.reload();
				}, 5000);
			},
			error: function(data){
				console.log(data);
				if(!$("#error-response").hasClass('alert-box alert'))
				{
					$("#error-response").addClass('alert-box alert')
					$("#error-response").append('Email or password invalid.');	
				}
			},
		});
	}
	else
	{
		if(!$("#error-response").hasClass('alert-box alert'))
		{
			$("#error-response").addClass('alert-box alert')
			$("#error-response").append('Email or password invalid.');	
		}	
	}	
}

$('#connection-form input').keypress(function(e){
	if(e.which == 13)
	{
		Connect();
	}
})

$('.cancel-button').click(function(){
	$('#connectionModal').foundation('reveal', 'close');
});


$('#connect-button').mouseup(function(){
	Connect();
});