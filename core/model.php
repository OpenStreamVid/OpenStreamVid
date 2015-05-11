<?php 

class Model
{
	var $co;

	function __construct(){

		try 
		{
			$dns = 'mysql:host=localhost;dbname=openstreamvid';
			$utilisateur = 'root';
			$motDePasse = '';
			$this->co = new PDO( $dns, $utilisateur, $motDePasse );
		} 
		catch( PDOException $e ) 
		{
			echo "Connection à MySQL impossible : ", $e->getMessage();
			die();	
		}
	}
}
?>