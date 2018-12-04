<?php

/**
 * Class to connect to the data base
 */
class Database
{

	const HOST = "localhost",
		  DBNAME = "bank-count", // nom de votre base de données
		  LOGIN = "root", // votre utilisateur
		  PWD = "root"; // votre mot de passe

	static public function DB(){
		try
		{
			$db = new PDO("mysql:host=" . self::HOST .";dbname=" . self::DBNAME , self::LOGIN, self::PWD);
			return $db;
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

}
