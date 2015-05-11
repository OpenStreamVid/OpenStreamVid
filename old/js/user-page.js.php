<script type="text/javascript">
	$(document).foundation();


	$(document).ready(function(){
		$.ajax({
			url:'user.php',
			dataType:'json',
			type:'POST',
			data:$(this).serialize()+'&get_info_of='+<?php print $_SESSION['id'] ?>,
			success:function(data)
			{
				$('#change-email').append('<b>'+ data[0]['email'] +'</b> <small>modify</small>');
				// console.log('success :' + data);
			},
			error:function(data){
				console.log('error :' + data);
			},
			});
	});

/**
	JQuery modification of accordion
**/
	$(".accordion dd").on("click", "a:eq(0)", function (event)
	{
		var dd_parent = $(this).parent();

		if(dd_parent.hasClass('active'))
		{
			$(".accordion dd div.content:visible").slideToggle("slow");
		}
		else
		{
			$(".accordion dd div.content:visible").slideToggle("slow");
			$(this).parent().find(".content").slideToggle("slow");
		}
	});

	$('.accordion dd').on("mouseover", function(event){
		$('#'+this.id+'-name').css("color","#0078a0");
	});

	$('.accordion dd').on("mouseout", function(event){
		$('#'+this.id+'-name').css("color","white");
	});


	/**
		Modal trigger edit
	**/	

	$('.edit-modal-trigger').click(function(){
		$('#edit_content').foundation('reveal', 'open');
		var $father = $(this).closest("tr");// Finds the closest row <tr>

		//fill the modal's form
 		var $res = $father.children('td').eq(1).children().text().split(': \n',1);
        $('#title-edit-input').val($res);  
        $('#title-edit-input').addClass('validInput');

        $('#description-edit-input').val($father.find('.description-complete').html());

        $('select option:contains("'+$father.children('td').eq(3).children().html()+'")').attr("selected",true);

        $('#thumbnail-preview-edit').attr('src',$father.children('td').children().attr('src'));

        $('input:radio[name=licence-edit]').filter('[value='+$father.find('.licence-id').html()+']').prop('checked', true);

        $('#id-edit').val($father.attr('id'));
	});


	/**
		Delete content
	**/
	$('.delete-content-button').click(function(){
		$.ajax({
			url:'content.php',
			dataType:'json',
			type:'GET',
			data:'delete=0&contentid='+$(this).closest("tr").attr('id'),
			success:function(data){
				console.log(data);
			},
			error:function(data){
				console.log('error : '+ data);
			}
		});
	});


	/**
		Edit account
	**/

	$("#account-picture").click(function(e){
		if($(' #nickname.change').css('display')=='block')
		{
			$(' #nickname.change').css('display','none');	
		}
		if($(' #email.change').css('display')=='block')
		{
			$(' #email.change').css('display','none');
		}
		$(' #picture.change').css('display','block');
	});

	$("#change-nickname").click(function(e){
		if($(' #email.change').css('display')=='block')
		{
			$(' #email.change').css('display','none');	
		}
		if($(' #picture.change').css('display')=='block')
		{
			$(' #picture.change').css('display','none');
		}
		$(' #nickname.change').css('display','block');
	});

	$("#change-email").click(function(e){
		if($(' #nickname.change').css('display')=='block')
		{
			$(' #nickname.change').css('display','none');	
		}
		if($(' #picture.change').css('display')=='block')
		{
			$(' #picture.change').css('display','none');
		}
		$('#email.change ').css('display','block');
	});

	$('tr').hover(function(){
			if($(this).parents('#user-content-table').length > 0){
			$(this).addClass('hover');	}
		},function(){
			$(this).removeClass('hover');	
	});
</script>	