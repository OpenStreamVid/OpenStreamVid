<script type="text/javascript">
	$(document).foundation();

	var $max_element = 25;
	var $content = null;	

	function display_content(n,j){
		for (var i = n; i < j; i++) {
			if($content[i] == null)
			{
				$('.button-more').css('display','none');
				break;
			}
			$('.content-display').append($content[i]);
		};
	}

	$(document).ready(function(){
		$.ajax({
			url:'search.php',
			dataType:'JSON',
			type:'POST',
			data:'page=1&search='+<?php echo json_encode($_GET['search']); ?>,
			success:function(data){
				$content = data;

				$('.content-wrap').append($content['content-display']);

				display_content(0,$max_element);

				$('.button-more').on('mouseup',function(){
					var $elem = $(this);
					$elem.html('<p class="fa fa-spinner fa-pulse"></p>');
					$numberof = parseInt($('.channel-name').last().attr('id').split('-')[0]) + 1;
					
					window.setTimeout(function(){			
						$elem.html('<p>Show more</p>');
						display_content($numberof,$numberof+$max_element);
					}, 2000);

				});
				
				$('.content-image').click(function(){
					if(typeof $(this).parent('.content-figure').data('id') != 'undefined')
					{
						var url = 'video.php?content='+$(this).parent('.content-figure').data('id');
						window.location = url;
					}
				});

				$('.content-title').click(function(){
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
			}
		});
	});
</script>