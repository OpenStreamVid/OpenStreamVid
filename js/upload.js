$intval = null;

    function startMonitor() 
    {
        $.getJSON('view/upload/upload-test.php',
        function (percentage) 
        {
            if (percentage) 
            {
                console.log(percentage);
                $(".meter").animate({width: percentage+"%"});

            }
            if(percentage == 100){
                $('#progress-message').html('<strong>Complete</strong>');
                stopInterval();

                window.setTimeout(function(){
                    window.location.replace('user/done/added');
                }, 2000);
            }
        });
    }

	function startInterval() 
	{
        if ($intval == null) 
        {
            $intval = window.setInterval(function () {startMonitor()}, 200);
        } 
        else 
        {
            stopInterval();
        }
    }

    function stopInterval() 
    {
        if ($intval != null) 
        {
            window.clearInterval($intval);
            $intval = null;
            $("#progressbar").hide();
            $('#progress-txt').html('Complete');
        }
    }

    $(document).ready(function(){
    	  startInterval();
    })