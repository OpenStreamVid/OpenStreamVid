<script type="text/javascript"> 
	$(document).foundation();

	$('.content-image').click(function(event){
		if(typeof $(this).parent('.content-figure').data('id') != 'undefined')
		{
			var url = 'video.php?content='+$(this).parent('.content-figure').data('id');
			window.location = url;
		}
	});

	$('.content-title').click(function(event){
		if(typeof $(this).parent('.content-figure').data('id') != 'undefined')
		{
			var url = 'video.php?content='+$(this).parent('.content-figure').data('id');
			window.location = url;
		}
	});

	
	$('.channel-name').click(function(event){
		if(typeof $(this).attr('id') != 'undefined')
		{
			var url = 'channel.php?type=user&id='+$(this).attr('id').substr(2);
			window.location = url;
		}
	});


	$('.channel-name').hover(function(){
				$('#'+$(this).attr('id')).addClass('channel-hover');
		}, function(){
				$('#'+$(this).attr('id')).removeClass('channel-hover');
	});


</script>