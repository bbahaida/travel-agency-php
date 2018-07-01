<?php
session_start();
//connection base de donnee
$servername = "localhost";

$username = "RedHat";
$password = "toor";
$dbName = "trans_proj";
$conn = new mysqli($servername, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//fin connection

//the SQL query to be executed
$query = "select SUM(montant) as 'montant' ,CAST(date_transfert AS DATE) as date
from transferts where id_agence = ".$_SESSION['id']." 
group by CAST(date_transfert AS DATE)";
//storing the result of the executed query
$result = $conn->query($query);
//initialize the array to store the processed data
$jsonArray = array();
//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row['date'];
    $jsonArrayItem['value'] = $row['montant'];
    //append the above created object into the main array.
    array_push($jsonArray, $jsonArrayItem);
  }
}
//Closing the connection to DB
$conn->close();
//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);
?>