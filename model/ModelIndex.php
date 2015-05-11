<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/core/model.php');

class Index extends Model
{


	function get_tag(){

		$query = "SELECT tagid, tagname FROM Tag";
		$tag = $this->co->query($query)->fetchAll(PDO::FETCH_ASSOC);

		return $tag;
	}

	function get_new_content($tagid, $max_new_content){

		$query = "SELECT c.contentid, c.contenttitle, usernickname, contentviews 
				  FROM contenttag, content c, user 
				  WHERE contenttag.contentid = c.contentid 
				  AND contentuser = userid
				  AND tagid = :id 
				  ORDER BY contentdateupload DESC
				  LIMIT :max";
		$req = $this->co->prepare($query);

		$req->bindValue(':id',$tagid, PDO::PARAM_STR);
		$req->bindValue(':max',$max_new_content, PDO::PARAM_INT);

		$req->execute();
		$content = $req->fetchAll(PDO::FETCH_ASSOC);

		return $content;

	}

}
?>