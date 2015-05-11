<?php 

include ('include/configDB.php');

if(isset($_GET['type']) && isset($_GET['id']))
{
	if($_GET['type'] == 'tag')
	{
		$query='SELECT count(*) FROM tag WHERE tagname=:id';
	}
	else if($_GET['type'] == 'user')
	{
		$query='SELECT count(*) FROM user WHERE usernickname=:id';
	}
	else
	{
		header('Location: 404.php');
	}


	$req = $co->prepare($query);

	$req->bindValue(':id',$_GET['id'], PDO::PARAM_STR);
	$req->execute();

	$req = $req->fetch();

	if($req[0] == '0')
	{
		exit;
	}

	$data_json = array('content-display'=>'<div class="channel-diplay">	
			<div class="title-banner">
				<h3 class="banner-name">'.$_GET['id'].'</h3>
			</div>
			<div id="panel-'.$_GET['type'].'-'.$_GET['id'].'" class="panel panel-content">
				<div>
					<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-7 content-display">

					</ul>
				</div>
				<div class="button button-more radius">
					<p>Show more</p>
				</div>
			</div>
		</div>	');

	if($_GET['type'] == 'tag')
	{	

		$query = "SELECT c.contentid, c.contenttitle, usernickname, contentviews 
				  FROM tag t, contenttag ct, content c, user 
				  WHERE ct.contentid = c.contentid 
				  AND t.tagid = ct.tagid
				  AND contentuser = userid
				  AND tagname = :id 
				  ORDER BY contentdateupload DESC";

		$req = $co->prepare($query);

		$req->bindValue(':id',$_GET['id'], PDO::PARAM_STR);

		$req->execute();
		$content = $req->fetchAll(PDO::FETCH_ASSOC);


		foreach ($content as $i => $value) {
				$data_json[$i]='	
					<li class="media-info">
						<figure class="content-figure" id="'.$_GET['id'].' - '.$i.'" data-id='.$value['contentid'].'>
							<img class="content-image" src="videos/'.$value['usernickname'].'/'.$value['contentid'].'/thumbnail.jpg" id="content-image'.$_GET['id'].'-'.$i.'"  onmouseover="mouseoverimage(this);" onmouseout="mouseoutimage(this);">
							<figcaption>
								<span id="content-title-'.$i.'" class="content-title" onmouseover="mouseovertitle(this);" onmouseout="mouseouttitle(this);">'.substr($value['contenttitle'],0,40).'</span>
								<br>'.$value['contentviews'].' views - By <span class="channel-name" id="'.$i.'-'.$value['usernickname'].'">'.$value['usernickname'].'</span>
							</figcaption>
						</figure>
					</li>';
		}
	}
	else if ($_GET['type'] == 'user')
	{
		$query = "SELECT c.contentid, c.contenttitle, usernickname, contentviews 
				  FROM content c, user 
				  WHERE contentuser = userid
				  AND usernickname = :id 
				  ORDER BY contentdateupload DESC";

		$req = $co->prepare($query);

		$req->bindValue(':id',$_GET['id'], PDO::PARAM_STR);

		$req->execute();
		$content = $req->fetchAll(PDO::FETCH_ASSOC);

		foreach ($content as $i => $value) {
				$data_json[$i]='	
					<li class="media-info">
						<figure class="content-figure" id="'.$_GET['id'].' - '.$i.'" data-id='.$value['contentid'].'>
							<img class="content-image" src="videos/'.$value['usernickname'].'/'.$value['contentid'].'/thumbnail.jpg" id="content-image'.$_GET['id'].'-'.$i.'"  onmouseover="mouseoverimage(this);" onmouseout="mouseoutimage(this);">
							<figcaption>
								<span id="content-title-'.$i.'" class="content-title" onmouseover="mouseovertitle(this);" onmouseout="mouseouttitle(this);">'.substr($value['contenttitle'],0,40).'</span>
								<br>'.$value['contentviews'].' views - By <span class="channel-name" id="'.$i.'-'.$value['usernickname'].'">'.$value['usernickname'].'</span>
							</figcaption>
						</figure>
					</li>';
		}
	}

	echo json_encode($data_json);
}
else{

	exit;
}
?>