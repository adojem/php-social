<?php
require 'config/config.php';

if (isset($_SESSION['username'])) {
   $userLoggedIn = $_SESSION['username'];
   $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
   $user = mysqli_fetch_array($user_details_query);
}
else {
   header('Location: register.php');
}

?>

<!DOCTYPE html>
<html>
<head>
   <title>Welcome to Swirlfeed</title>
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
   <link rel="stylesheet" href="assets/css/bootstrap.css">
   <link rel="stylesheet" href="assets/css/style.css">

   <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap.bundle.js"></script>

</head>
<body>

  <div class="top_bar">
    <div class="logo">
      <a href="index.php">Swirlfeed!</a>
    </div>

    <nav>
      <a href="<?php echo $userLoggedIn; ?>">
        <?php echo $user['first_name']; ?>
      </a>
      <a href="#">
        <i class="fa fa-home fa-lg"></i>
      </a>
      <a href="#">
        <i class="fa fa-envelope fa-lg"></i>
      </a>
      <a href="#">
        <i class="fa fa-bell-o fa-lg"></i>
      </a>
      <a href="#">
        <i class="fa fa-users fa-lg"></i>
      </a>
      <a href="#">
        <i class="fa fa-cog fa-lg"></i>
      </a>
      <a href="includes/handlers/logout.php">
        <i class="fa fa-sign-out fa-lg"></i>
      </a>
    </nav>
  </div>

  <div class="wrapper">
