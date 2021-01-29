<?php
session_start();
//connection base de donnee
require_once("../inc/connection.php");
//fin connection

//the SQL query to be executed
$query = "select SUM(montant) as 'montant' ,CAST(date_transfert AS DATE) as date
from transferts where agence = '".$_SESSION['agence']."' 
group by CAST(date_transfert AS DATE)";
//storing the result of the executed query
$result = $bdd->query($query);
//initialize the array to store the processed data
$jsonArray = array();
  //Converting the results into an associative array
  while($row = $result->fetch()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row['date'];
    $jsonArrayItem['value'] = $row['montant'];
    //append the above created object into the main array.
    array_push($jsonArray, $jsonArrayItem);
  }

//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);
?>