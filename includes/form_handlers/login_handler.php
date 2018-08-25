<?php
if (isset($_POST['login_button'])) {
   $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); // sanitize email
   $_SESSION['log_email'] = $email; // Store email into session variable
   $password = md5($_POST['log_password']); // Get passsword
   echo $_POST['loin_email'];
   // echo $password;

   $check_database_query = $con->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
   
   $check_login_query = $check_database_query->rowCount();

   if ($check_login_query == 1) {
      $row = $check_database_query->fetch();
      $username = $row['username'];

      $user_closed_query = $con->query("SELECT * FROM users WHERE email = '$email' AND user_closed = 'yes'");
      if ($user_closed_query->rowCount() == 1) {
         $reopen_account = $con->query("UPDATE users SET user_closed = 'no' WHERE email = '$email'");
      }

      $_SESSION['username'] = $username;
      header('Location: index.php');
      exit();
   }
   else {
      array_push($error_array, 'Email or password incorrect<br>');
   }
}