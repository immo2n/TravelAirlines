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
$search_from = '';
$search_to = '';
$search_date = '';
$title = 'Latest Schedules';

$searched = 0;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['from'], $_GET['to'], $_GET['departureDate'])) {
    $search_from = $_GET['from'];
    $search_to = $_GET['to'];
    $search_date = $_GET['departureDate'];

    // Update title
    $title = "$search_from to $search_to on $search_date";
    $searched = 1;
    // Fetch flights based on search criteria
    $sql = "SELECT * FROM flights WHERE going_from = '$search_from' AND going_to = '$search_to' AND date = '$search_date' ORDER BY date DESC";
} else {
    // Default query to show latest flights
    $sql = "SELECT * FROM flights ORDER BY date DESC LIMIT 10";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Airline Portal</title>
  <link href="res/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="res/css/app.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Airline Portal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ticket.php">View Your Ticket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/employee/">Employee Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero">
    <div class="hero-back"></div>
    <div class="container">
      <h1>Welcome to Airline Portal</h1>
      <p>Book flights, manage your bookings, and explore new destinations.</p>
      <a href="#search" class="btn btn-primary btn-lg mt-3">Book a Flight</a>
    </div>
  </div>

  <div style="display: grid;grid-template-columns: 1fr 1fr;">
    <!-- Flight Search Section -->
    <section id="search" class="py-5 flex-grow-1">
      <div class="container">
        <h2 class="text-center mb-4">Find Your Flight</h2>
        <form method="GET" action="">
          <div class="form-row">
            <div class="form-group col-md-3 mt-2">
              <label for="from">From</label>
              <select class="form-control mt-2" id="from" name="from" required>
                <option selected>Departure City</option>
                <option>New York</option>
              <option>Los Angeles</option>
              <option>Chicago</option>
              <option>Houston</option>
              <option>Phoenix</option>
              <option>Philadelphia</option>
              <option>San Antonio</option>
              <option>San Diego</option>
              <option>Dallas</option>
              <option>San Jose</option>
              <option>Austin</option>
              <option>Jacksonville</option>
              <option>Fort Worth</option>
              <option>Columbus</option>
              <option>San Francisco</option>
              <option>Charlotte</option>
              <option>Indianapolis</option>
              <option>Seattle</option>
              <option>Denver</option>
              <option>Washington</option>
              <option>Boston</option>
              <option>El Paso</option>
              <option>Detroit</option>
              <option>Nashville</option>
              <option>Memphis</option>
              <option>Portland</option>
              <option>Oklahoma City</option>
              <option>Las Vegas</option>
              <option>Louisville</option>
              <option>Baltimore</option>
              <option>Milwaukee</option>
              <option>Albuquerque</option>
              <option>Tucson</option>
              <option>Fresno</option>
              <option>Mesa</option>
              <option>Sacramento</option>
              <option>Atlanta</option>
              <option>Kansas City</option>
              <option>Colorado Springs</option>
              <option>Miami</option>
              <option>Raleigh</option>
              <option>Omaha</option>
              <option>Long Beach</option>
              <option>Virginia Beach</option>
              <option>Oakland</option>
              <option>Minneapolis</option>
              <option>Arlington</option>
              <option>Tampa</option>
              <option>Tulsa</option>
              <option>New Orleans</option>
              <option>Wichita</option>
              <option>Cleveland</option>
              <option>Bakersfield</option>
              <option>Aurora</option>
              <option>Anaheim</option>
              <option>Honolulu</option>
                <!-- Add other cities here -->
              </select>
            </div>
            <div class="form-group col-md-3 mt-2">
              <label for="to">To</label>
              <select class="form-control mt-2" id="to" name="to" required>
                <option selected>Arrival City</option>
                <option>New York</option>
              <option>Los Angeles</option>
              <option>Chicago</option>
              <option>Houston</option>
              <option>Phoenix</option>
              <option>Philadelphia</option>
              <option>San Antonio</option>
              <option>San Diego</option>
              <option>Dallas</option>
              <option>San Jose</option>
              <option>Austin</option>
              <option>Jacksonville</option>
              <option>Fort Worth</option>
              <option>Columbus</option>
              <option>San Francisco</option>
              <option>Charlotte</option>
              <option>Indianapolis</option>
              <option>Seattle</option>
              <option>Denver</option>
              <option>Washington</option>
              <option>Boston</option>
              <option>El Paso</option>
              <option>Detroit</option>
              <option>Nashville</option>
              <option>Memphis</option>
              <option>Portland</option>
              <option>Oklahoma City</option>
              <option>Las Vegas</option>
              <option>Louisville</option>
              <option>Baltimore</option>
              <option>Milwaukee</option>
              <option>Albuquerque</option>
              <option>Tucson</option>
              <option>Fresno</option>
              <option>Mesa</option>
              <option>Sacramento</option>
              <option>Atlanta</option>
              <option>Kansas City</option>
              <option>Colorado Springs</option>
              <option>Miami</option>
              <option>Raleigh</option>
              <option>Omaha</option>
              <option>Long Beach</option>
              <option>Virginia Beach</option>
              <option>Oakland</option>
              <option>Minneapolis</option>
              <option>Arlington</option>
              <option>Tampa</option>
              <option>Tulsa</option>
              <option>New Orleans</option>
              <option>Wichita</option>
              <option>Cleveland</option>
              <option>Bakersfield</option>
              <option>Aurora</option>
              <option>Anaheim</option>
              <option>Honolulu</option>
                <!-- Add other cities here -->
              </select>
            </div>
            <div class="form-group col-md-3 mt-2">
              <label for="departureDate">Departure</label>
              <input type="date" class="form-control mt-2" id="departureDate" name="departureDate" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-3 w-100">Search Flights</button>
        </form>
      </div>
    </section>

    <!-- Latest Flights Section -->
    <div class="container mt-5 flex-grow-1">
      <h2 class="mb-4"><?= htmlspecialchars($title) ?></h2>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Flight Number</th>
              <th>Going From</th>
              <th>Going To</th>
              <th>Price</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['flight_number']) . " ";
                    if($searched == 1) echo '<a href="book.php?row=' . htmlspecialchars($row['id']) . '">Book Now</a>';
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($row['going_from']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['going_to']) . "</td>";
                    echo "<td>$" . htmlspecialchars($row['price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No flights found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-primary text-white text-center py-3">
    <p>&copy; 2023 Airline Portal | All rights reserved.</p>
  </footer>

  <script src="res/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
