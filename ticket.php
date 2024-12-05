<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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

// Check if the `id` parameter is set
if (!isset($_GET['id'])) {
    // Display a form to ask for the Ticket ID
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enter Ticket ID</title>
        <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="mb-4">Enter Ticket ID</h2>
            <form method="get" action="ticket.php">
                <div class="form-group">
                    <label for="ticketId">Ticket ID</label>
                    <input type="number" class="form-control" id="ticketId" name="id" placeholder="Enter your Ticket ID" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
        <script src="res/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
    exit;
}

// Get Ticket ID from URL
$ticket_id = intval($_GET['id']);
if ($ticket_id <= 0) {
    echo "Invalid Ticket ID.";
    showTicketForm();
    exit;
}

// Query the 'books' table for the booking
$sql_booking = "SELECT books.id, books.flight, books.name, books.trx
                FROM books 
                WHERE books.id = $ticket_id";
$result = $conn->query($sql_booking);

if ($result->num_rows > 0) {
    // If a booking is found, fetch flight details
    $booking = $result->fetch_assoc();
    $flight_id = $booking['flight']; // Get the flight number from the booking

    // Now fetch flight details from the 'flights' table
    $sql_flight = "SELECT *
                   FROM flights 
                   WHERE flights.id = '$flight_id'";
    $flight_result = $conn->query($sql_flight);

    if ($flight_result->num_rows > 0) {
        // Flight found, fetch flight data
        $flight = $flight_result->fetch_assoc();
    } else {
        echo "Flight not found.";
        showTicketForm();
        exit;
    }
} else {
    echo "Ticket not found.";
    showTicketForm();
    exit;
}

function showTicketForm() {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enter Ticket ID</title>
        <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="mb-4">Enter Ticket ID Again</h2>
            <form method="get" action="ticket.php">
                <div class="form-group">
                    <label for="ticketId">Ticket ID</label>
                    <input type="number" class="form-control" id="ticketId" name="id" placeholder="Enter your Ticket ID" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
        <script src="res/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ticket Details</title>
  <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Ticket Details</h2>
    <div class="card">
      <div class="card-header bg-primary text-white">
        Ticket ID: <?= htmlspecialchars($booking['id']) ?>
      </div>
      <div class="card-body">
        <p><strong>Passenger Name:</strong> <?= htmlspecialchars($booking['name']) ?></p>
        <p><strong>Transaction ID:</strong> <?= htmlspecialchars($booking['trx']) ?></p>
        <p><strong>Flight Number:</strong> <?= htmlspecialchars($flight['flight_number']) ?></p>
        <p><strong>From:</strong> <?= htmlspecialchars($flight['going_from']) ?></p>
        <p><strong>To:</strong> <?= htmlspecialchars($flight['going_to']) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($flight['price']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($flight['date']) ?></p>
      </div>
    </div>
    <a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
  </div>

  <script src="res/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
