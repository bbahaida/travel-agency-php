<?php
try{
	$host = "localhost:3308";
	$username = "root";
	$password = "";
	$db="trans_proj";

	$bdd = new PDO("mysql:dbname=$db;host=$host", $username, $password) or die( mysql_error());
}catch(Exception $e){
	die("<p style=\"color:red\">Erreur : ".$e->getMessage()."</p>");
}

?>