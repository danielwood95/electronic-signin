<?php
$tablesCreated = 0;
$servername = "localhost";
$username = "AdmWebsite";
$password = "PrincetonAdmissions";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE TourGuides";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
require_once("DBConnect.php");
$sql = "CREATE TABLE People (
Name VARCHAR(255) NOT NULL, 
Tours INT(11) DEFAULT 0,
Late INT(11) DEFAULT 0,
Absences INT(11) DEFAULT 0,
Day ENUM('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'none') DEFAULT 'none',
Window enum('eleven', 'one', 'three', 'none') DEFAULT 'none',
Number VARCHAR(255) DEFAULT 'none');
";

if (mysqli_query($conn, $sql)) {
    echo "Table People created successfully\n";
    $tablesCreated++;
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
$sql = "CREATE TABLE SignedIn (
Name VARCHAR(255) NOT NULL, 
Display VARCHAR(255),
Number VARCHAR(255), 
Date VARCHAR(255) NOT NULL,
Window enum('eleven', 'one', 'three'),
Here enum('true', 'false') DEFAULT 'false',
Tour enum('true', 'false') DEFAULT 'false');";
if (mysqli_query($conn, $sql)) {
    echo "Table SignedIn created successfully \n";
    $tablesCreated++;
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
mysqli_close($conn);
if($tablesCreated == 2){
    echo "<h1>All Tables Created Sucessfully click <a href='index.php'>here</a> to go to sign in page</h1>";
}
?>