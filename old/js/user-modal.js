$(document).ready(function(){
	if($("#picture.change").css("display") == 'block')
	{
		$("#change-button").replaceWith('<input type="submit" id="change-submit" class="button radius" value="Change"/>')
	}
})


$('#changing-nickname-input').keyup(function(){
	$.ajax({
		url:'user.php',
		type : 'GET',
		dataType: 'json',
		data : $(this).serialize(),	
		success : function (data){
			if(data < 1){	
				$('#changing-nickname-input').removeClass('invalidInput').addClass('validInput');
			}
			else{
				$('#changing-nickname-input').removeClass('validInput').addClass('invalidInput');	
			}
		},
		error : function(data){
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


$('#change-button').mouseup(function(){

	if($("#nickname.change").css('display')=='block' && $("#changing-nickname-input").hasClass("validInput") && $('#changing-nickname-input').val().length != 0)
	{
		$.ajax({
			url:'user.php',
			dataType:'json',
			type:'POST',
			data:"nickname="+$("#changing-nickname-input").val()+"&change=1",
			success : function(data){
				$('#change-form-container').css("display","none");
				$('#change-loading').css("display","inline");
				window.setTimeout(function(){
					$('#change-loading').css("display","none");
					$('#changed').css("display","inline");
				}, 5000);
			},
			error: function(data){
				console.log(data);
				if(!$("#error-response").hasClass('alert-box alert'))
				{
					$("#error-response").addClass('alert-box alert')
					$("#error-response").append('Nickname invalid.');	
				}
			},
		});
	}

	else if($("#email.change").css('display')=='block' && $("#changing-nickname-input").hasClass("validInput") && $('#changing-email-input').val().length != 0)
	{
		$.ajax({
			url:'user.php',
			dataType:'json',
			type:'POST',
			data:"email="+$("#changing-email-input").val()+"&change=2",
			success : function(data){
				$('#change-form-container').css("display","none");
				$('#change-loading').css("display","inline");
				window.setTimeout(function(){
					$('#change-loading').css("display","none");
					$('#changed').css("display","inline");
				}, 5000);
			},
			error: function(data){
				console.log(data);
				if(!$("#error-response").hasClass('alert-box alert'))
				{
					$("#error-response").addClass('alert-box alert')
					$("#error-response").append('Email invalid.');	
				}
			},
		});
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