<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/core/model.php');

class Social extends Model
{
	public function get_like($id)
	{
		$query ='	SELECT count(likeid) as likes
					FROM likes
					WHERE contentlikeid = :contentid';
		$req = $this->co->prepare($query);

		$req->bindValue(':contentid',$id, PDO::PARAM_STR);
		$req->execute();							

		return $req->fetchAll()[0]['likes'];
	}


	public function get_dislike($id)
	{
		$query = '	SELECT count(dislikeid) as dislikes
					FROM dislikes
					WHERE contentdislikeid = :contentid';
		$req = $this->co->prepare($query);

		$req->bindValue(':contentid',$id, PDO::PARAM_STR);
		$req->execute();

		return $req->fetchAll()[0]['dislikes'];
	}

	public function get_content_liked($id)
	{
		$sql = 'SELECT contentid, contenttitle, usernickname, contentviews, datelike 
				FROM likes, content, user
				WHERE contentlikeid = contentid
				AND contentuser = userid
				AND userlikeid = :id';

		$req = $this->co->prepare($sql);

		$req->bindValue(':id',$id, PDO::PARAM_STR);
		$req->execute();							

		return $req->fetchAll();
	}
}

?>