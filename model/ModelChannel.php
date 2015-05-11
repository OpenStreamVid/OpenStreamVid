<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/core/model.php');

class Channel extends Model
{
	public function user_exist($id){

		$query='SELECT count(*) FROM user WHERE usernickname=:id';

		$req = $this->co->prepare($query);

		$req->bindValue(':id',$id, PDO::PARAM_STR);
		$req->execute();

		return $req->fetch();
	}

	public function tag_exist($id){

		$query='SELECT count(*) FROM tag WHERE tagname=:id';

		$req = $this->co->prepare($query);

		$req->bindValue(':id',$id, PDO::PARAM_STR);
		$req->execute();

		return $req->fetch();
	}


	public function get_tag_channel($id){

		$query = "SELECT c.contentid, c.contenttitle, usernickname, contentviews 
				  FROM tag t, contenttag ct, content c, user 
				  WHERE ct.contentid = c.contentid 
				  AND t.tagid = ct.tagid
				  AND contentuser = userid
				  AND tagname = :id 
				  ORDER BY contentdateupload DESC";

		$req = $this->co->prepare($query);

		$req->bindValue(':id',$id, PDO::PARAM_STR);

		$req->execute();

		return $req->fetchAll(PDO::FETCH_ASSOC);

	}

	public function get_user_channel($id){

		$query = "SELECT c.contentid, c.contenttitle, usernickname, contentviews 
		  		FROM content c, user 
				WHERE contentuser = userid
			  	AND usernickname = :id 
			  	ORDER BY contentdateupload DESC";

		$req = $this->co->prepare($query);

		$req->bindValue(':id',$id, PDO::PARAM_STR);

		$req->execute();

		return $req->fetchAll(PDO::FETCH_ASSOC);
	}

}

?>