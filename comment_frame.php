<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
   
   <?php
      require 'config/config.php';
      include("./includes/classes/User.php");
      include("./includes/classes/Post.php");

      if (isset($_SESSION['username'])) {
         $userLoggedIn = $_SESSION['username'];
         $user_details_query = $con->prepare("SELECT * FROM users WHERE username = '$userLoggedIn'");
         $user_details_query->bindValue(":userLoggedIn", $userLoggedIn, PDO::PARAM_STR);
         $user_details_query->execute();
         $user = $user_details_query->fetch();
      }
      else {
         header('Location: register.php');
      }
   ?>

   <script>
      function toggle() {
         var element = document.getElementById('comment_section');

         if (element.style.display === 'block') {
            element.style.display = 'none';
         }
         else {
            element.style.dispaly = 'block';
         }
      }
   </script>

   <?php
      if (isset($_GET['psot_id'])) {
         $post_id = $_GET['post_id'];
      }

      $user_query = $con->prepare("SELECT added_by, user_to FROM posts WHERE id = :post_id");
      $user_query->bindValue(":post_id", $post_id);
      $user_query->execute();
      $row = $user_query->fetch();

      $posted_to = $row['added_by'];

      if (isset($_POST['postComment' . $post_id])) {
         $post_body = $_POST['post_body'];
         $post_body = $con->quote($post_body);
         $date_time_now = date("Y-m-d H:i:s");
         $stmt = $con->prepare("INSERT INTO comment VALUES('', :post_body, :userLoggedIn, :posted_to, :date_time_now, 'no', :post_id)");
         $stmt->bindValue(":post_body", $post_body, PDO::PARAM_STR);
         $stmt->bindValue(":userLoggedIn", $userLoggedIn, PDO::PARAM_STR);
         $stmt->bindValue(":posted_to", $posted_to, PDO::PARAM_STR);
         $stmt->bindValue(":date_time_now", $date_time_now, PDO::PARAM_INT);
         $stmt->bindValue(":post_id", $post_id, PDO::PARAM_INT);
         $stmt->execute();
         $insert_post = $stmt->fetch();
         echo '<p>Comment Posted!</p>';
      }
   ?>
   <form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postCommeent<?php echo $post_id; ?>" method="POST">
      <textarea name="post_body"></textarea>
      <input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">
   </form>

   <!-- Load Comment -->

</body>
</html>