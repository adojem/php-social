<?php
   include("../../config/config.php");
   include("../classes/Uer.php");
   include("../classes/Post.php");

   $limit = 10; // Number of posts to be loaded per call
   $posts = new Post($con, $_REQUEST['userLoggedIn']);
   $posts->loadPostsFriends();