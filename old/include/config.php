<?php
	session_start();
	
	try 
	{
		$dns = 'mysql:host=localhost;dbname=vidstream';
		$utilisateur = 'root';
		$motDePasse = '';
		$co = new PDO( $dns, $utilisateur, $motDePasse );
	} 
	catch( PDOException $e ) 
	{
		echo "Connection à MySQL impossible : ", $e->getMessage();
		die();	
	}

?>
