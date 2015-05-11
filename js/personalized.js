


$('#logout').click(function(){
	$.ajax({
		url:'controller/header.php',
		dataType:'json',
		type:'POST',
		data:'action=logout',
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
