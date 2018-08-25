<?php
   class User {
      private $user;
      private $con;

      public function __construct($con, $user) {
         $this->con = $con;
         $user_details_query = $con->query("SELECT * FROM users WHERE username = '$user'");
         $this->user = $user_details_query->fetch();
      }

      public function getUsername() {
         return $this->user['username'];
      }

      public function getNumPosts() {
         $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username = '$username'");
         $row = mysqli_fetch_array($query);
         return $row['num_posts'];
      }

      public function getFirstAndLastName() {
         $username = $this->user['username'];
         $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username = '$username'");
         $row = mysqli_fetch_array($query);
         
         return "{$row['first_name']} {$row['last_name']}";
      }

      public function isClosed() {
         $username = $this->user['username'];
         $query = $this->con->query("SELECT user_closed FROM users WHERE username = '$username'");
         $row = $query->fetch();

         if ($row['user_closed'] == 'yes')
            return true;
         else
            return false;
      }

      public function isFriend($username_to_check) {
          $usernameComma = ",{$username_to_check},";

          if (strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username']) {
            return true;
          }
          else {
            return false;
          }
      }
   }
