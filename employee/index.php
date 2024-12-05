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
      <h2>Add flight schedule</h2>
      <div class="row g-4 mt-4">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title">Users</h5>
              <p class="card-text">1,234</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title">Sales</h5>
              <p class="card-text">$12,345</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-center">
              <h5 class="card-title">Feedback</h5>
              <p class="card-text">345</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>