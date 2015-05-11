<script type="text/javascript">

var voted=0;
var contentid = '<?php echo $param[1]; ?>';

$(document).ready(function(){
	$.ajax({
		url:'/openstreamvid/controller/video.php',
		dataType:'json',
		type:'GET',
		data:"action=social&contentid="+contentid,
		success : function(data){
			console.log(data);
			if(data['dislikes']==0)
			{
				$('.meter').css('width','100%');
			}
			else if (data['likes']==0)
			{
				$('.meter').css('width','0%');
			}
			else
			{
				var total = data['likes']+data['dislikes'];
				var i = 100 - ((data['dislikes'] / total) * 100);
				$('.meter').css('width',i);
			}

			$('#dislike-number').append(data['dislikes']);
			$('#like-number').append(data['likes']);
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
			type:'GET',
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
			type:'GET',
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
			type:'GET',
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
<?php 
} 
?>


function overicon(e){
	document.getElementById(e.id).style.color = "#0078a0";
}

function outicon(e){
	document.getElementById(e.id).style.color = "#333333";
}
</script>