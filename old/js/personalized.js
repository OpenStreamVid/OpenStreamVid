/**************************
*			Header
***************************/
var $curr_elem = null;
var $curr_search = null


$('#search-button').click(function(){
	
	if($('#search').val().length > 0){
		$.ajax({
			url:'search.php',
			dataType:'text',
			type:'POST',
			data:'load=1&'+$(this).serialize(),
			success:function(data){
				if(data != 'no content' && data.length > 0){
					window.location = 'video.php?content='+data;	
				}
				else
				{
					window.location = 'result.php?search='+$('#search').val();
				}
			},
			error:function(data){
				console.log(data);
			}
		});		
	}
});

$('#search').keyup(function(event){

	if(event.keyCode  == 38 && $('div.element-result').length > 0) // press up
	{
		if($curr_elem != null && $curr_elem.prev().length == 1)
		{		
			$curr_elem.css('background-color','rgba(255, 255, 255, 0.6)');
			$curr_elem = $curr_elem.prev();
			$curr_elem.css('background-color','#cacaca');

			$(this).val($curr_elem.find('b').html());
		}
		else if($curr_elem != null)
		{
			$curr_elem.css('background-color','rgba(255, 255, 255, 0.6)');
			$curr_elem = null;
			$(this).val($curr_search);
		}
	}
	else if(event.keyCode  == 40 && $('div.element-result').length > 0) // press down
	{
		if ($curr_elem == null)
		{
			$curr_elem = $('div.element-result').first();
		}
		else if($curr_elem.next().length == 1)
		{
			$curr_elem.css('background-color','rgba(255, 255, 255, 0.6)');
			$curr_elem = $curr_elem.next();
		}

		$(this).val($curr_elem.find('b').html());
		$curr_elem.css('background-color','#cacaca');
	}
	else if(event.keyCode  == 13 && $(this).val().length > 0) // press enter
	{
		$.ajax({
			url:'search.php',
			dataType:'text',
			type:'POST',
			data:'load=1&'+$(this).serialize(),
			success:function(data){
				if(data != 'no content' && data.length > 0){
					window.location = 'video.php?content='+data;	
				}
				else
				{
					window.location = 'result.php?search='+$('#search').val();
				}
			},
			error:function(data){
				console.log(data);
			}
		});
	}

	else if($(this).val().length > 0){

		$curr_search = $(this).val();

		$.ajax({
			url:'search.php',
			dataType:'text',
			type:'POST',
			data:$(this).serialize() + '&result=1',
			success:function(data){
				// console.log(data);
				$curr_elem = null;

				$('#results-text').css('display','block');
	
				$('#result-search').empty();
				$('#result-search').append(data);


				/* Add mouse event */
				$('div.element-result').triggerHandler( "focus" );
				$('div.element-result').hover(function(){
					$curr_elem = $(this);
					$curr_elem.css('background-color','#cacaca');
				}, function(){
					$curr_elem.css('background-color','rgba(255, 255, 255, 0.6)');
				});

				$('div.element-result').on('mouseup',function(){
					window.location="video.php?content=" + $(this).attr('id');
				});

			},
			error:function(data){
				console.log(data);
			},

		});		
	}
	else
	{
		$('#result-search').empty();
	}

});



$(document).click(function(event){
	$('#results-text').css('display','none');
});

$("#search").click(function(event){
	event.stopPropagation();
});

$('#results-text').click(function(event){
	event.stopPropagation();
});



$('#logout').click(function(){
	$.ajax({
		url:'logout.php',
		dataType:'json',
		type:'POST',
		data:$(this).serialize()+'&post='+ document.location.pathname.split("/").pop(),
		success:function(data)
		{
			console.log('success :' + data);
			location.reload();
		},
		error:function(data){
			console.log('error :' + data);
		},
	});
});

// CONNECTION - MODAL


$('.cancel-button').click(function(){
	$('#connectionModal').foundation('reveal', 'close');
});


$('#connect-button').mouseup(function(){
	if($("#idco").val().length > 0 && $("#passwordco").val().length > 0 )
	{
		$.ajax({
			url:'user.php',
			dataType:'json',
			type:'POST',
			data:$("#form-container").serialize()+"&idco="+$("#idco").val()+"&passwordco="+$("#passwordco").val(),
			success : function(data){
				$('#form-container').css("display","none");
				$('#connection-loading').css("display","inline");
				window.setTimeout(function(){
					$('#connection-loading').css("display","none");
					$('#connected').css("display","inline");
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
});

/**************************
*			Global
***************************/
function mouseovertitle(e){

	var  element = e.id;
	$("#"+element).css("text-decoration","underline");
}

function mouseouttitle(e){

	var  element = e.id;
	$("#"+element).css("text-decoration","none");
}


function mouseoverimage(e){	
	var  element = e.id;
	$("#"+element).css({
						'-webkit-box-shadow' : '0px 2px 8px 3px rgba(72,108,163,1)',
						'-moz-box-shadow' : '0px 2px 8px 3px rgba(72,108,163,1)',
						'box-shadow' : '0px 2px 8px 3px rgba(72,108,163,1)'});
}

function mouseoutimage(e){

	var  element = e.id;
	$("#"+element).css({
						'-webkit-box-shadow' : 'none',
						'-moz-box-shadow' : 'none',
						'box-shadow' : 'none'});
}


/*************************
*		Footer
**************************/

function overfootericon(e)
{
	var elements = e.children;
	elements.namedItem(e.id+"-icon").style.color = '#0078a0';
}

function outfootericon(e)
{
	var elements = e.children;
	elements.namedItem(e.id+"-icon").style.color = '#333333';
}

/*************************
*	Registration form
**************************/


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

/*************************
* 		Video
*************************/

function overicon(e){
	document.getElementById(e.id).style.color = "#0078a0";
}

function outicon(e){
	document.getElementById(e.id).style.color = "#333333";
}