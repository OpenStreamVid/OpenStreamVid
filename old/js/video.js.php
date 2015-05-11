<script type="text/javascript">
$(document).foundation();

var voted=0;
var contentid = '<?php print $_GET['content']; ?>';

$(document).ready(function(){
	$.ajax({
		url:'video_function.php',
		dataType:'json',
		type:'POST',
		data:$(this).serialize()+"&countdislike=0&countlike=0&contentid="+contentid,
		success : function(data){
			console.log(data);
			if(data[1]['dislikes']==0)
			{
				$('.meter').css('width','100%');
			}
			else if (data[0]['likes']==0)
			{
				$('.meter').css('width','0%');
			}
			else
			{
				var total = data[0]['likes']+data[1]['dislikes'];
				var i = 100 - ((data[1]['dislikes'] / total) * 100);
				$('.meter').css('width',i);
			}

			$('#dislike-number').append(data[1]['dislikes']);
			$('#like-number').append(data[0]['likes']);
		},
		error: function(data){
			console.log(data);
		},
	});
});


$('video').on('play',function(){
	window.setTimeout(function(){
		$.ajax({
			url:'video_function.php',
			dataType:'json',
			type:'POST',
			data:"views=1&contentid="+contentid,
			success:function(data){
				
			},
			error:function(data){
				console.log(data);
			},
		});
	}, 3000);
});

<?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ ?>
$("#dislike-icon").click(function(){
	if(voted==0){
		$.ajax({
			url:'video_function.php',
			dataType:'json',
			type:'POST',
			data:$(this).serialize()+"&dislike=1&contentid="+contentid,
			success : function(data){

				// console.log(data);
				$('#dislike_number').text(data[0]['dislikes']);
				$('#dislike_number').css('color','rgb(0,120,160)');
				$("#dislike-icon").css('color','rgb(0,120,160)');
				voted = 1;		
			},
			error: function(data){
				console.log('error' + data);
			},
		});
	}
});

$("#like-icon").click(function(){

	if(voted==0){
		$.ajax({
			url:'video_function.php',
			dataType:'json',
			type:'POST',
			data:$(this).serialize()+"&like=1&contentid="+contentid,
			success : function(data){
				console.log(data);
				$('#like_number').text(data[0]['likes']);
				$('#like_number').css('color','rgb(0,120,160)');
				$("#like-icon").css('color','rgb(0,120,160)');
				voted = 1;
			},
			error: function(data){
				console.log('error' + data);
			},
		});
	}

});
<?php } 
	?>
</script>