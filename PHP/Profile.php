<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
$D_ID = $_POST['id'];   
}

require_once __DIR__.'/vendor/autoload.php'; 

// MongoDB connection
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");

// Selecting a database
$database = $mongoClient->selectDatabase("Well_Link");

// Selecting a collection
$collection = $database->selectCollection("Doctor_ID");
$criteria = ['ID' => $D_ID];
// Query to find the document
$document = $collection->findOne($criteria);

if ($document) {
    $arrayField = $document['Patient_ID']; // here arryfield is array of doctor_id 

    
    foreach ($arrayField as $value) {
        $one = $document[$value];
        echo "ID = ".$value." <br> ";
        echo" MEDICINAL ISSUES = ".$one['MEDICINAL ISSUES']."<br>";
        echo" MEDICINE PRESCRIPTION = ".$one['MEDICINE PRESCRIPTION']."<br>";
    }
} else {
    echo "Document not found.";
} 
?>


