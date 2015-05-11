$('.content-title').hover(function(){
	$('#'+$(this).attr('id')).css("text-decoration","underline");
}, function(){
	$('#'+$(this).attr('id')).css("text-decoration","none");
});


$('.content-image').hover(function(){
	$('#'+$(this).attr('id')).css({
									'-webkit-box-shadow' : '0px 2px 8px 3px rgba(72,108,163,1)',
									'-moz-box-shadow' : '0px 2px 8px 3px rgba(72,108,163,1)',
									'box-shadow' : '0px 2px 8px 3px rgba(72,108,163,1)'});
},function(){
	$('#'+$(this).attr('id')).css({
									'-webkit-box-shadow' : 'none',
									'-moz-box-shadow' : 'none',
									'box-shadow' : 'none'});
});



$('.channel-name').click(function(event){
	if(typeof $(this).attr('id') != 'undefined')
	{
		var url = 'channel/user/'+$(this).attr('id').substr(2);
		window.location = url;
	}
});


$('.channel-name').hover(function(){
			$('#'+$(this).attr('id')).addClass('channel-hover');
	}, function(){
			$('#'+$(this).attr('id')).removeClass('channel-hover');
});
