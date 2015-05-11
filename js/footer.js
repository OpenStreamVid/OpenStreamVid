$('li a .size-40').hover(function(){
	$('#'+$(this).attr('id')).css('color', '#0078a0');
},function(){
	$('#'+$(this).attr('id')).css('color','#333333');
})