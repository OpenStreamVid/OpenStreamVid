<?php

	session_start();
	session_destroy();
	unset($_SESSION);

?>
<script type="text/javascript">
	window.location = document.referrer;
</script>