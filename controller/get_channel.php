<?php 

define('ROOT',$_SERVER['DOCUMENT_ROOT']."/openstreamvid/");

require (ROOT.'/model/ModelChannel.php');

if(isset($_GET['type']) && isset($_GET['id']))
{
	$model = new Channel();
	$type = $_GET['type'];
	$id = $_GET['id'];

	if($type == 'tag')
	{
		$req = $model->tag_exist($id);
	}
	else if($type == 'user')
	{
		$req = $model->user_exist($id);
	}
	else
	{
		exit;
	}

	if($req == '0')
	{
		exit ;
	}


	$data_json = array('content-display'=>'<div class="channel-diplay">	
			<div class="title-banner">
				<h3 class="banner-name">'.$id.'</h3>
			</div>
			<div id="panel-'.$type.'-'.$id.'" class="panel panel-content">
				<div>
					<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-7 content-display">

					</ul>
				</div>
				<div class="button button-more radius">
					<p>Show more</p>
				</div>
			</div>
		</div>	');

	if($type == 'tag')
	{	

		$content = $model->get_tag_channel($id);

	}
	else if ($type == 'user')
	{

		$content = $model->get_user_channel($id);
	}

	foreach ($content as $i => $value) 
	{
		$data_json[$i]='	
			<li class="media-info">
				<figure class="content-figure" id="'.$id.' - '.$i.'" data-id='.$value['contentid'].'>
					<img class="content-image" src="/openstreamvid/videos/'.$value['usernickname'].'/'.$value['contentid'].'/thumbnail.jpg" id="content-image'.$id.'-'.$i.'"/>
					<figcaption>
						<span id="content-title-'.$i.'" class="content-title">'.substr($value['contenttitle'],0,40).'</span>
						<br>'.$value['contentviews'].' views - By <span class="channel-name" id="'.$i.'-'.$value['usernickname'].'">'.$value['usernickname'].'</span>
					</figcaption>
				</figure>
			</li>';
	}

	echo json_encode($data_json);
}
else{

	exit;
}
?>