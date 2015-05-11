<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 

	<title><?php echo $value['contenttitle']; ?></title>

	<?php include ROOT.'include/include.css.php'; ?>

	<link href="<?php echo WEBROOT; ?>js/video-js/video-js.css" rel="stylesheet">
</head>
<body>
<?php 
	include ROOT.'include/header.php';
?>

<div id="content">
	<div id="video-content">	
		<video id="<?php echo $param[1] ?>" class="video-js vjs-default-skin vjs-big-play-centered" resolutions controls preload="auto" height="576" width="1024" data-setup='{"example_option":true}'>
			<source src="/openstreamvid/videos/<?php echo $value['usernickname'] ?>/<?php echo $param[1] ?>/<?php echo $value['contenttitle'] ?>.mp4" type='video/mp4' data-res="HD"/>
			<!-- <track kind="captions" src="openstreamvid/videos/sub_en.vtt" srclang="en" label="English"></track> -->
			<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
		</video>
	</div>
</div>

<div id="content-header" class="content-block">
	<h4><?php echo $value['contenttitle'];?></h4>
	<div id="user-content">
	
		<a href="channel/user/<?php echo $value['usernickname']; ?>"><img src="<?php echo WEBROOT; ?>img/user/<?php echo $value['usernickname']; ?>/profile.jpg" height="50" width="50">
		<b><?php echo $value['usernickname']; ?></b></a>
	</div>
<?php if(isset($value['licencename']) && $value['licencename'] != 'Copyright'){ ?>
	<div id="content-button">
		<a href="videos/<?php echo $value['usernickname'] ?>/<?php echo $param[1] ?>/<?php echo $value['contenttitle'] ?>.mp4" download="<?php echo $value['contenttitle'] ?>.mp4" class="button" id="download-btn">Download video</a>
	</div>
<?php } ?>

	<div id="views-likes">
		<b id="views"><?php echo $value['contentviews']; ?> views</b>
		<div class="progress"> 
			<span class="meter"></span> 
		</div>
		<div id="notation" class="row">
			<div class="small-2 large-3 columns">
				<a>
					<span class="fi-dislike size-36" id="dislike-icon" onmouseover="overicon(this);"  onmouseout="outicon(this);"></span>
				</a>
					<span id="dislike-number"class="total-notation"></span>
			</div>
			<div class="small-1 large-3 columns">
				<a>
					<span class="fi-like size-36" id="like-icon" onmouseover="overicon(this);"  onmouseout="outicon(this);"></span>
				</a>
					<span id="like-number"class="total-notation"></span>
			</div>
		</div>
	</div>
</div>

<div id="content-description" class="content-block">
	<h4>Description <i class="fi-clipboard-notes"></i></h4>
	<div class="panel" id="description-panel">
		<p id="description">
			<?php echo $value['contentdescription'] ?>
		</p>
		<hr>
		<table id="content-info">
			<tr>	
				<td><b>Date </b></td>
				<td><?php echo date('d/m/Y', strtotime($value['contentdateupload'])); ?></td>
			</tr>	
			<tr>
				<td><b>Tag </b></td>
				<td><a href="channel.php?type=tag&id=<?php echo $value['tagid'] ?>"><?php echo $value['tagname']; ?></a></td>
			</tr>	
			<tr>
				<td><b>Licence </b></td>
				<?php if( $value['licencename'] != 'Copyright') {?>
				<td><?php echo $value['licenceurl'] ?></td>
				<?php }else{ ?>
				<td><?php echo $value['licencename'] ?> <i class="fa fa-copyright"></i></td>
				<?php } ?>
			</tr>
		</table>
	</div>
</div>

<div id="content-comments" class="content-block">
	<h4>Comments <i class="fi-comments"></i></h4>
	   <div id="disqus_thread"></div>
<script type="text/javascript">
	var disqus_shortname="openstreamvid";(function(){var e=document.createElement("script");e.type="text/javascript";e.async=true;e.src="//"+disqus_shortname+".disqus.com/embed.js";(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(e)})()
</script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    
</div>

<div id="content-recommendation" class="content-block">
	<h4>Recommendation <i class="fi-lightbulb"></i></h4>
	<div id="panel" class="panel panel-content">
		<div id="recommendation-content">
			<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
				
			</ul>
		</div>	
	</div>
</div>

<?php
	include ROOT.'include/footer.php';
?>		
</body>
</html>	

<script src="<?php echo WEBROOT; ?>js/video-js/video.dev.js"></script>
<script>
  videojs.options.flash.swf = "<?php echo WEBROOT; ?>js/video-js/video-js.swf"
</script>
<script src="<?php echo WEBROOT; ?>js/video-js/video-js-resolutions/video-js-resolutions.js"></script>