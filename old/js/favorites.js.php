<script type="text/javascript">
	$(document).foundation();

$('.delete-favorites span').on('mouseover',function(){
	$(this).css('color','#007095');
});

$('.delete-favorites span').on('mouseout',function(){
	$(this).css('color','#333333');
});


//delete favorite
$('.delete-favorites .fi-x').click(function(){
	var $row_content = $(this).parents('tr');
	$.ajax({
		url:'video_function.php',
		type:'POST',
		data:'erase_like=1&contentid='+$row_content.attr('id'),
		success:function(data){
			$row_content.remove();
		},
		error:function(){

		}

	});
});

$('tr').hover(function(){
	if($(this).parents('#favorites-table').length > 0){
		$(this).addClass('hover');	
	}
},function(){
	$(this).removeClass('hover');	
});

</script>