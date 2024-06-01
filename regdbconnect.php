<?php


$server = "localhost";
$username = "root";
$password = "";
$database = "esport_database";
$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Failure to connect" .
        $conn->connect_error);
} else {
    echo "";
}
?>