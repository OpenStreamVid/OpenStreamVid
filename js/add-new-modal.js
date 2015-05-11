	
	var file = null;
	var contentfile = null;

	function readURL(input) 
	{
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#thumbnail-preview').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}


	$('#title-input').keyup(function()
	{
		$.ajax({
			url:'controller/content.php',
			type : 'GET',
			dataType: 'text',
			data : $(this).serialize(),	
			success : function (data)
			{
				if(data == $('#title-input').val())
				{	
					$('#title-input').removeClass('invalidInput').addClass('validInput');
				}
				else
				{
					$('#title-input').removeClass('validInput').addClass('invalidInput');	
				}
			},
			error : function(data)
			{
				console.log(data);
			}
		});
	});

	$(document).on('change','#content-thumbnail',function(e)
	{
		if($(this)[0].files[0].size > $('#content-thumbnail').data("max-size"))
		{
			file = 'too big';
		}
		else
		{
   			readURL(this);
		}
	});


	$(document).on('change','#content-upload',function(e)
	{
		if($(this)[0].files[0].size > $('#content-uplad').data("max-size"))
		{
			contentfile = 'too big';
		}
	});



	$("#content-form").submit('click',function(e)
	{

		var isFormValid = true;

		if($("#title-input").css('borderTopColor') != "rgb(0, 120, 160)" || $('#title-input').val().length == 0 || $('#description-input').val().length == 0 || file != null || contentfile != null)
		{
			isFormValid = false;
		}
		if(!isFormValid) 
		{
			if(!$("#message").hasClass('alert-box alert'))
			{
				$("#message").addClass('alert-box alert')
				$("#message").append('Please fill in all the required fields');	
			}
			e.preventDefault();
		}
	});

	$('.cancel-button').click(function(){
		
		$('#add_new').foundation('reveal', 'close');
	})