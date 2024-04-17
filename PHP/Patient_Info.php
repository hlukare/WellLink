
<?php

if($_SERVER['REQUEST_METHOD']=='POST')
{
$prn = $_POST['prn'];   
}
require_once __DIR__.'/vendor/autoload.php'; 

use MongoDB\Client;

// connect to MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// select a database
$database = $client->selectDatabase('Well_Link');

// create a collection
$collectionName = 'Patient';
$Patient = $database->$collectionName;

$result = $Patient->find(['Prn' => $prn]);


$collectionName2 = 'Doctor_ID';
$Doctor = $database->$collectionName2;
$criteria = ['Prn' =>  $prn];
$doc = $Patient->findOne($criteria);



// loop through the results
foreach ($result as $document)
        {
        ?>
            <body>
            
            <table border="3px" >
            <tr>
                <td>PRN</td>
                <td><?php echo "PRN = " . $document['Prn']; ?></td>

            </tr>    
            <tr>
                <td>FIRST NAME</td>
                <td><?php echo "FIRST NAME = " . $document['First Name']; ?></td>
            </tr>
            <tr> 
                <td>LAST NAME</td>
                <td><?php echo "LAST NAME = " . $document['Last Name']; ?></td>
            </tr>
               
            <tr>     
                <td>PHONE</td>
                <td><?php echo "PHONE = " . $document['Phone']; ?></td>
            </tr>
            <tr>  
                <td>ADDRESS</td>
                <td><?php echo "ADDRESS = " . $document['Address']; ?></td>
            </tr>
            <tr>  
                <td>DOCTORS</td>
                <td><?php if ($doc) {
                $arrayField = $doc['DOCTOR_ID']; // here arryfield is array of doctor_id  
                foreach ($arrayField as $value) {
        
                echo "ID = ".$value." ";
                $result = $Doctor->findOne(['ID'=>$value]);
                echo" NAME = ".$result['Name']. "<br>";
                }
                } else {
                echo "Document not found.";
                }  
            ?></td>          
            </tr>
        </table>
            </body>
        <?php
        }
        

?>