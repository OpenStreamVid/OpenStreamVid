<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 

	<title> Welcome </title>

	<?php
		require_once ROOT.'/include/include.css.php';
	?>
</head>
<body>

<?php
	include ROOT.'/include/header.php';

	if(isset($param[1]) && $param[1] == 'registered')
	{
	?>	<div id="registeredModal" class="reveal-modal welcome-modal" data-reveal-ajax>
				<fieldset>
					<legend>Registered</legend>
					<div>
						<h2>Welcome on <img src="img/site/logo2.png"/> </h2>
						<h3>You are now a registered user</h3>	
					</div>
					<div class="modal-buttons">
						<a href="index" class="button radius close">Close</a>
					</div>
				</fieldset>
			</div>
		<script type="text/javascript"> $("#registeredModal").foundation("reveal", "open"); </script>
	<?php
}
?>		
<!-- 
		BODY 
				-->

	<div class="main">
		<div class="media-content">
			<!-- Accordion per Tag Names -->
			
<?php 

foreach ($tag as $key => $value) 
{
	$tagid=$value['tagid'];
?>

	 		<div class="tag">
				<div class="title-banner">
					<h3 class="banner-name"><a class="banner-name" href="channel/tag/<?php echo $value['tagname']; ?>"><?php echo $value['tagname'];?></a></h3>
				</div>
				<div id="panel<?php echo $key;?>'" class="panel panel-content">
					<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-7 content-display">
<?php 
	for ($i=0; $i < $max_new_content; $i++) 
	{ 
		if(!isset($tag_content[$key][$i]))
		{

?>
						<li class="media-info">
							<figure class="content-figure" id="<?php echo $tagid; ?>-<?php echo $i; ?>">
								<img class="content-image" src="<?php echo WEBROOT .'videos/no_content.jpg'; ?>" id="content-image<?php echo $tagid; ?>-<?php echo $i; ?>">
								<figcaption>
									<span id="content-title<?php echo $tagid; ?>-<?php echo $i; ?>" class="content-title">No Content</span>
								</figcaption>
							</figure>
						</li>
<?php 
		}
		else
		{
?>
						<li class="media-info">
							<figure class="content-figure" id="<?php echo $tagid; ?>-<?php echo $i; ?>" data-id="<?php echo $tag_content[$key][$i]['contentid']; ?>" >
								<a href="<?php echo 'video/'.$tag_content[$key][$i]['contentid']; ?>"><img class="content-image" src="<?php echo WEBROOT .'videos/movieun-free/'. $tag_content[$key][$i]['contentid'] .'/thumbnail.jpg';?>" id="content-image<?php echo $tagid; ?>-<?php echo $i; ?>"/></a>
								<figcaption>
									<a href="<?php echo 'video/'.$tag_content[$key][$i]['contentid']; ?>"><span id="content-title<?php echo $tagid; ?>-<?php echo $i; ?>" class="content-title"><?php echo substr($tag_content[$key][$i]['contenttitle'],0,40); ?></span></a>
									<br><?php echo $tag_content[$key][$i]['contentviews']; ?> views - By <span class="channel-name" id="<?php echo $i; ?>-<?php echo $tag_content[$key][$i]['usernickname'];?>"><?php echo $tag_content[$key][$i]['usernickname']; ?></span>
								</figcaption>	
							</figure>
						</li>
	
<?php 
		}
	}
?>
					</ul>
				</div>
			</div>
<?php 
}
?>			
		</div>
	</div>	

<?php
	include ROOT.'/include/footer.php';
?>	
</body>
</html>