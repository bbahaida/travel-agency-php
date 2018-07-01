<?php
try{
	$host = "localhost";
	$username = "root";
	$password = "";
	$db="transport";

	$bdd = new PDO("mysql:dbname=$db;host=$host", $username, $password) or die( mysql_error());
}catch(Exception $e){
	die("<p style=\"color:red\">Erreur : ".$e->getMessage()."</p>");
}

?>