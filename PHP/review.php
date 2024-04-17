<?php
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "review";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_create_table = "CREATE TABLE IF NOT EXISTS demo (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    rating INT(1) NOT NULL,
    comments TEXT
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Table 'demo' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $rating = $_POST["rating"];
    $comments = $_POST["comments"];

    $sql_insert = "INSERT INTO demo (name, email, rating, comments)
                   VALUES ('$name', '$email', '$rating', '$comments')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Review submitted successfully";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>
