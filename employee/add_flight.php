<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $going_from = $_POST['going_from'];
    $going_to = $_POST['going_to'];
    $price = $_POST['price'];
    $date = $_POST['date'];

    // Insert into database
    $sql = "INSERT INTO flights (flight_number, going_from, going_to, price, date) 
            VALUES ('$id', '$going_from', '$going_to', '$price', '$date')";

    if ($conn->query($sql) === TRUE) {
        echo "New flight schedule added successfully!";
        echo '<br><a href="index.php">Go back</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>