<?php 

echo'<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-7 content-display">';

$max_new_content = 6;

$query = "SELECT c.contentid, c.contenttitle, usernickname, contentviews 
		  FROM contenttag, content c, user 
		  WHERE contenttag.contentid = c.contentid 
		  AND contentuser = userid
		  AND tagid = :id 
		  ORDER BY contentdateupload DESC
		  LIMIT :max";
$req = $co->prepare($query);

$req->bindValue(':id',$tagid, PDO::PARAM_STR);
$req->bindValue(':max',$max_new_content, PDO::PARAM_INT);

$req->execute();
$content = $req->fetchAll(PDO::FETCH_ASSOC);


for ($i=0; $i < $max_new_content; $i++) { 
	if(!isset($content[$i])){
		echo'
			<li class="media-info">
				<figure class="content-figure" id="'.$tagid.' - '.$i.'">
					<img class="content-image" src="Videos/no_content.jpg" id="content-image'.$tagid.'-'.$i.'"  onmouseover="mouseoverimage(this);" onmouseout="mouseoutimage(this);">
					<figcaption>
						<span id="content-title'.$tagid.'-'.$i.'" class="content-title" onmouseover="mouseovertitle(this);" onmouseout="mouseouttitle(this);">No Content</span>
					</figcaption>
				</figure>
			</li>';
	}
	else{
		echo'	
			<li class="media-info">
				<figure class="content-figure" id="'.$tagid.' - '.$i.'" data-id='.$content[$i]['contentid'].'>
					<img class="content-image" src="videos/movieun-free/'.$content[$i]['contentid'].'/thumbnail.jpg" id="content-image'.$tagid.'-'.$i.'"  onmouseover="mouseoverimage(this);" onmouseout="mouseoutimage(this);">
					<figcaption>
						<span id="content-title'.$tagid.'-'.$i.'" class="content-title" onmouseover="mouseovertitle(this);" onmouseout="mouseouttitle(this);">'.substr($content[$i]['contenttitle'],0,40).'</span>
						<br>'.$content[$i]['contentviews'].' views - By <span class="channel-name" id="'.$i.'-'.$content[$i]['usernickname'].'">'.$content[$i]['usernickname'].'</span>
					</figcaption>	
				</figure>
			</li>';
	}

}

echo '	</ul>';


?>