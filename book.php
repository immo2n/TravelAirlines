<?php

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

// Initialize variables
$flight_id = isset($_GET['row']) ? intval($_GET['row']) : 0;
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $trx = $_POST['trx'];

    if (!empty($name) && !empty($trx) && $flight_id > 0) {
        $sql = "INSERT INTO books (flight, name, trx) VALUES ('$flight_id', '$name', '$trx')";
        if ($conn->query($sql) === TRUE) {
            $ticket_id = $conn->insert_id; // Get the last inserted ID (ticket ID)
            $message = "Booking successful! Your Ticket ID is <strong>$ticket_id</strong>.";
            $message .= '<br><a href="ticket.php?id=' . $ticket_id . '" class="btn btn-link">View Ticket</a>';
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }        
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book a Flight</title>
  <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Book a Flight</h2>
    <?php if (!empty($message)): ?>
      <div class="alert <?= strpos($message, 'successful') !== false ? 'alert-success' : 'alert-danger'; ?>">
        <?= $message; ?>
      </div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="name" class="form-label">Passenger Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
      </div>
      <div class="mb-3">
        <label for="trx" class="form-label">bKash Transaction ID</label>
        <input type="text" class="form-control" id="trx" name="trx" placeholder="Enter your bKash transaction ID" required>
      </div>
      <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
  </div>

  <script src="res/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
