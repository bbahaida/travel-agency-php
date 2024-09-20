<?php
try{
	$host = getenv('DB_HOST') ?: 'localhost';  // Default to 'localhost' if env is not set
    $port = getenv('DB_PORT') ?: '3306';       // Default port 3306
    $username = getenv('DB_USER') ?: 'root';   // Default to 'root'
    $password = getenv('DB_PASSWORD') ?: '';   // Default to empty password
    $db = getenv('DB_NAME') ?: 'trans_proj';   // Default to 'trans_proj'

	$bdd = new PDO("mysql:dbname=$db;host=$host", $username, $password) or die( mysql_error());
}catch(Exception $e){
	die("<p style=\"color:red\">Erreur : ".$e->getMessage()."</p>");
}

?>