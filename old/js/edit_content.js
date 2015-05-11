	$(document).foundation();

	var file = null;

	$('.cancel-button').click(function(){
		$('#edit_content').foundation('reveal', 'close');
	});


	function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#thumbnail-preview').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}



	$("#submit-edit-content").on('click',function(e){

		var isFormValid = true;
		if($("#title-edit-input").css('borderTopColor') != "rgb(0, 120, 160)" || $('#title-edit-input').val().length == 0 || $('#description-edit-input').val().length == 0 || file != null)
		{
			isFormValid = false;
		}
		if(!isFormValid) 
		{
			if(!$("#message-edit").hasClass('alert-box alert'))
			{
				$("#message-edit").addClass('alert-box alert')
				$("#message-edit").append('Please fill in all the required fields');	
			}
		}
		else{
			$("#content-edit-form").submit();	
		}

	});




	$('#title-edit-input').keyup(function(){
		$.ajax({
			url:'content.php',
			type : 'GET',
			dataType: 'json',
			data : $(this).serialize(),	
			success : function (data){
				if(data < 1){	
					$('#title-edit-input').removeClass('invalidInput').addClass('validInput');
				}
				else{
					$('#title-edit-input').removeClass('validInput').addClass('invalidInput');	
				}
			},
			error : function(data){
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