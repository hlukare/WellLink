<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
$PRN = $_POST['prn'];   
}

require_once __DIR__.'/vendor/autoload.php'; 

// MongoDB connection
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");

// Selecting a database
$database = $mongoClient->selectDatabase("Well_Link");

$collectionName1 = 'Patient';
$Patient = $database->$collectionName1;

$result = $Patient->find(['Prn' => $PRN]);

$collectionName2 = 'Doctor_ID';
$Doctor = $database->$collectionName2;
$criteria = ['Prn' =>  $PRN];
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
                <!-- $collectionName2 = 'Doctor_ID';
                $Doctor = $database->$collectionName2;
                $criteria = ['Prn' =>  $PRN];
                $doc = $Patient->findOne($criteria); -->
                <td><?php if ($doc) {
                $arrayField = $doc['DOCTOR_ID']; // here arryfield is array of doctor_id  
                foreach ($arrayField as $value)// AAA BBB CCC
                {
                echo "ID = ".$value."<br>";
                $result = $Doctor->findOne(['ID'=>$value]);
                
                    echo" NAME = ".$result['Name']. "<br>";
                    echo" MEDICINAL ISSUES = ".$result[$PRN]['MEDICINAL ISSUES']."<br>";
                    echo" MEDICINE PRESCRIPTION = ".$result[$PRN]['MEDICINE PRESCRIPTION']."<br><br><br>";

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


