<html>
<head>
	<title>Upload File</title>

<?php
	require_once 'include/include.css.php';
?>
</head>
<body>
    <div id="upload-wrap">
        <i class="fa fa-spinner fa-pulse" id="pulse"></i>
        <div class="progress radius round" id="progress-bar"> 
            <span class="meter animate" style="width:0%"></span> 
        </div>
        <p id="progress-message"></p>
    </div>
    <?php var_dump($_POST); ?>
    <?php var_dump($_FILES); ?>
</body>
</html>