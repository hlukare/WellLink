<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
$prn = $_POST['prn'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone']; 
$add = $_POST['add'];
   
}
require_once __DIR__.'/vendor/autoload.php'; // Include Composer's autoloader

use MongoDB\Client;

// Connect to MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Select a database
$database = $client->selectDatabase('Well_Link');

// Create a collection
$collectionName = 'Patient';
$collection = $database->$collectionName;

$data = [
    "Prn"=>$prn,
    "First Name"=>$fname,
    "Last Name"=>$lname,
    "Phone"=>$phone,
    "Address"=>$add,
];

$result = $collection->insertOne($data);
echo " DATA INSERTED SUCCESSFULLY";

?>