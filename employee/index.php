<?php

require_once '../php/global.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
    if($_POST['email'] == 'admin@gmail.com' && $_POST['password'] == '1234') {
        $_SESSION['admin'] = 'admin';
        header('Location: index.php');
    }
    else {
        echo '<script>alert("Invalid email or password")</script>';
    }
}

if(!isset($_SESSION['admin'])) {
    include 'login.php';
    exit();
}

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

// Fetch flights from the database
$sql = "SELECT * FROM flights ORDER BY date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3 vh-100" style="width: 250px;">
      <h3 class="text-center mb-4">Dashboard</h3>
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a href="/" class="nav-link text-white">Home</a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link text-white">Logout</a>
        </li>
      </ul>
    </nav>


<!-- Main Content -->
<div class="container-fluid p-4">
      <h2>Add Flight Schedule</h2>
      <form action="add_flight.php" method="POST">
        <div class="mb-3">
          <label for="id" class="form-label">Flight ID</label>
          <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <div class="form-group col-md-3 mt-2">
            <label for="from">From</label>
            <select name="going_from" class="form-control mt-2 w-100" id="from">
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
            </select>
          </div>
          <div class="form-group col-md-3 mt-2">
            <label for="from">From</label>
            <select name="going_to" class="form-control mt-2 w-100" id="from">
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
            </select>
          </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Flight</button>
      </form>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4">Flight Schedules</h2>
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
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['flight_number'] . "</td>";
                            echo "<td>" . $row['going_from'] . "</td>";
                            echo "<td>" . $row['going_to'] . "</td>";
                            echo "<td>$" . $row['price'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>