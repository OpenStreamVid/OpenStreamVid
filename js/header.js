var $curr_elem = null;
var $curr_search = null


$('#search-button').click(function(){
	if($('#search').val().length > 0){
		$.ajax({
			url:'/openstreamvid/controller/header.php',
			dataType:'text',
			type:'GET',
			data:'action=load&search='+$('#search').val(),
			success:function(data){
				if(data != 'no content' && data.length > 0){
					window.location = '/openstreamvid/video/'+data;	
				}
				else
				{
					window.location = '/openstreamvid/result/'+$('#search').val();
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
			url:'/openstreamvid/controller/header.php',
			dataType:'text',
			type:'GET',
			data:'action=load&search='+$('#search').val(),
			success:function(data){
				if(data != 'no content' && data.length > 0){
					window.location = '/openstreamivd/video/'+data;	
				}
				else
				{
					window.location = '/openstreamvid/result/'+$('#search').val();
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
			url:'/openstreamvid/controller/header.php',
			dataType:'text',
			type:'GET',
			data:$(this).serialize() + '&action=search',
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
					window.location="/openstreamvid/video/" + $(this).attr('id');
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
		url:'/openstreamvid/controller/header.php',
		type:'GET',
		data:'action=logout',
		success:function(data)
		{
			location.reload();
		},
		error:function(data){
			console.log('error :' + data);
		},
	});
});