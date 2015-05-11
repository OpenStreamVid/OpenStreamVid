<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/openstreamvid/core/model.php');

class User extends Model{


	public function exist($id)
	{
		$query = 'SELECT COUNT(userid) as userexisting FROM user WHERE usernickname = :nickname OR useremail = :email';
		$req = $this->co->prepare($query);

		$req->bindValue(':nickname',$id,PDO::PARAM_STR);
		$req->bindValue(':email',	$id,PDO::PARAM_STR);

		$req->execute();

		$row = $req->fetch(PDO::FETCH_ASSOC);

		return $row['userexisting'];
	}


	public function insert_user($nickname, $email, $password)
	{
		try
		{
			$sql='INSERT INTO User VALUES (null, :nickname, :email, :password, null)';
			$req= $this->co->prepare($sql);

			$req->bindValue(':nickname',     	$_POST['nickname'], PDO::PARAM_STR);
			$req->bindValue(':email',       $_POST['email'], PDO::PARAM_STR);
			$req->bindValue(':password',    sha1($_POST['password']), PDO::PARAM_STR);

			$req->execute();
		}
		catch( PDOException $e ) 
		{
			echo "Registration impossible : ", $e->getMessage();
		}	
	}

	public function create_repertory($path1,$path2)
	{
		
		if(!is_dir($path1))
		{
			mkdir($path1);
		}

		if(!is_dir($path2))
		{
			mkdir($path2);
		}
	}

/**
		Get user email
**/
	public function get_email($id)
	{
		$query = 'SELECT useremail as email FROM user WHERE userid = :id';
		$req = $this->co->prepare($query);

		$req->bindValue(':id',$id, PDO::PARAM_STR);
		$req->execute();

		$row = $req->fetchAll();

		return json_encode($row[0]['email']);
	}


/**
		Add or change profile picture to userss
**/	
	public function add_picture($path,$name,$tmp)
	{
		$error = true;	
		$filename = 'profile.jpg';
 		

 		if(!empty($name))
 		{
 			if (move_uploaded_file($tmp, $path)) {
 				$error = null;
 			}
 			else{
 				$error = 'upload error 1';
 			}
		}
		else
		{
			$defaultpath = 'img/user/'.$filename;
			if (copy($defaultpath, $path)) {
 				$error = null;
 			}
 			else
 			{
 				$error = 'upload error 2';
 			}
		}

		// return $error;
	}


/**
		Change user information
**/
	public function change($array)
	{
		if($array['function'] == 'nickname')
		{
			return $this->change_nickname($array['id'],$array['data'],$array['old']);
		}
		else if($array['function'] == 'email')
		{
			return $this->change_email($array['id'], $array['data']);
		}
		else if($array['function'] == 'password')
		{
			return $this->change_password($array['id'], $array['data']);
		}
	}


/**
		Change nickname
**/

	private function change_nickname($id, $nickname, $old)
	{
		try 
		{
			$query = "UPDATE user SET usernickname = :nickname WHERE userid = :id";
			$req = $this->co->prepare($query);

			$req->bindValue(':nickname',$nickname, PDO::PARAM_STR);
			$req->bindValue(':id',$id, PDO::PARAM_STR);
			$req->execute();

			$path1 = '../img/user/';
			$path2 = '../videos/';
			rename($path1.$old, $path1.htmlspecialchars($nickname));
			rename($path2.$old, $path2.htmlspecialchars($nickname));

			return 0;
		} 
		catch (PDOException $e) 
		{
			return "Connection impossible : ". $e->getMessage();
		}
	}

/**
		Change email
**/

	private function change_email($id,$email)
	{
		try 
		{
			$query = "UPDATE user SET useremail = :email WHERE userid = :id";
			$req = $this->co->prepare($query);

			$req->bindValue(':email',$email, PDO::PARAM_STR);
			$req->bindValue(':id',$id, PDO::PARAM_STR);
			$req->execute();

			return 0;
		} 
		catch (PDOException $e) 
		{
			return "Connection impossible : ". $e->getMessage();
		}
	}

/**
		Change password
**/

	private function change_password($id, $password)
	{
		try 
		{
			$query = "UPDATE user SET userpasswd = :password WHERE userid = :id";
			$req = $this->co->prepare($query);

			$req->bindValue(':password',sha1($password), PDO::PARAM_STR);
			$req->bindValue(':id',$id, PDO::PARAM_STR);
			$req->execute();

			return 0;
		} 
		catch (PDOException $e) 
		{
			return "Connection impossible : ". $e->getMessage();
		}
	}

/**
		Connect the user
**/	
	public function connect($id, $password)
	{
		try
		{
			$query = 'SELECT userid, usernickname From user WHERE userpasswd = :password AND useremail = :id';
			$req = $this->co->prepare($query);

			$req->bindValue(':id', 			$id, PDO::PARAM_STR);
			$req->bindValue(':password', 	sha1($password), PDO::PARAM_STR);

			$req->execute();
			$value = $req->fetchAll();

			if(!empty($value))	
			{
				$value[0]['connect'] = 'yes';
				return $value[0];
			}
			else
			{
				return array("empty"=>"yes");
			}

		}
		catch( PDOException $e ) 
		{
			echo "Connection impossible : ". $e->getMessage();
			exit;
		}
	}
}

?>