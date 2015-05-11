<?php

	require_once 'include/config.php';


	if(isset($_POST['result']) && $_POST['result'] == '1' && isset($_POST['search']))
	{
		// Build Query
		$query = 'SELECT contentID, contentTitle 
			  FROM content
			  WHERE lower(contentTitle) LIKE :search
			  LIMIT 5';
		$req= $co->prepare($query);

		$req->bindValue(':search',     "%".strtolower($_POST['search'])."%", PDO::PARAM_STR);

		// Do Search
		$req->execute();

		$result=null;

		if($req->rowcount() > 0)
		{
			$req=$req->fetchAll();

			foreach ($req as $key => $value) {
				$result.='<div id="'.$value['contentID'].'" class="element-result">
							<a><b>'.$value['contentTitle'].'</b></a>
					</div>';
			}
			
		}
		else
		{
			$result ='<b>No Results Found</b>';		
		}


		print_r($result);

	}
	else if (isset($_POST['load']) && $_POST['load']== '1' && isset($_POST['search']))
	{
		$query = 'SELECT contentID 
			  	  FROM content
			      WHERE lower(contentTitle) = :search';
		$req= $co->prepare($query);

		$req->bindValue(':search',   strtolower($_POST['search']), PDO::PARAM_STR);

		// Do Search
		$req->execute();

		$req=$req->fetchAll();

		if(!empty($req)){
			print_r($req[0]['contentID']);
		}
		else{
			echo 'no content';
		}
	}
	else if (isset($_POST['page']) && $_POST['page'] == 1 && isset($_POST['search']))
	{
		$data_json = array('content-display'=>'<div class="channel-diplay">	
			<div class="title-banner">
				<h3 class="banner-name">Result</h3>
			</div>
			<div id="panel-result" class="panel panel-content">
				<div>
					<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-7 content-display">

					</ul>
				</div>
				<div class="button button-more radius">
					<p>Show more</p>
				</div>
			</div>
		</div>	');

		$query = "SELECT contentid, contenttitle, usernickname, contentviews 
		  FROM content, user 
		  WHERE contentuser = userid
		  AND lower(contentTitle) LIKE :id 
		  ORDER BY contentdateupload DESC";

		$req = $co->prepare($query);

		$req->bindValue(':id',"%".strtolower($_POST['search'])."%", PDO::PARAM_STR);

		$req->execute();
		$content = $req->fetchAll(PDO::FETCH_ASSOC);

		foreach ($content as $i => $value) {
			$data_json[$i]='	
				<li class="media-info">
					<figure class="content-figure" id="result - '.$i.'" data-id='.$value['contentid'].'>
						<img class="content-image" src="videos/'.$value['usernickname'].'/'.$value['contentid'].'/thumbnail.jpg" id="content-image-result-'.$i.'"  onmouseover="mouseoverimage(this);" onmouseout="mouseoutimage(this);">
						<figcaption>
							<span id="content-title-'.$i.'" class="content-title" onmouseover="mouseovertitle(this);" onmouseout="mouseouttitle(this);">'.substr($value['contenttitle'],0,40).'</span>
							<br>'.$value['contentviews'].' views - By <span class="channel-name" id="'.$i.'-'.$value['usernickname'].'">'.$value['usernickname'].'</span>
						</figcaption>
					</figure>
				</li>';
		}

		echo json_encode($data_json);

	}

?>