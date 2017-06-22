<?php
$servername = "localhost";
$username = "AdmWebsite";
$password = "PrincetonAdmissions";
$dbname = "TourGuides";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>